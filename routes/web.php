<?php

use App\Http\Controllers\{
    AuthController,
    IndexController,
    ListingController,
    ListingOfferController,
    NotificationController,
    NotificationSeenController,
    RealtorListingAcceptOfferController,
    RealtorListingController,
    RealtorListingImageController,
    UserAccountController
};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class)
    ->only(['create'])
    ->middleware('auth');

Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

Route::resource('listing.offer', ListingOfferController::class)
    ->only('store')
    ->middleware('auth');

Route::resource('notification', NotificationController::class)
    ->middleware('auth')
    ->only(['index']);
Route::put('notification/{notification}/seen', NotificationSeenController::class)
    ->middleware('auth')
    ->name('notification.seen');

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()
        ->route('listing.index')
        ->with('success', 'Account verified!');
})
->middleware(['auth', 'signed'])
->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth', 'verified'])
    ->group(
        function () {
            Route::name('listing.restore')->patch(
                'listing/{listing}/restore',
                [
                    RealtorListingController::class,
                    'restore'
                ]
            )->withTrashed();
            Route::resource('listing', RealtorListingController::class)
                ->withTrashed();

            Route::name('offer.accept')->put(
                'offer/{offer}/accept',
                RealtorListingAcceptOfferController::class
            );

            Route::resource('listing.image', RealtorListingImageController::class)
                ->only(['create', 'store', 'destroy']);
        }
    );
