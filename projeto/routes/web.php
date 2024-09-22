<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\Forma_pagamentoController;
use App\Http\Controllers\VendaController;

Route::redirect('', 'vendedores');
Route::resource('vendas', VendaController::class);
Route::resource('itens', VendaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('vendedores', VendedorController::class);
Route::resource('formas_pagamento', Forma_pagamentoController::class);
