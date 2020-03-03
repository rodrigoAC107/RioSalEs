<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Carbon\Carbon;
use App\Notificacion;



Route::get('/', function () {return redirect('login');});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'Medico'],function(){
    Route::put('/habitos/{id}','HabitosController@update')->name('habitos.update');
    Route::put('/alergia/{id}','AlergiaController@update')->name('alergia.update');
    Route::put('/antecedenteFamiliar/{id}','AntecedenteFamiliarController@update')->name('antecedenteFamiliar.update');
    Route::put('/antecedentePersonal/{id}','AntecedentePersonalController@update')->name('antecedentePersonal.update');

    Route::match(['put','patch'],'empleado/update/{legajo}', 'EmpleadoController@update')->name('empleado.update');
    Route::get('/programaVacunacion','ProgramaVacunacionController@index')->name('programaVacunacion.index');
    Route::post('/programaVacunacion','ProgramaVacunacionController@store')->name('programaVacunacion.store');
    Route::get('/programaVacunacion/{id}','ProgramaVacunacionController@show')->name('programaVacunacion.show');
    Route::get('/programaDeVacunacion/iniciar/{id}','ProgramaVacunacionController@edit')->name('programaVacunacion.edit');
    route::post('/programaVacunacion/cargarVacuna','ProgramaVacunacionController@cargarVacunaPrograma')->name('programaVacunacion.cargarVacunaPrograma');
    Route::get('/descargar/ver/{file}', 'DocumentacionController@Verdescarga')->name('estudio.ver.descarga');
    Route::get('/descargar/{file}', 'DocumentacionController@descargar')->name('estudio.descarga');
    route::put('/dieta/{id}','DietaController@update')->name('dieta.update');
});
Route::group(['middleware'=>'Administrador'],function(){
    Route::get('/usuarios','UserController@index')->name('usuarios.index');
    Route::get('/usuarios/{id}/edit','UserController@edit')->name('usuarios.edit');
    Route::put('/usuarios/{id}','UserController@update')->name('usuarios.update');
    Route::get('/usuarios/{id}/delete','UserController@delete')->name('usuarios.delete');
    Route::get('/actividades', 'ActivityLogController@index')->name('log.index');
    Route::get('/registrar', 'RegistrarController@index')->name('registrar.index');
    Route::post('/registrar/crear', 'RegistrarController@store')->name('registrar.store');

});

// RUTAS PARA CREAR USUARIOS DESDE DENTROD EL SISTEMA.
// Route::get('/registrar', 'RegistrarController@index')->name('registrar.index');
// Route::post('/registrar/crear', 'RegistrarController@store')->name('registrar.store');

// RUTAS PARA CREAR PACIENTES DESDE DENTROD EL SISTEMA.(Listo)
Route::get('/empleado','EmpleadoController@index')->name('empleado.index');
Route::get('/empleado/informacion','EmpleadoController@informacion')->name('empleado.informacion');
Route::post('/empleado/guardarArea','EmpleadoController@cargarArea')->name('empleado.guardarArea');
Route::post('/empleado/guardar','EmpleadoController@guardar')->name('empleado.guardar');

// RUTAS PARA ALERGIA
// route::resource('alergia','AlergiaController');
route::get('/alergia/create','AlergiaController@create')->name('alergia.create');
route::post('/alergia','AlergiaController@store')->name('alergia.store');
// route::put('/alergia/{id}','AlergiaController@update')->name('alergia.update');

// RUTAS PARA DIETA
// route::resource('dieta','DietaController');
route::get('/dieta/create','DietaController@create')->name('dieta.create');
route::post('/dieta','DietaController@store')->name('dieta.store');
// route::put('/dieta/{id}','DietaController@update')->name('dieta.update');
route::post('/dieta/create/mostrarComida','DietaController@mostrarComida')->name('dieta.mostrarComida');

//Ruta para Programa de Vacunacion
// Route::resource('programaVacunacion','ProgramaVacunacionController');
// route::get('/programaVacunacion','ProgramaVacunacionController@index')->name('programaVacunacion.index');
// route::post('/programaVacunacion','ProgramaVacunacionController@store')->name('programaVacunacion.store');
// route::get('/programaVacunacion/{id}','ProgramaVacunacionController@show')->name('programaVacunacion.show');



