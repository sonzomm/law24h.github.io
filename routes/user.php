<?php

use Illuminate\Support\Facades\Route;


Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });


        Route::get('register',[\App\Http\Controllers\User\Auth\RegisterController::class,'showRegistrationForm'] )->name('register');
        Route::post('register',[\App\Http\Controllers\User\Auth\RegisterController::class,'register'] )->middleware('registration.status');
        Route::post('check-mail',[\App\Http\Controllers\User\Auth\RegisterController::class,'checkUser'] )->name('checkUser');


    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset',[\App\Http\Controllers\User\Auth\ForgotPasswordController::class,'showLinkRequestForm'] )->name('request');
        Route::post('email',[\App\Http\Controllers\User\Auth\ForgotPasswordController::class,'sendResetCodeEmail'] )->name('email');
        Route::get('code-verify',[\App\Http\Controllers\User\Auth\ForgotPasswordController::class,'codeVerify'] )->name('code.verify');
        Route::post('verify-code',[\App\Http\Controllers\User\Auth\ForgotPasswordController::class,'verifyCode'] )->name('verify.code');
    });

    Route::controller('ResetPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::post('reset', 'reset')->name('update');
        Route::get('reset/{token}', 'showResetForm')->name('reset');
    });
});

Route::name('user.')->group(function () {
    Route::middleware('auth')->group(function () {
        //authorization
        Route::namespace('User')->controller('AuthorizationController')->group(function () {
            Route::get('authorization', 'authorizeForm')->name('authorization');
            Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
            Route::post('verify-email', 'emailVerification')->name('verify.email');
        });

        Route::middleware(['check.status'])->group(function () {

            Route::get('user-data', 'User\UserController@userData')->name('data');
            Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

            Route::middleware('registration.complete')->namespace('User')->group(function () {

                Route::controller('UserController')->group(function () {
                    Route::get('dashboard', 'home')->name('home');
                    Route::any('payment/history', 'depositHistory')->name('deposit.history');
                    Route::get('transactions', 'transactions')->name('transactions');
                    Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
                });

                Route::controller('BookingController')->prefix('booking')->name('booking.')->group(function () {
                    Route::get('requests', 'bookingRequestList')->name('request.all');
                    Route::get('my-bookings', 'allBookings')->name('all');
                    Route::get('payment/{id}', 'payment')->name('payment');
                    Route::get('details/{id}', 'bookingDetails')->name('details');
                    Route::post('request/cancel/{id}', 'cancelBookingRequest')->name('request.cancel');
                });

                //Profile setting
                Route::controller('ProfileController')->group(function () {
                    Route::get('profile-setting', 'profile')->name('profile.setting');
                    Route::post('profile-setting', 'submitProfile');
                    Route::get('change-password', 'changePassword')->name('change.password');
                    Route::post('change-password', 'submitPassword');
                });
            });


                Route::any('payment/', [\App\Http\Controllers\Gateway\PaymentController::class,'deposit'])->name('deposit.index');
                Route::post('payment/insert',[\App\Http\Controllers\Gateway\PaymentController::class,'depositInsert'] )->name('deposit.insert');
                Route::get('payment/confirm',[\App\Http\Controllers\Gateway\PaymentController::class,'depositConfirm'] )->name('deposit.confirm');
                Route::get('payment/manual',[\App\Http\Controllers\Gateway\PaymentController::class,'manualDepositConfirm'] )->name('deposit.manual.confirm');
                Route::post('payment/manual',[\App\Http\Controllers\Gateway\PaymentController::class,'manualDepositUpdate'] )->name('deposit.manual.update');

        });
    });
});
