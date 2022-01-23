<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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
Route::get('/onSelect', [TestController::class, 'changeOption'])->name('onSelect');

Auth::routes();

Route::middleware('auth')->group(function () {
    // Project
    Route::get('/dashboard', function(){return redirect()->route('project.index');});
    Route::resource('project', ProjectController::class);
    Route::post('addMember', [ProjectController::class, 'addMember'])->name('project.addMember');
    Route::post('kickMember', [ProjectController::class, 'kickMember'])->name('project.kickMember');
    Route::get('/updateRole', [ProjectController::class, 'updateMember'])->name('project.updateMember');
    Route::post('export', [ProjectController::class, 'exportProject'])->name('project.export');


    // Dashboard profile user
    Route::resource('profile', UserController::class);
    Route::get('/profile/edit/password', [UserController::class, 'editPassword'])->name('profile.passwordEdit');
    Route::post('/profile/edit/password', [UserController::class, 'updatePassword'])->name('profile.passwordUpdate');

    // Task Controller
    Route::resource('task', TaskController::class);
    Route::get('/taskupdate', [TaskController::class, 'toUpdate']);
    Route::get('/taskAssign', [TaskController::class, 'assignUser']);
    Route::get('task/{task}/{project_id}', [TaskController::class, 'show'])->name('task.show');

});