//Rutas para Habitos
// route::resource('habitos','HabitosController');
route::get('/habitos/create','HabitosController@create')->name('habitos.create');
route::post('/habitos','HabitosController@store')->name('habitos.store');
// route::put('/habitos/{id}','HabitosController@update')->name('habitos.update');



//Rutas para Documentacion
// route::resource('documentacion','DocumentacionController');
route::get('/documentacion','DocumentacionController@index')->name('documentacion.index');
route::post('/documentacion','DocumentacionController@store')->name('documentacion.store');

// ESTUDIOS
// Route::get('/descargar/ver/{file}', 'DocumentacionController@Verdescarga')->name('estudio.ver.descarga');
// Route::get('/descargar/{file}', 'DocumentacionController@descargar')->name('estudio.descarga');


// RUTAS PARA ANTECEDENTES FAMILIARES
// route::resource('antecedenteFamiliar','AntecedenteFamiliarController');
route::get('/antecedenteFamiliar/create','AntecedenteFamiliarController@create')->name('antecedenteFamiliar.create');
route::post('/antecedenteFamiliar','AntecedenteFamiliarController@store')->name('antecedenteFamiliar.store');
// route::put('/antecedenteFamiliar/{id}','AntecedenteFamiliarController@update')->name('antecedenteFamiliar.update');

// RUTAS PARA ANTECEDENTES PERSONALES
// route::resource('antecedentePersonal','AntecedentePersonalController');
route::post('/antecedentePersonal/create/empleado','AntecedentePersonalController@mostrarArea')->name('antecedentePersonal.legajoArea');
route::get('/antecedentePersonal/create','AntecedentePersonalController@create')->name('antecedentePersonal.create');
route::post('/antecedentePersonal','AntecedentePersonalController@store')->name('antecedentePersonal.store');
// route::put('/antecedentePersonal/{id}','AntecedentePersonalController@update')->name('antecedentePersonal.update');

// RUTAS PARA DONACION DE SANGRE
// route::resource('donacion','DonacionController');
route::get('/donacion','DonacionController@index')->name('donacion.index');
route::post('/donacion','DonacionController@store')->name('donacion.store');
route::put('/donacion/{id}','DonacionController@update')->name('donacion.update');

//RUTAS PARA INFORME DE ENFERMEDADES
// route::resource('informe-enfermedad','InformeEnfermedadesController');
Route::group(['middleware'=>'Medico'],function(){
route::get('/informe-enfermedad','InformeEnfermedadesController@index')->name('informe-enfermedad.index');
route::get('/informe-enfermedad/create','InformeEnfermedadesController@create')->name('informe-enfermedad.create');
route::post('/informe-enfermedad','InformeEnfermedadesController@store')->name('informe-enfermedad.store');
route::get('/informe-enfermedad/{id}/edit','InformeEnfermedadesController@edit')->name('informe-enfermedad.edit');
route::put('/informe-enfermedad/{id}','InformeEnfermedadesController@update')->name('informe-enfermedad.update');
route::post('ver-pdf2', 'InformeEnfermedadesController@verPdf')->name('informe-enfermedad.verPdf');
route::post('enviarPdf-Riesgo','InformeEnfermedadesController@enviarPdf')->name('informe-enfermedad.enviarPdf');
route::get('/enfermedadPorArea','InformeEnfermedadesController@EnfermedadesArea')->name('informe-enfermedad.enfermedadAreas');
});


// RUTAS PARA INFORME DE DONACION DE SANGRE
// route::resource('informe-donacion', 'InformeDonacionController');
Route::group(['middleware'=>'Medico'],function(){
route::get('/informe-donacion','InformeDonacionController@index')->name('informe-donacion.index');
route::get('/informe-donacion/create','InformeDonacionController@create')->name('informe-donacion.create');
route::post('pdfDonacion', 'InformeDonacionController@envioPDF')->name('informe.pdfDonacion');
route::post('ver-pdf', 'InformeDonacionController@verPdf')->name('informe.verPdf');
});

//Rutas para usuarios
// route::resource('usuarios','UserController');
// route::get('/usuarios','UserController@index')->name('usuarios.index');
// route::get('/usuarios/{id}/edit','UserController@edit')->name('usuarios.edit');
// route::put('/usuarios/{id}','UserController@update')->name('usuarios.update');
// route::get('/usuarios/{id}/delete','UserController@delete')->name('usuarios.delete');

