<?php

use App\Http\Controllers\AuthorController;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prehled-knih',function() {
    return view('knihy');
})->name("prehled");

Route::get("/autori", [AuthorController::class,"vratAutory"])->name("autori");

Route::post("/autori-pridat", [AuthorController::class,"pridatAutora"])->name("pridej-autora");

Route::get("/smaz-autora/{id}", [AuthorController::class, "delete"])->name("minusAutor");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get("/users", function() {
        $users = User::all();

        return view("users", ["uzivatele" => $users]);
    });
});
