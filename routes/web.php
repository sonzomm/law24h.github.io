<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});


// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('/new', 'openSupportTicket')->name('open');
    Route::post('/create', 'storeSupportTicket')->name('store');
    Route::get('/view/{ticket}', 'viewTicket')->name('view');
    Route::post('/reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('/close/{ticket}', 'closeTicket')->name('close');
    Route::get('/download/{ticket}', 'ticketDownload')->name('download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');


Route::controller('SiteController')->group(function () {
    Route::get(('/gioithieu'),'gioithieu')->name('gioithieu');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');

    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('room-type-filter', 'filterRoomType')->name('room.type.filter');

    Route::get('updates', 'blog')->name('blog');
    Route::get('full-article/{slug}/{id}', 'blogDetails')->name('blog.details');
    Route::get('book-online', 'roomTypes')->name('room.types');
    Route::get('room-type/{id}/{slug}', 'roomTypeDetails')->name('room.type.details');
    Route::get('room-search', 'checkRoomAvailability')->name('room.available.search');

    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');

    Route::post('send-booking-request', 'sendBookingRequest')->name('request.booking');

    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
    Route::post('subscribe', 'subscribe')->name('subscribe');


});

Route::get('faq',[\App\Http\Controllers\VideoController::class,'faq'])->name('faq');
Route::get('video',[\App\Http\Controllers\VideoController::class,'index'])->name('video.index');
Route::get('video/create',[\App\Http\Controllers\VideoController::class,'create'])->name('video.create');
Route::post('video/store',[\App\Http\Controllers\VideoController::class,'store'])->name('video.add');
Route::get('video/{video}/edit',[\App\Http\Controllers\VideoController::class,'edit'])->name('video.edit');
Route::put('video/{video}/edit',[\App\Http\Controllers\VideoController::class,'update'])->name('video.put');
Route::delete('video/{video}/delete',[\App\Http\Controllers\VideoController::class,'destroy'])->name('video.destroy');
Route::get('video/show',[\App\Http\Controllers\VideoController::class,'show'])->name('video.show');
