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
use App\Http\Controllers\IzinBermalamController;
use App\Http\Controllers\MenuMakananController;
use App\Http\Controllers\AllergyReportController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RegsiterController;
use App\Http\Controllers\ExportHistory;
use App\Http\Livewire\Auth\Register;
use App\Http\Controllers\BarangController;
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
    Route::middleware('role:admin,keasramaan,depkebdis,pengelola,')->group(function () {

        //LapMakan
        Route::get('/LaporanMakan/JumatSabtu', [LaporMakanController::class, 'index'])->name('admin.lapmakan.index');
        Route::delete('/laporan/hapus-semua', [LaporMakanController::class, 'hapusSemuaLaporan'])->name('admin.lap.hapussemua');


        //Alergi
        Route::get('/admin/allergy-reports', [AllergyReportController::class, 'show'])->name('admin.allergy-reports.index');
        Route::get('/admin/rekap-allergy-reports', [AllergyReportController::class, 'rekapAlergi'])->name('admin.allergy-reports.rekap');
        Route::post('/admin/allergy-reports/{report}/approve', [AllergyReportController::class, 'approve'])->name('admin.approve');
        // Route::delete('/admin/allergy-reports/{report}', [AllergyReportController::class, 'reject'])->name('admin.reject');
        Route::post('/admin/allergy-reports/{report}/reject', [AllergyReportController::class, 'reject'])->name('admin.reject');
        Route::get('/report/export', [ReportController::class, 'exportExcel'])->name('report.export');
        Route::delete('/admin/allergy-reports/{id}', [AllergyReportController::class, 'destroy'])->name('admin.destroy');


        //Barang
        Route::get('/barang/all', [BarangController::class, 'show'])->name('barang.show');
        Route::put('/barang/{id}/update-showed', [BarangController::class, 'updateShowed'])->name('barang.update-showed');
        Route::put('/barang/{id}/not-showed', [BarangController::class, 'notShowed'])->name('barang.not-showed');
        Route::delete('/laporanbarang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

        //Pengumuman
        Route::get('/pengumuman/all', [PengumumanController::class, 'show'])->name('pengumuman.index');
        Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
        Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
        Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
        Route::post('/pengumuman/{id}/publish', [PengumumanController::class, 'publish'])->name('pengumuman.publish');

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

        //Feedback
        Route::get('/admin/kritik-saran', [FeedbackController::class, 'showAll'])->name('admin.showFeedback');
        Route::delete('/feedback/delete/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');


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
        Route::delete('/presences/{attendance}/declinePermission', [PresenceController::class, 'declinePermission'])->name('presences.declinePermission');
        // employees permissions

        Route::get('/presences/{attendance}/permissions', [PresenceController::class, 'permissions'])->name('presences.permissions');
    });

    Route::middleware('role:user')->name('home.')->group(function () {

        // Lapor Makan
        Route::get('/check-lapor-makan', [HomeController::class, 'checkLaporMakan'])->name('check.lapor.makan');
        Route::post('/lapor-saya-makan', [LaporMakanController::class, 'store'])->name('lapor.makan');

        Route::get('/edit-profile', [UpdateProfileController::class, 'edit'])->name('edit.profile');
        Route::put('/update-profile', [UpdateProfileController::class, 'update'])->name('update.profile');


        Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
        Route::get('/pengumuman-diarsipkan', [PengumumanController::class, 'pengumumanArsip'])->name('pengumuman.arsip');

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

        //export
        Route::get('/history/export', [ExportHistory::class, 'export'])->name('history.export');
        Route::get('/history/pdf', [ExportHistory::class, 'pdf'])->name('pdf.history');

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

    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    // Route::get('/forget-passwords', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::get('/forget-passwords', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
