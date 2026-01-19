<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Persona;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = User::getRoles();
        return view('admin.seguridad.indexUsuario')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate(User::rules());

        try {

            DB::beginTransaction();

            $userData = $request->all();

            $persona = Persona::find($userData["id_persona_fk"]);

            $userData["us_avatar"] = User::createAvatar($persona, $userData["usuario"]);

            $sucursales = $userData["susursales_autorizadas"];

            $user = User::create($userData);

            $user->sucursales()->sync($sucursales);

            if (User::verifyUserSucursal($user->id, $sucursales) == false) {

                throw new \Exception("El usuario no se ha podido registrar en las sucursales seleccionadas");
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado correctamente',
                'data' => User::getUsers([], $user->id)->first()
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::getUsers([], $id)->first();

        if (empty($usuario->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $usuario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrfail($id);

        if ($request->isMethod("PUT")) {
            $request->validate(User::rules(true));
        }


        try {

            DB::beginTransaction();

            if ($request->isMethod("PUT")) {

                $userData = $request->all();


                $sucursales = $userData["susursales_autorizadas"];

                $res = $user->update($userData);

                if (!$res) {
                    throw new \Exception("El usuario no se ha podido actualizar");
                }


                $user->sucursales()->sync($sucursales);


                if (User::verifyUserSucursal($user->id, $sucursales) == false) {

                    throw new \Exception("El usuario no se ha podido registrar en las sucursales seleccionadas");
                }
            }


            if ($request->isMethod("PATCH")) {

                $res = $user->update($request->all());

                if (!$res) {
                    throw new \Exception("El usuario no se ha podido actualizar");
                }
            }



            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Usuario Actualizado correctamente',
                'data' => User::getUsers([], $user->id)->first()
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);

        $resul = $user->delete();

        return response()->json([
            'success' => $resul,
            'message' => $resul ? 'Usuario eliminado correctamente' : 'El usuario no se ha podido eliminar'
        ], $resul ? 200 : 500);
    }

    public function getAll(Request $request)
    {
        $limit = $request->input('size', 10);
        $page = $request->input('page', 1);

        $data = User::getUsers($request->all())->paginate($limit, ['*'], 'page', $page);

        $listado = $data->items();

        return  response()->json([
            'datos' => $listado,
            'total' => $data->total(),
            'page' => $data->currentPage(),
        ]);
    }

    public function getParametrico()
    {
        $data["personas"] = User::getPersonas()->get();
        $data["sucursales"] = DB::table('weps_sucursal')->where('estado_sucursal', 'ACTIVO')->get();


        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
