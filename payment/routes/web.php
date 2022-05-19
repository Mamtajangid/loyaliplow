<?php

use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SelController;
use App\Http\Controllers\VlogController;
use App\Http\Controllers\YourModelNameController;
use App\Http\Controllers\CustomValRuleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


Route::get('/payment',[MainController::class,'index'])->name('pay.with.razorpay');
Route::get('/success',[MainController::class,'success']);
Route::post('/payment',[MainController::class,'payment'])->name('payment')->middleware('throttle:Visit_Limit');

Route::resource('image', ImageController::class);
Route::get('/index',[SelController::class,'index']);
Route::get('in',[YourModelNameController::class,'in']);


// ** contract create
Route::get('/welcome',function(Factory $cache){
    $cache->put("name","xjkdfhui");
    dd($cache->get("name"));
});

// ** required conditions
Route::resource('vlog', VlogController::class,['names'=>'vlog']);

// *** spatie roles
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

// ***custom validation
Route::get('customValiRule', [CustomValRuleController::class,'customValiRule']);
Route::post('customValiRulePost', [CustomValRuleController::class,'customValiRulePost']);

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::resource('usertype', UserTypeController::class);