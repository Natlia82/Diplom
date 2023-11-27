<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PlaceController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/
//гость
/*Route::get('/',  function () {
    return redirect('/user/31.10.2023');
});
*/

Route::get('/', [SessionController::class, 'Index']);
//Route::get('/user/{dat}', [SessionController::class, 'datIndex']);

Route::get('/user/{dat}/cinema/{zal}/{beg}/{name}', [CinemaController::class, 'ticket']);
Route::put('/ticket', [TicketController::class, 'store']);
Route::get('/electronicTicket/{id}', [TicketController::class, 'show']);
Route::get('/qrCode/{id}', [TicketController::class, 'qrCode']);
/*Route::get('/qrCode/{id}', function () {
    return QrCode::size(100)->generate('A basic example of QR code!');
    });
*/

Route::group(['middleware' => 'auth'], function() {
    //для администратора
Route::get('/admin', [CinemaController::class, 'index']);
Route::delete('/delCinema/{id}', [CinemaController::class, 'destroy']);
Route::post('/addCinima', [CinemaController::class, 'store']);
Route::put('/priceCinima/{id}', [CinemaController::class, 'update']);
Route::put('/price/{id}', [CinemaController::class, 'show']);
Route::post('/places', [PlaceController::class, 'store']);
Route::put('/place/{id}', [PlaceController::class, 'show']);
Route::post('/addMovie', [FilmController::class, 'store']);
Route::post('/addSession', [SessionController::class, 'store']);
Route::put('/openSale', [SessionController::class, 'update']);
Route::put('/delSession/{id}', [SessionController::class, 'destroy']);
Route::get('/delFilm/{id}', [FilmController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
