<?php

use App\Models\Municipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* AUTHENTICATION */
Route::get('/login', 'MainController@loginForm')->name('login.form');
Route::post('/login', 'MainController@login')->name('login.done');
Route::get('/logout', 'MainController@logout')->name('logout');
Route::get('/', 'MainController@home')->name('home');
/* Usuários */
Route::get('/usuarios/registo', 'UserController@registerForm')->name('user.register.form');
Route::post('/usuarios/registo', 'UserController@register')->name('user.register');
Route::get('/usuarios/{id}/actualizacao', 'UserController@editForm')->name('user.edit.form');
Route::put('/usuarios/{id}/actualizacao', 'UserController@edit')->name('user.edit');
Route::post('/usuarios/remocao', 'UserController@remover')->name('user.remove');
Route::get('/usuarios', 'UserController@list')->name('user.list');
Route::Post('/usuarios/actualizacao-de-senha', 'UserController@changePassword')->name('user.change.password');

/* Funcionários */
Route::get('/funcionarios/registo', 'WorkerController@registerForm')->name('worker.register.form');
Route::post('/funcionarios/registo', 'WorkerController@register')->name('worker.register');
Route::get('/funcionarios', 'WorkerController@list')->name('worker.list');
Route::post('/funcionarios/remocao', 'WorkerController@remover')->name('worker.remove');
Route::get('/funcionarios/{id}/actualizacao', 'WorkerController@editForm')->name('worker.edit.form');
Route::put('/funcionarios/{id}/actualizacao', 'WorkerController@edit')->name('worker.edit');
Route::Post('/funcionarios/actualizacao-de-fotografia', 'WorkerController@changePhoto')->name('worker.change.photo');

/* Clientes */
Route::get('/clientes/registo', 'ClientController@registerForm')->name('client.register.form');
Route::post('/clientes/registo', 'ClientController@register')->name('client.register');
Route::get('/clientes', 'ClientController@list')->name('client.list');
Route::post('/clientes/remocao', 'ClientController@remover')->name('client.remove');
Route::get('/clientes/{id}/actualizacao', 'ClientController@editForm')->name('client.edit.form');
Route::put('/clientes/{id}/actualizacao', 'ClientController@edit')->name('client.edit');
Route::get('/pagamentos/registo', 'ClientController@paymentRegisterForm')->name('payment.register.form');
Route::post('/pagamentos/registo', 'ClientController@paymentRegister')->name('payment.register');
Route::get('/pagamentos', 'ClientController@payments')->name('payment.list');
Route::get('/pagamentos-anuais', 'ClientController@relatoryPaymentsByYear')->name('payment.relatory.year');
Route::POST('/pagamentos-anuais', 'ClientController@relatoryPaymentsByYear')->name('payment.relatory.year.filter');
Route::get('/pagamentos-em-atraso', 'ClientController@relatoryGetClientsByDebt')->name('payment.relatory.debt');
Route::get('/pagamentos-regularizado', 'ClientController@relatoryGetClientsByPaid')->name('payment.relatory.paid');
Route::get('/historico-de-pagamentos', 'ClientController@historics')->name('historic.list');

 /* POPULAR PROVÍNCIA/MUNICÍPIO */
 Route::get('/ajax-subcat', function ( Request $request ) {
    $province_id = $request->input('province_id');
    $subcategoria = Municipe::where('province_id', '=', $province_id)->get();
    return Response::json($subcategoria);
});


