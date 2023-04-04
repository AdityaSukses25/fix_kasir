<?php

use App\Http\Controllers\DashboardPostController;
use App\Models\User;
use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

// login
Route::get('/', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware(
    'guest'
);
Route::post('/register', [RegisterController::class, 'store']);

// reception
Route::get(
    '/reception',
    'App\Http\Controllers\ReceptionController@index'
)->middleware('admin');

Route::get('/order', 'App\Http\Controllers\OrderController@index')->middleware(
    'reception'
);

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

    // therapist
    Route::get('/therapist', 'App\Http\Controllers\TherapistController@index');
    Route::post(
        '/therapist/create',
        'App\Http\Controllers\TherapistController@store'
    );
    Route::put(
        '/therapist/edit/{Therapist}',
        'App\Http\Controllers\TherapistController@update'
    );
    Route::get(
        '/terapist/delete/{Therapist}',
        'App\Http\Controllers\TherapistController@updateDelete'
    );

    // reception
    Route::post(
        '/reception/create',
        'App\Http\Controllers\ReceptionController@store'
    );
    Route::put(
        '/reception/edit/{User}',
        'App\Http\Controllers\ReceptionController@update'
    );
    Route::get(
        '/reception/delete/{User}',
        'App\Http\Controllers\ReceptionController@destroy'
    );

    // service
    // ---- masssage
    Route::get('/service', 'App\Http\Controllers\ServiceController@index');
    Route::post(
        '/service/create',
        'App\Http\COntrollers\ServiceController@store'
    );
    Route::put(
        '/service/edit/{Service}',
        'App\Http\Controllers\ServiceController@update'
    );
    Route::get(
        '/service/delete/{Service}',
        'App\Http\Controllers\ServiceController@destroy'
    );

    // ---- place
    Route::post(
        '/place/create',
        'App\Http\Controllers\ServiceController@storePlace'
    );
    Route::put(
        '/place/edit/{Place}',
        'App\Http\Controllers\ServiceController@updatePlace'
    );
    Route::get(
        '/place/delete/{Place}',
        'App\Http\Controllers\ServiceController@destroyPlace'
    );

    // discount
    Route::post(
        '/discount/create',
        'App\Http\Controllers\ServiceController@storeDiscount'
    );
    Route::put(
        '/discount/edit/{Discount}',
        'App\Http\Controllers\ServiceController@updateDiscount'
    );
    Route::get(
        '/discount/delete/{Discount}',
        'App\Http\Controllers\ServiceController@destroyDiscount'
    );

    // order

    // therapist dinamic dropdown
    Route::get(
        '/getTherapist/{id}',
        'App\Http\Controllers\OrderController@therapist'
    );
    Route::post('/order/create', 'App\Http\Controllers\OrderController@store');
    Route::get(
        '/order/showService',
        'App\Http\Controllers\OrderController@index'
    );
    Route::put(
        '/order/edit/{Order}',
        'App\Http\Controllers\OrderController@update'
    );
    Route::put(
        '/extratime/edit/{ExtraTime}',
        'App\Http\Controllers\OrderController@updateExtra'
    );
    Route::get(
        '/order/sort/{sortBy}',
        'App\Http\Controllers\OrderController@index'
    )->name('order.sort');
    Route::get(
        '/order/finish/{Order}',
        'App\Http\Controllers\OrderController@finish'
    );
    Route::get(
        '/extraTime/finish/{ExtraTime}',
        'App\Http\Controllers\OrderController@finishExtra'
    );

    // customer
    Route::get(
        '/transaction-record',
        'App\Http\Controllers\CustomerController@index'
    );

    // report
    Route::get('/report', 'App\Http\Controllers\ReportController@index');
    // salary-detail
    Route::get(
        '/report/salary-detail{therapist:id}',
        'App\Http\Controllers\SalaryDetailController@index'
    );

    // pdf
    Route::get('/pdf-sales', 'App\Http\Controllers\PDFController@index');
    Route::get(
        '/pdf-salary',
        'App\Http\Controllers\ReportController@printSalary'
    );
    Route::get(
        '/pdf-salary-detail{therapist:id}',
        'App\Http\Controllers\SalaryDetailController@printSalaryDetail'
    );

    // edit-personal
    Route::put(
        '/user-personal/edit/{User}',
        'App\Http\Controllers\ReceptionController@updatePersonal'
    );
});