//RUTAS PARA INFORME DE DIETAS
// route::resource('informe-dietas','InformeDietasController');
Route::group(['middleware'=>'Medico'],function(){
route::get('/informe-dietas','InformeDietasController@index')->name('informe-dietas.index');
route::get('/informe-dietas/create','InformeDietasController@create')->name('informe-dietas.create');
route::get('/informe-dietas/{id}','InformeDietasController@show')->name('informe-dietas.show');
route::post('verPdf-dietas','InformeDietasController@verPdf')->name('informe-dietas.verPdf');
route::post('enviarPdf-dietas','InformeDietasController@enviarPdf')->name('informe-dietas.enviarPdf');
route::get('/dietasEspecificas','InformeDietasController@dietasEspecificas')->name('informe-dietas.dietasEspecificas');
route::post('/editarDieta','InformeDietasController@editarDieta')->name('informe-dietas.editarDatos');
route::get('/pdfDietasEspecificas/{id}','InformeDietasController@verPdfDietasEspecificas')->name('infome-dietas.pdfDietaEspecifica');
route::get('/enviarDietasPartiulares/{id}','InformeDietasController@enviarPdfDietasEspecificas')->name('informe-dietas.enviarPdfEspecificas');
});

//Rutas para Vacunacion
// route::resource('vacunas','VacunasController');
route::get('/vacunas','VacunasController@index')->name('vacunas.index');
route::get('/vacunas/{id}','VacunasController@show')->name('vacunas.show');
route::get('/vacunas/{id}/edit','VacunasController@edit')->name('vacunas.edit');
route::get('/vacunas/{id}/mostrar','VacunasController@mostrarVacunas')->name('vacunas.mostrar');


//Ruta para Imc
// route::resource('imc','ImcController');
route::get('/imc/create','ImcController@create')->name('imc.create');
route::post('/imc','ImcController@store')->name('imc.store');
route::post('/imc/create','ImcController@guardar')->name('imc.guardar');


//ACA ME QUEDE

// Ruta para informe de contar donaciones
// route::resource('contar-donaciones', 'ContarDonacionesController');
Route::group(['middleware'=>'Medico'],function(){
route::get('contar-donaciones', 'ContarDonacionesController@index')->name('contar-donaciones.index');
route::get('contar-donaciones/create', 'ContarDonacionesController@create')->name('contar-donaciones.create');
route::post('contar-donaciones/pdfDonacion', 'ContarDonacionesController@envioPDF')->name('informe.contar-donaciones.pdfDonacion');
route::post('contar-donaciones/ver-pdf', 'ContarDonacionesController@verPdf')->name('informe.contar-donaciones.verPdf');
});


// RUTAS PARA Buscar PACIENTES DESDE DENTROD EL SISTEMA.
Route::get('/empleado/buscar',"EmpleadoController@buscar")->name('empleado.buscar');
Route::get('/empleado/{id}/datos', 'EmpleadoController@datosEmpleados')->name('empleado.datos');
Route::get('empleado/{id}/editar', 'EmpleadoController@edit')->name('empleado.edit');
// Route::match(['put','patch'],'empleado/update/{legajo}', 'EmpleadoController@update')->name('empleado.update');
Route::get('empleado/{legajo}', 'EmpleadoController@delete')->name('empleado.delete');

//RUTAS DE CONSULTAS
Route::get('/consultas','ConsultaController@indexConsulta')->name('consultas.cargarConsultas');
Route::post('/consultas/guardar','ConsultaController@guardarConsultas')->name('consultas.guardarConsultas');
Route::post('/consultas/guardar/enfermedad','ConsultaController@guardarEnfermedad')->name('consultas.guardarEnfermedad');
Route::get('/imc','ImcController@indexImc')->name('consultas.imc');

//RUTAS HISTORIA CLINICA
route::get('/historiaClinica','ConsultaController@historiaClinica')->name('consultas.historiaClinica');
route::post('/historiaClinica/particular','ConsultaController@historiaParticular')->name('consultas.historiaParticular');


//Calculo del IMC
Route::post('/imc/calculo/{id?}','ImcController@imc')->name('consultas.calculoDelImc');
Route::post('/imc/calculo/guardar','ImcController@guardarImc')->name('consultas.guardarImc');



//LOG
// Route::get('/actividades', 'ActivityLogController@index')->name('log.index');

Route::get('/denied', ['as' => 'denied', function() {
    $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
    return view('denied',compact('notificaciones','contadorNotificacion'));
}]);
