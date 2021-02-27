<?php

//use App\Http\Livewire\Itempajaks;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pajaks;
use App\Http\Livewire\Items;
use App\Http\Livewire\ItemPajaks;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('pajak', Pajaks::class)->name('pajak');
    Route::get('item', Items::class)->name('item');
    Route::get('itempajak/{id}', ItemPajaks::class)->name('itempajak');
    Route::get('itempajak', ItemPajaks::class)->name('itempajak');
});
