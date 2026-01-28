<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\PaginaWebController::class, 'index'])->name('inicio');
// Route::get('/horarios', [\App\Http\Controllers\PaginaWebController::class, 'horarios'])->name('horarios');
// Route::get('/quienes-somos', [\App\Http\Controllers\PaginaWebController::class, 'quienesSomos'])->name('quienes-somos');
// Route::get('/contacto', [\App\Http\Controllers\PaginaWebController::class, 'contacto'])->name('contacto');
// Route::get('/reglamento', [\App\Http\Controllers\PaginaWebController::class, 'reglamento'])->name('reglamento');
// Route::get('/inscripciones', [\App\Http\Controllers\PaginaWebController::class, 'inscripciones'])->name('inscripciones');
// Route::get('/sucursales', [\App\Http\Controllers\PaginaWebController::class, 'sucursales'])->name('sucursales');

// Route::get('/galeria', [\App\Http\Controllers\PaginaWebController::class, 'galeria'])->name('galeria');


Route::get('/detalle-inscripcion/{codigo}', [\App\Http\Controllers\PaginaWebController::class, 'detalleInscripcion'])->name('detalle-inscripcion');

Route::post('/asistencias-inscripcion', [\App\Http\Controllers\PaginaWebController::class, 'asistenciasInscripcion'])->name('asistencias-inscripcion');


Route::get('/velzon/{file?}', function (string $file = 'index') {
    return view('velzon.' . $file);
});



Route::get('/captcha', [\App\Http\Controllers\CaptchaController::class, 'index'])->name('captcha');

Auth::routes();

Route::get('/admin/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
// Route::get('/admin/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/admin/getInicio', [App\Http\Controllers\HomeController::class, 'getInicio'])->name('admin.getCharts');



Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin' , 'middleware' => 'auth'], function () {
    // Route::get('/dashboard', 'DashboardController@index');
    // Route::get('/users', 'UserController@index');
    Route::resource('paginas', 'PaginaController');






    Route::resource('personas', 'PersonaController');
    Route::post('/personas-listar', 'PersonaController@getAll')->name('personas.listar');

    Route::post('/personas-actualizar-foto/{id}', 'PersonaController@updatePhoto')->name('personas.actualizar.foto');
    Route::post('/persona-buscar', 'PersonaController@searchPersona')->name('persona.buscar');


    Route::post('/persona-buscar-entrenador', 'PersonaController@searchEntrenador')->name('persona.buscar-entrenador');




    Route::resource('categorias', 'CategoriaController');
    Route::post('/categorias-listar', 'CategoriaController@getAll')->name('categorias.listar');

    Route::resource('inscripciones', 'InscripcionController');
    Route::post('/inscripciones-listar', 'InscripcionController@getAll')->name('inscripciones.listar');
    Route::post('/inscripciones-parametrico', 'InscripcionController@getParametrico')->name('inscripciones.param');

    Route::get('/pagos-inscripcion/{id}', 'InscripcionController@getPagosInscripcion')->name('pagos.inscripcion');

    Route::resource('pagos-mes-gestion', 'PagoMesGestionController');

    // persona-buscar

    Route::resource('sucursales', 'SucursalController');
    Route::post('/sucursales-listar', 'SucursalController@getAll')->name('sucursales.listar');
    Route::get('/sucursales-parametrico', 'SucursalController@getParametrico')->name('sucursales.param');


    Route::resource('grupos-entrenamientos', 'GrupoEntrenamientoController');
    Route::post('/grupos-entrenamientos-listar', 'GrupoEntrenamientoController@getAll')->name('grupos-entrenamientos.listar');
    Route::post('/grupos-entrenamientos-parametrico', 'GrupoEntrenamientoController@getParametrico')->name('grupos-entrenamientos.param');


    Route::get('/tarjeta-control/{id}', 'PdfController@tarjetaControl')->name('tarjeta.control');
    Route::get('/credencial/{id}', 'PdfController@credencialInscripcion')->name('credencial');
    Route::get('/pagos-inscripcion-pdf/{id}', 'PdfController@pagosInscripcion')->name('pagos.inscripcion.pdf');

    Route::get('/reporte-seguimiento/{id}', 'PdfController@seguimiento')->name('reporte.seguimiento');


    Route::resource('seguimientos', 'ValoracionController');
    Route::post('/seguimientos-listar', 'ValoracionController@getAll')->name('seguimientos.listar');
    Route::get('/seguimientos-caracteristicas-atributo', 'ValoracionController@getCaracteristicasAtributo')->name('seguimientos.caracteristicas.atributo');
    Route::get('/seguimientos-inscripcion/{id}', 'ValoracionController@getSeguimientosInscripcion')->name('seguimientos.inscripcion');
    //getValoracionAtributo
    Route::get('/seguimientos-atributo/{id}', 'ValoracionController@getValoracionAtributo')->name('seguimientos.atributo');

    Route::get('/seguimientos-inscripcion-pdf/{id}', 'PdfController@seguimientoInscripcion')->name('seguimientos.inscripcion.pdf');


    Route::resource('asistencia', 'AsistenciaController');

    Route::get('/asistencia-pdf', 'PdfController@asistencia')->name('asistencia.estudiante');

    Route::get('/marcar-asistencia', 'AsistenciaController@indexMarcado')->name('asistencia.marcado');

    Route::post('/asistencia-estudiante', 'AsistenciaController@asistenciaEstudiante')->name('asistencia.estudiante');

    Route::post('/asistencia-estudiante-registrar', 'AsistenciaController@asistenciaEstudianteRegistrar')->name('asistencia.estudiante.registrar');

    Route::post('/asistencia-estudiante-listar', 'AsistenciaController@getListaAsistencias')->name('asistencia.estudiante.listar');



    Route::get('/listar-grupos-entrenamiento','GrupoEntrenamientoController@getGruposEntrenamiento')->name('listar.grupos.entrenamiento');


    Route::get('/buscar-estudiante','PersonaController@buscarEstudiante')->name('buscar.estudiante');
    Route::get('/listar-dias-entrenamiento-grupo','GrupoEntrenamientoController@getDiasEntrenamiento')->name('listar-dias-entrenamiento');
});



Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin' , 'middleware' => 'auth'], function () {

    Route::resource('/usuarios', 'UserController');
    Route::post('/usuarios-listar', 'UserController@getAll')->name('usuarios.listar');
    Route::post('usuarios-parametrico', 'UserController@getParametrico')->name('usuarios.param');

});
