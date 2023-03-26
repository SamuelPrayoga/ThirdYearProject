<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminAllergyReportController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuMakananController;
use App\Http\Controllers\AllergyReportController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PengumumanController;
use App\Models\MenuMakanan;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//Reset Password

// Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.gets');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,operator')->group(function () {

        //Alergi
        Route::get('/admin/allergy-reports', [AdminAllergyReportController::class, 'show'])->name('admin.allergy-reports.index');
        Route::post('/admin/allergy-reports/{report}/approve', [AdminAllergyReportController::class, 'approve'])->name('admin.approve');
        Route::delete('/admin/allergy-reports/{report}', [AdminAllergyReportController::class, 'reject'])->name('admin.reject');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/menumakan/index', [MenuMakananController::class, 'show'])->name('menumakan.index');
        Route::get('/menumakan/tambah', [MenuMakananController::class, 'create'])->name('menumakan.create');
        Route::post('/menumakan/tambah', [MenuMakananController::class, 'createmenus'])->name('menumakan.createmenus');
        Route::get('/menumakan/edit/{id}', [MenuMakananController::class, 'edit'])->name('menumakan.edit');
        Route::post('/updatemenus/{id}', [MenuMakananController::class, 'updatemenus'])->name('menumakan.updatemenus');
        Route::get('menumakan/delete/{id}', [MenuMakananController::class, 'delete'])->name('menumakan.delete');
        // positions
        Route::resource('/positions', PositionController::class)->only(['index', 'create']);
        Route::get('/positions/edit', [PositionController::class, 'edit'])->name('positions.edit');
        // Pengguna
        Route::post('/importuser', [EmployeeController::class, 'userImportExcel'])->name('importuser');
        Route::resource('/pengguna', EmployeeController::class)->only(['index', 'create']);
        Route::get('/pengguna/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

        Route::delete('/admin/delete-users', [ResetController::class, 'hapusMahasiswa'])->name('admin.hapusMahasiswa');

        // holidays (hari libur)
        Route::resource('/holidays', HolidayController::class)->only(['index', 'create']);
        Route::get('/holidays/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
        // attendances (absensi)
        Route::resource('/attendances', AttendanceController::class)->only(['index', 'create']);
        Route::get('/attendances/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');


        // presences (kehadiran)
        Route::resource('/presences', PresenceController::class)->only(['index']);
        Route::get('/presences/qrcode', [PresenceController::class, 'showQrcode'])->name('presences.qrcode');
        Route::get('/presences/qrcode/download-pdf', [PresenceController::class, 'downloadQrCodePDF'])->name('presences.qrcode.download-pdf');
        Route::get('/presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
        // not present data
        Route::get('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent'])->name('presences.not-present');
        Route::post('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent']);
        // present (url untuk menambahkan/mengubah user yang tidak hadir menjadi hadir)
        Route::post('/presences/{attendance}/present', [PresenceController::class, 'presentUser'])->name('presences.present');
        Route::post('/presences/{attendance}/acceptPermission', [PresenceController::class, 'acceptPermission'])->name('presences.acceptPermission');
        // employees permissions

        Route::get('/presences/{attendance}/permissions', [PresenceController::class, 'permissions'])->name('presences.permissions');
    });

    Route::middleware('role:user')->name('home.')->group(function () {

        Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');

        //Alergi
        Route::get('/student/allergy-reports', [AllergyReportController::class, 'index'])->name('allergy-reports.index');
        // Route::get('/laporkan-alergi', [AllergyReportController::class, 'index'])->name('alergi.index'); //Aman
        Route::get('/laporkan-alergi-form', [AllergyReportController::class, 'create'])->name('allergy-reports.create');
        Route::post('/laporkan-alergi-form', [AllergyReportController::class, 'store'])->name('allergy-reports.store');

        Route::get('/laporan-barang', [BarangController::class, 'index'])->name('laporan-barang');
        Route::get('/my-feedback', [FeedbackController::class, 'show'])->name('feedbackku');
        Route::get('/feedback-forbidden', [FeedbackController::class, 'forbidden'])->name('forbidden');
        Route::post('/laporan-barang', [BarangController::class, 'create'])->name('laporan-barang-form');
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
        Route::post('/feedback', [FeedbackController::class, 'create'])->name('feedback-form');
        Route::get('/menumakan', [MenuMakananController::class, 'index'])->name('menumakan');

        Route::get('/', [HomeController::class, 'index'])->name('index');
        // desctination after scan qrcode
        Route::post('/absensi/qrcode', [HomeController::class, 'sendEnterPresenceUsingQRCode'])->name('sendEnterPresenceUsingQRCode');
        Route::post('/absensi/qrcode/out', [HomeController::class, 'sendOutPresenceUsingQRCode'])->name('sendOutPresenceUsingQRCode');
        Route::get('/absensi/{attendance}', [HomeController::class, 'show'])->name('show');
        Route::get('/absensi/{attendance}/permission', [HomeController::class, 'permission'])->name('permission');

        // Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        // Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        // Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        // Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware('guest')->group(function () {
    // auth
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    // Route::get('/forget-passwords', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::get('/forget-passwords', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
