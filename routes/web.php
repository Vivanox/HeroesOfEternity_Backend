<?php

use App\Http\Controllers\AlphaSignUpController;
use App\Http\Controllers\AssignAlphaKey;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('alpha-sign-ups', [AlphaSignUpController::class, 'index'])
    ->middleware('auth')
    ->name('alpha-sign-ups.index');

Route::post('alpha-sign-up/{alphaSignUp}/assign-alpha-key', 'AssignAlphaKey')
    ->middleware('auth')
    ->name('alpha-sign-up.assign-alpha-key');
