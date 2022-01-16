<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
    return view('welcome');
})->name('welcome');


Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/onStatus', [TestController::class, 'changeStatus'])->name('onStatus');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/my-task', function(){return view('dashboard.mytask',  ['pageTitle' => 'mytask']);})->name('mytask');
    Route::get('/dashboard', function(){return redirect()->route('project.index');});
    Route::resource('project', ProjectController::class);

    // Dashboard profile user
    Route::resource('profile', UserController::class);
    Route::get('/profile/edit/password', [UserController::class, 'editPassword'])->name('profile.passwordEdit');
    Route::post('/profile/edit/password', [UserController::class, 'updatePassword'])->name('profile.passwordUpdate');
});
