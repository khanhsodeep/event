<?php
use RealRashid\SweetAlert\Facades\Aler;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\QrCodeGeneratorController;

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
    $event_hot = DB::table('event')->where('status', 1)->take(6)->orderBy('id', 'desc')->get();
    $event_favourite = DB::table('event')->orderBy('member', 'DESC')->where('status', 1)->take(3)->get();
    $data = [
        'event_hot' => $event_hot,
        'event_favourite' => $event_favourite
    ];
    return view('/home', $data);
});

// Route::get('/', 'HomeController@getWelcomer')->name('client.welcome');


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home/qr-code/{id}', 'QrCodeGeneratorController@getTicket')->name('user.home.qr-code');

Route::get('/admin/attendance', 'EventEventController@getEventAttendance')->name('admin.attendance.attendance');
Route::get('/admin/attendance/{id}', 'QrCodeGeneratorController@getscanqrcode')->name('admin.attendance');
Route::post('/admin/attendance/{id}', 'QrCodeGeneratorController@postscanqrcode')->name('admin.attendance');
Route::get('/admin/attendance/export-excel/{id}', 'QrCodeGeneratorController@exportExcel')->name('admin.attendance.export-excel');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/profile/{id?}', 'HomeController@userProfile')->name('/home/profile');

Route::get('/admin/login', 'AdminController@getLoginAdmin')->name('admin.login');
Route::post('/admin/login', 'AdminController@postLoginAdmin');

Route::get('/admin/dashboard', 'AdminController@getDashboard')->name('admin.dashboard.dashboard');

Route::get('/admin/user', 'UserController@getList')->name('admin.user');
Route::get('/admin/user/add', 'UserController@getAdd')->name('admin.user.add');
Route::post('/admin/user/add', 'UserController@postAdd');
Route::get('/admin/user/edit/{id}', 'UserController@getEdit')->name('admin.user.edit');
Route::put('/admin/user/edit/{id}', 'UserController@postEdit')->name('admin.user.edit');
Route::get('/admin/user/delete/{id}', 'UserController@getDelete')->name('admin.user.delete');

Route::get('/admin/event', 'EventEventController@getList')->name('admin.event');
Route::get('/admin/event/add', 'EventEventController@getAdd')->name('admin.event.add');
Route::post('/admin/event/add', 'EventEventController@postAdd');
Route::get('/admin/event/edit/{id}', 'EventEventController@getEdit')->name('admin.event.edit');
Route::put('/admin/event/edit/{id}', 'EventEventController@postEdit')->name('admin.event.edit');
Route::get('/admin/event/delete/{id}', 'EventEventController@getDelete')->name('admin.event.delete');

Route::get('/admin/profile', 'UserController@getProfile')->name('admin.profile');
Route::put('/admin/profile', 'UserController@editProfile')->name('admin.edit.profile');

Route::post('/home/profile', 'UserController@postEventUser')->name('users.profile');

Route::get('/event/add', 'UserController@getEventUser')->name('user.event.add');
Route::post('/event/add', 'UserController@postEventUser');

Route::put('/home/profile', 'UserController@editUserClient');

Route::get('/event/detail/{id}', 'EventEventController@getEventDetail')->name('user.event.detail');
Route::post('/event/detail/{id}', 'EventEventController@postEventDetail');

Route::get('/admin/logout', 'AdminController@getAdminLogout')->name('admin.logout');

Route::get('/event/ranking', 'EventEventController@getRankingEvent');

Route::get('/event/category/{id}', 'EventEventController@getEventCategory')->name('client.category');

Route::get('/event/delete/{id}', 'EventEventController@deleteEventUser')->name('client.event.delete');
Route::get('/ticket/delete/{id}', 'EventEventController@DeleteTicket')->name('client.ticket.delete');

// route edit of user & admin
Route::get('/event/edit/{id}', 'EventEventController@editEventUser')->name('client.event.edit');
Route::put('/event/edit/{id}', 'EventEventController@putEventUser')->name('client.event.put');

// route quên mk
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::post('/subscribe','HomeController@subscribe')->name('subscribe');

