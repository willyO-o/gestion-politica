<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('one_not_empty', function ($attribute, $value, $parameters, $validator) {
            $otherAttribute = $parameters[0];
            return !empty($value) || !empty($validator->getData()[$otherAttribute]);
        });

        Validator::replacer('one_not_empty', function ($message, $attribute, $rule, $parameters) {
            $otherAttribute = $parameters[0];
            return str_replace(':other', $otherAttribute, $message);
        });

        Validator::extend('unique_relationship', function ($attribute, $value, $parameters, $validator) {


            $table = $parameters[0];
            $query = DB::table($table);
            $query->where($attribute, $value);

            for ($i = 1; $i < count($parameters); $i++) {
                $query->where($parameters[$i], $validator->getData()[$parameters[$i]]);
            }


            return !$query->exists();

        });



        Validator::extend('dia_correspondiente', function ($attribute, $value, $parameters, $validator) {

            //validar si el dia de entrenamiento coresponde al dia de la fecha de asistencia que se ingresa, es decir se tiene parametizado los dias de entrenamiento lunes = 1,  miercoles = 3  y domingo = 7
            // estos dias estan parametrizados en la tabla dia_grupo_entrenamiento en el formulario viene el id_grupo_entrenamiento_fk, entonces se debe buscar el dia de entrenamiento de ese grupo
            // si la fecha ingresada no concide con el dia semanal extraido de la fecha de asistencia, entonces no se puede registrar la asistencia

            $idGrupoEntrenamiento = $validator->getData()['id_grupo_entrenamiento_fk'];
            $fechaAsistencia = $validator->getData()['fecha_asistencia'];

            $diasEntrenamiento= \App\Models\Admin\GrupoEntrenamiento::getDiasEntrenamiento($idGrupoEntrenamiento);
            $idsDiasEntrenamiento= $diasEntrenamiento->map(function($dia){
                return $dia->id_dia_fk;
            });

            $nombresDias= $diasEntrenamiento->map(function($dia){
                return $dia->nombre_dia;
            });


            $diaSemana = date('N', strtotime($fechaAsistencia));


            $validator->addReplacer('dia_correspondiente', function ($message, $attribute, $rule, $parameters) use ($nombresDias) {
                return str_replace(':dias', $nombresDias->implode(','), $message);
            });

            return in_array($diaSemana,$idsDiasEntrenamiento->toArray());

        });

        // Validator::replacer('dia_correspondiente', function ($message, $attribute, $rule, $parameters) {
        //     return str_replace(':dias', $parameters[0], $message);
        // });

        //validar unica asistencia que funcione para registrar y actualizar
        Validator::extend('unique_asistencia', function ($attribute, $value, $parameters, $validator) {

            $idInscripcion = $validator->getData()['id_inscripcion_fk'];
            $fechaAsistencia = $validator->getData()['fecha_asistencia'];


            // var_dump($idInscripcion, $fechaAsistencia);die;
            $query = DB::table('weps_asistencia')
                ->where('id_inscripcion_fk', $idInscripcion)
                ->where('fecha_asistencia', $fechaAsistencia);

            if (isset($validator->getData()['id_asistencia'])) {
                $query->where('id_asistencia', '!=', $validator->getData()['id_asistencia']);
            }

            return !$query->exists();


        });

    }
}
