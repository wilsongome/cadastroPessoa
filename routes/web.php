<?php

use App\Http\Controllers\PessoaController;
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

Route::get('/', function(){
   return redirect()->route('pessoa.index');
}); 

Route::get('/pessoa', [PessoaController::class, 'index'])->name('pessoa.index');
Route::post('/pessoa', [PessoaController::class, 'store'])->name('pessoa.store');
Route::get('/pessoa/create', [PessoaController::class, 'create'])->name('pessoa.create');
Route::get('/pessoa/{id}/edit', [PessoaController::class, 'edit'])->name('pessoa.edit');
Route::put('/pessoa/{id}', [PessoaController::class, 'update'])->name('pessoa.update');
Route::delete('/pessoa/{id}', [PessoaController::class, 'delete'])->name('pessoa.delete');

