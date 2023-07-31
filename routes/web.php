<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Admin\SimController;
use App\Http\Controllers\Admin\NotiController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\Admin\ComplainController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\InvoiceAttachmentController;

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

Route::get('/', function () {
    return view('signin');
})
    ->middleware('guest')
    ->name('signin');

Route::get('table', function () {
    return view('form-advanced');
});
Route::get('/home', [AdminController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'App\Http\Controllers\LangController@switchLang',
]);



Route::middleware('auth')->group(function () {

    Route::controller(OrderController::class)->group(function () {
        Route::put('order/assign/{id}','assign')->name('assign.order');
        Route::put('order/finish/{id}','finish')->name('finish.order');

        Route::get('orders', 'index')->name('orders');
        Route::get('orders/{id}', 'show')->name('show.orders');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('MarkAsRead_all', 'MarkAsRead_all')->name('MarkAsRead_all');
        Route::get(
            'unreadNotifications_count',
            'unreadNotifications_count'
        )->name('unreadNotifications_count');
        Route::get('unreadNotifications', 'unreadNotifications')->name(
            'unreadNotifications'
        );
        Route::post(
            '/notifications/{notification}/mark-as-read',
            'markAsRead'
        )->name('notifications.markAsRead');
    });


    Route::controller(BannerController::class)->group(function () {
        Route::get('banners', 'index')->name('banners');
        Route::get('banner/create', 'create')->name('banner.create');
        Route::post('banner/create', 'store')->name('banner.store');
        Route::delete('banner/delete/{id}', 'destroy')->name('banner.delete');
    });

    Route::controller(SimController::class)->group(function () {
        Route::get('sims', 'index')->name('sims');
        Route::get('sim/create', 'create')->name('sim.create');
        Route::post('sim/store', 'store')->name('sim.store');
        Route::get('sim/edit/{id}', 'edit')->name('sim.edit');
        Route::post('sim/update/{id}', 'update')->name('sim.update');
        Route::delete('sim/delete/{id}', 'destroy')->name('sim.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::controller(ClientController::class)->group(function () {
            Route::get('users', 'index')->name('users');
            Route::get('user/create', 'create')->name('user.create');
            Route::post('user/store', 'store')->name('user.store');
            Route::get('user/edit/{id}', 'edit')->name('user.edit');
            Route::post('user/update/{id}', 'update')->name('user.update');
            Route::delete('user/delete/{id}', 'destroy')->name('user.destroy');
            Route::get('my-sims/{id}' , 'mySims')->name('users.mysims');
        });
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('settings/contacts', 'index')->name('contacts');
        Route::delete('settings/contact/delete/{id}', 'destroy')->name(
            'contact.destroy'
        );
    });

    Route::controller(ComplainController::class)->group(function () {
        Route::get('settings/complains', 'index')->name('complains');
        Route::delete('settings/complain/delete/{id}', 'destroy')->name(
            'complain.destroy'
        );
    });

    // routes/web.php

    Route::get('settings/siteSetting', [SiteSettingController::class , 'edit'])->name('edit-sitesetting');
    Route::post('settings/siteSetting', [SiteSettingController::class , 'update'])->name('update-sitesetting');


    Route::controller(NotiController::class)->group(function () {
        Route::get('noti', 'noti')->name('noti');
        Route::post('send_noti', 'send_noti')->name('send_noti');
    });

    Route::get('/{page}/edit', [AdminController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::post('/{page}/update/{id}', [AdminController::class, 'update']);
});

require __DIR__ . '/auth.php';
