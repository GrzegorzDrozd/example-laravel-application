<?php

use App\Http\Controllers\Auth\ActivateAccount;
use App\Http\Controllers\Auth\AuthorizeDevice;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\LogoffController;
use App\Http\Controllers\PasswordRecovery\FormController;
use App\Http\Controllers\PasswordRecovery\ResetPassword;
use App\Http\Controllers\Registration\CreateUserController;
use App\Http\Controllers\Registration\RegisterFormController;
use App\Http\Controllers\Registration\SendAccountActivationMessage;
use App\Http\Controllers\TermsAndConditions\AcceptController;
use App\Http\Controllers\TermsAndConditions\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/home');
Route::view('/home', 'welcome')->name('home');
Route::view('/login', 'login.login')->name('login_form');
Route::get('/logoff', LogoffController::class)->name('logoff');

##############
// device authorization routes:
// inform user that he needs to authorize device that he is using and that email with a link has been sent
Route::view('/confirm_authorize_device', 'login.authorize_device')->name('authorize_device_prompt');
// perform actual authorization
Route::get('/authorize_device/{token}',
    AuthorizeDevice::class
)->middleware(['signed'])->name('authorize_device');


Route::post('/login', LoginController::class)->name('login');
Route::get('/register', RegisterFormController::class)->name('register');
Route::post('/register', CreateUserController::class)->name('create_user');
Route::view('/forgot_my_password', 'password_recovery.start_form')->name('password.request');
Route::post('/forgot_my_password', FormController::class)->name('password.email');
Route::get('/set_new_password/{token}', function (string $token, Request $request) {
    return view('password_recovery.set_new_password_form', ['token' => $token, 'email'=>$request->validate(['email'=>'required|email'])['email']]);
})->name('password.reset');
Route::post('/set_new_password', ResetPassword::class)->name('password.update');


Route::get('/terms', [ViewController::class, 'view'])->name('view_terms_and_conditions');
Route::get('/terms/updated', [ViewController::class, 'preview'])->name('view_updated_terms_and_conditions');
Route::post('/terms/accept', AcceptController::class)->name('accept_terms_and_conditions');


// demo page that requires user to be logged in AND his email address to be verified.
Route::view('/restricted', 'restricted_page')->middleware(['auth', 'verified'])->name('restricted_page_demo');



##########################################################
// default routes for account verification in Laravel

// this page is displayed when user DID not verify his email yet but middleware ('verified') requires that.
Route::view('/email/verify', 'login.activate_account_prompt')->middleware('auth')->name('verification.notice');

// this action is called after user submits form on 'verification.notice' page. It sends verification email.
Route::post('/email/verify',
    SendAccountActivationMessage::class
)->middleware('auth')->name('verification.notice.send');

// actual action called from email - this is where account email verification is marked in a database
Route::get('/email/verify/{id}/{hash}',
    ActivateAccount::class
)->middleware(['signed'])->name('verification.verify');
