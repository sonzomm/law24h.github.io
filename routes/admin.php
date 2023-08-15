<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });
    // Admin Password Reset
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('reset');
        Route::post('reset', 'sendResetCodeEmail');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'reset')->name('password.change');
    });
});

Route::middleware('admin')->group(function () {

    Route::controller('ExtensionController')->name('extensions.')->group(function () {
        Route::get('/extension', 'index')->name('index');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('status/{id}', 'status')->name('status');
    });


    Route::get('video',[\App\Http\Controllers\VideoController::class,'index'])->name('video.index');
    Route::get('video/create',[\App\Http\Controllers\VideoController::class,'create'])->name('video.create');
    Route::post('video/store',[\App\Http\Controllers\VideoController::class,'store'])->name('video.add');
    Route::get('video/{video}/edit',[\App\Http\Controllers\VideoController::class,'edit'])->name('video.edit');
    Route::put('video/{video}/edit',[\App\Http\Controllers\VideoController::class,'update'])->name('video.put');
    Route::delete('video/{video}/delete',[\App\Http\Controllers\VideoController::class,'destroy'])->name('video.destroy');
    Route::get('video/show',[\App\Http\Controllers\VideoController::class,'show'])->name('video.show');


    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');
        Route::get('dashboard', 'dashboard')->name('staff');
        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');

    });




    Route::controller('RolesController')->prefix('roles')->name('roles.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('save/{id?}', 'save')->name('save');
    });

    // Users Manager
    Route::controller('ManageUsersController')->name('users.')->prefix('guests')->group(function () {
        Route::get('all', 'allUsers')->name('all');
        Route::get('active', 'activeUsers')->name('active');
        Route::get('banned', 'bannedUsers')->name('banned');
        Route::get('email-verified', 'emailVerifiedUsers')->name('email.verified');
        Route::get('email-unverified', 'emailUnverifiedUsers')->name('email.unverified');
        Route::get('detail/{id}', 'detail')->name('detail');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('login/{id}', 'login')->name('login');
        Route::post('status/{id}', 'status')->name('status');
        Route::get('send-notification', 'showNotificationAllForm')->name('notification.all');
        Route::post('send-notification', 'sendNotificationAll')->name('notification.all.send');
    });

    Route::name('hotel.')->prefix('hotel')->group(function () {
        Route::controller('AmenitiesController')->name('amenity.')->prefix('amenities')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
        });
        //Bed Type
        Route::controller('BedTypeController')->name('bed.')->prefix('bed-list')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('delete/{id}', 'delete')->name('delete');
        });

        //Complement
        Route::controller('ComplementController')->name('complement.')->prefix('complements')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
        });

        //Room Type
        Route::controller('RoomTypeController')->name('room.type.')->prefix('room-type')->group(function () {
            Route::get('', 'index')->name('all');
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
        });

        //Room
        Route::controller('RoomController')->name('room.')->prefix('room')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('update/status/{id}', 'status')->name('status');
        });

        //Extra Services
        Route::controller('ExtraServiceController')->name('extra_services.')->prefix('extra-service')->group(function () {
            Route::get('', 'index')->name('all');
            Route::post('save/{id?}', 'save')->name('save');
            Route::post('status/{id}', 'status')->name('status');
        });
    });

    Route::controller('BookRoomController')->group(function () {
        Route::get('book-room', 'room')->name('book.room');
        Route::post('room-book', 'book')->name('room.book');
        Route::get('room/search', 'searchRoom')->name('room.search');
    });

    //Manage Reservation
    Route::controller('BookingController')->group(function () {
        Route::name('booking.')->prefix('booking')->group(function () {
            Route::post('booking-merge/{id}', 'mergeBooking')->name('merge');

            Route::get('bill-payment/{id}', 'paymentView')->name('payment');
            Route::post('bill-payment/{id}', 'payment')->name('payment');

            Route::get('booking-checkout/{id}', 'checkOutPreview')->name('checkout');
            Route::post('booking-checkout/{id}', 'checkOut')->name('checkout');

            Route::get('booked-rooms/{id}', 'bookedRooms')->name('booked.rooms');
            Route::get('extra-service/details/{id}', 'extraServiceDetail')->name('service.details');

            Route::get('details/{id}', 'bookingDetails')->name('details');
            Route::get('booking-invoice/{id}',[\App\Http\Controllers\Admin\ManageBookingController::class,'generateInvoice'])->name('invoice');

            Route::post('key/handover/{id}', 'handoverKey')->name('key.handover');
        });
    });

    Route::name('booking.')->prefix('booking')->group(function () {
        Route::controller('BookingController')->group(function () {
            Route::get('all-bookings', 'allBookingList')->name('all');
            Route::get('approved', 'activeBookings')->name('active');
            Route::get('canceled-bookings', 'canceledBookingList')->name('canceled.list');
            Route::get('checked-out-booking', 'checkedOutBookingList')->name('checked.out.list');
            Route::get('todays/booked-room', 'todaysBooked')->name('todays.booked');
            Route::get('todays/check-in', 'todayCheckInBooking')->name('todays.checkin');
            Route::get('todays/checkout', 'todayCheckoutBooking')->name('todays.checkout');
            Route::get('refundable', 'refundableBooking')->name('refundable');
            Route::get('checkout/delayed', 'delayedCheckout')->name('checkout.delayed');
            Route::get('details/{id}', 'bookingDetails')->name('details');
            Route::get('booked-rooms/{id}', 'bookedRooms')->name('booked.rooms');
        });

        Route::controller('ManageBookingController')->group(function () {
            Route::post('key/handover/{id}', 'handoverKey')->name('key.handover');
            Route::post('booking-merge/{id}', 'mergeBooking')->name('merge');
            Route::get('bill-payment/{id}', 'paymentView')->name('payment');
            Route::post('bill-payment/{id}', 'payment')->name('payment');
            Route::post('add-charge/{id}', 'addExtraCharge')->name('extra.charge.add');
            Route::post('subtract-charge/{id}', 'subtractExtraCharge')->name('extra.charge.subtract');
            Route::get('booking-checkout/{id}', 'checkOutPreview')->name('checkout');
            Route::post('booking-checkout/{id}', 'checkOut')->name('checkout');
            Route::get('extra-service/details/{id}', 'extraServiceDetail')->name('service.details');
            Route::get('booking-invoice/{id}', 'generateInvoice')->name('invoice');
        });


            Route::get('cancel/{id}',[\App\Http\Controllers\Admin\CancelBookingController::class,'cancelBooking'] )->name('cancel');
            Route::post('cancel-full/{id}',[\App\Http\Controllers\Admin\CancelBookingController::class,'cancelFullBooking'] )->name('cancel.full');
            Route::post('booked-room/cancel/{id}',[\App\Http\Controllers\Admin\CancelBookingController::class,'cancelSingleBookedRoom'] )->name('booked.room.cancel');
            Route::post('cancel-booking/{id}',[\App\Http\Controllers\Admin\CancelBookingController::class,'cancelBookingByDate'] )->name('booked.day.cancel');

    });

    Route::controller('BookingController')->prefix('booking')->group(function () {
        Route::get('upcoming/check-in', 'upcomingCheckIn')->name('upcoming.booking.checkin');
        Route::get('upcoming/checkout', 'upcomingCheckout')->name('upcoming.booking.checkout');
        Route::get('pending/check-in', 'pendingCheckIn')->name('pending.booking.checkin');
        Route::get('delayed/checkout', 'delayedCheckouts')->name('delayed.booking.checkout');
    });

    Route::controller('BookingExtraServiceController')->prefix('extra-service')->name('extra.service.')->group(function () {
        Route::get('all', 'list')->name('list');
        Route::get('add-new', 'addNew')->name('add');
        Route::post('add', 'addService')->name('save');
        Route::post('delete/{id}', 'delete')->name('delete');
    });

    Route::controller('ManageBookingRequestController')->prefix('booking')->name('request.booking.')->group(function () {
        Route::get('requests', 'index')->name('all');
        Route::get('request/canceled', 'canceledBookings')->name('canceled');
        Route::get('request/approve/{id}', 'approve')->name('approve');
        Route::post('request/cancel/{id}', 'cancel')->name('cancel');
        Route::post('assign-room', 'assignRoom')->name('assign.room');
    });

    // Subscriber
    Route::controller('SubscriberController')->prefix('subscriber')->name('subscriber.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('send-email', 'sendEmailForm')->name('send.email');
        Route::post('remove/{id}', 'remove')->name('remove');
        Route::post('send-email', 'sendEmail')->name('send.email');
    });


    // Deposit Gateway
    Route::name('gateway.')->prefix('gateway')->group(function () {
        // Automatic Gateway
        Route::controller('AutomaticGatewayController')->prefix('automatic')->name('automatic.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{code}', 'update')->name('update');
            Route::post('remove/{id}', 'remove')->name('remove');
            Route::post('status/{id}', 'status')->name('status');
        });

        // Manual Methods
        Route::controller('ManualGatewayController')->prefix('manual')->name('manual.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('new', 'create')->name('create');
            Route::post('new', 'store')->name('store');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('status/{id}', 'status')->name('status');
        });
    });
    // PAYMENT SYSTEM
        Route::get('payment/',[\App\Http\Controllers\Admin\DepositController::class,'deposit'] )->name('deposit.list');
        Route::get('payment/pending',[\App\Http\Controllers\Admin\DepositController::class,'pending'] )->name('deposit.pending');
        Route::get('payment/rejected',[\App\Http\Controllers\Admin\DepositController::class,'rejected'] )->name('deposit.rejected');
        Route::get('payment/approved',[\App\Http\Controllers\Admin\DepositController::class,'approved'] )->name('deposit.approved');
        Route::get('payment/successful',[\App\Http\Controllers\Admin\DepositController::class,'successful'] )->name('deposit.successful');
        Route::get('payment/failed',[\App\Http\Controllers\Admin\DepositController::class,'failed'] )->name('deposit.failed');
        Route::get('payment/details/{id}',[\App\Http\Controllers\Admin\DepositController::class,'details'] )->name('deposit.details');
        Route::post('payment/reject',[\App\Http\Controllers\Admin\DepositController::class,'reject'] )->name('deposit.reject');
        Route::post('payment/approve/{id}',[\App\Http\Controllers\Admin\DepositController::class,'approve'] )->name('deposit.approve');

    // Admin Support
    Route::controller('SupportTicketController')->prefix('ticket')->name('ticket.')->group(function () {
        Route::get('/', 'tickets')->name('index');
        Route::get('pending', 'pendingTicket')->name('pending');
        Route::get('closed', 'closedTicket')->name('closed');
        Route::get('answered', 'answeredTicket')->name('answered');
        Route::get('view/{id}', 'ticketReply')->name('view');
        Route::post('reply/{id}', 'replyTicket')->name('reply');
        Route::post('close/{id}', 'closeTicket')->name('close');
        Route::get('download/{ticket}', 'ticketDownload')->name('download');
        Route::post('delete/{id}', 'ticketDelete')->name('delete');
    });

        // General Setting
        Route::get('general-setting',[\App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('setting.index');
        Route::post('general-setting',[\App\Http\Controllers\Admin\GeneralSettingController::class, 'update'])->name('setting.update');

        // Logo-Icon
        Route::get('setting/logo-icon',[\App\Http\Controllers\Admin\GeneralSettingController::class, 'logoIcon'])->name('setting.logo.icon');
        Route::post('setting/logo-icon',[\App\Http\Controllers\Admin\GeneralSettingController::class, 'logoIconUpdate'])->name('setting.logo.icon');


    //Notification Setting
    Route::name('setting.notification.')->controller('NotificationController')->prefix('notification')->group(function () {
        //Template Setting
        Route::get('global', 'global')->name('global');
        Route::post('global/update', 'globalUpdate')->name('global.update');
        Route::get('templates', 'templates')->name('templates');
        Route::get('template/edit/{id}', 'templateEdit')->name('template.edit');
        Route::post('template/update/{id}', 'templateUpdate')->name('template.update');

        //Email Setting
        Route::get('email/setting', 'emailSetting')->name('email');
        Route::post('email/setting', 'emailSettingUpdate')->name('email.update');
        Route::post('email/test', 'emailTest')->name('email.test');

    });

    // Frontend
    Route::name('frontend.')->prefix('frontend')->group(function () {
        Route::controller('FrontendController')->group(function () {
            Route::get('templates', 'templates')->name('templates');
            Route::post('templates', 'templatesActive')->name('templates.active');
            Route::get('frontend-sections/{key}', 'frontendSections')->name('sections');
            Route::get('frontend-sections/{key}', 'frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'frontendElement')->name('sections.element');
            Route::post('remove/{id}', 'remove')->name('remove');
        });
        Route::controller('PageBuilderController')->group(function () {
            Route::get('manage-pages', 'managePages')->name('manage.pages');
            Route::post('manage-pages', 'managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete/{id}', 'managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'manageSectionUpdate')->name('manage.section.update');
        });
    });
});

Route::middleware('adminPermission')->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
    });
});
