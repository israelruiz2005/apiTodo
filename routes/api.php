<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Inicio da API todo
Route::get('/ola', function(){
    return ['voltei'=>'Olá Mundo novo!'];
});

//Cria tarefa
Route::post('/todo',[ApiController::class,'createTodo']);
//Pesquisa tarefas
Route::get('/todos',[ApiController::class,'readAllTodos']);
//Pesquisa por uma tarefa
Route::get('/todo/{id}',[ApiController::class,'readTodo']);
// Atualiza uma tarefa
Route::put('/todo/{id}',[ApiController::class,'updateTodo']);
//Deleta uma tarefa
Route::delete('/todo/{id}',[ApiController::class,'deleteTodo']);