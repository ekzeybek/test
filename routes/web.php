<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Middleware\CheckAdmin;
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
Route::group(['prefix'=>'auth'],function() {
  Route::get('logout',[PostController::class, 'logout'])->name('logout');
  Auth::routes(['verify' => true]);
});





/* ADMİN KULLANICI İŞLEMLERİ */
Route::middleware([CheckAdmin::class])->group(function(){
  Route::get('users',[UserController::class, 'show'])->name('users');
  Route::get('users/edit/{id}',[UserController::class, 'edit'])->name('useredit');
  Route::post('users/update',[UserController::class, 'update'])->name('userupdate');
  Route::get('users/delete/{id}',[UserController::class, 'delete'])->name('userdelete');
  Route::get('users/create',[UserController::class, 'create'])->name('usercreate');
  Route::post('users/store',[UserController::class, 'store'])->name('userstore');
  });
  


Route::get('userposts', [HomeController::class, 'userposts'])->name('userposts');
Route::get('post/create', [HomeController::class, 'postscreate'])->name('postscreate');
Route::post('post/store', [HomeController::class, 'poststore'])->name('poststore');
Route::get('post/delete/{id}',[HomeController::class, 'delete'])->name('postdelete');
Route::get('post/edit/{id}',[HomeController::class, 'edit'])->name('postedit');
Route::post('post/update',[HomeController::class, 'update'])->name('postupdate');
Route::post('/ckeditorupload',[HomeController::class, 'ckeditorupload'])->name('ckeditor.upload');




Route::controller(UserRoleController::class)->group(function(){  
Route::get('userhome', 'index')->name('userhome')->middleware(["verified"]);
Route::post('/postcomments', 'postcomments')->name('yorumyap');
Route::get('/yorumsil/{id}', 'yorumsil')->name('yorumsil');
});




Route::controller(PostController::class)->group(function(){  
Route::get('/', 'index')->name('home');
Route::get('posts','index');
Route::get('/getcomments', 'getcomments')->name('yorumgetir');
Route::get('{slug}','show')->name('slugshow');
});






