<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Rotas Pessoa
Route::get('pessoas', [PessoasController::class, 'obterPessoas']);
Route::get('pessoa/{codigoPessoa}', [PessoasController::class, 'obterPessoa']);
Route::post('pessoas',  [PessoasController::class, 'cadastrarPessoa']);