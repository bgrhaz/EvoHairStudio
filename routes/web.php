<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\RiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

use App\Http\Controllers\pelangganController\pelangganController;
use App\Http\Controllers\pelangganController\reservasiController;

use App\Http\Controllers\barbermanController\BarbermanController;
use App\Http\Controllers\adminController\BuatAkunBarberman;
use App\Http\Controllers\adminController\BuatAkunAdmin;
use App\Http\Controllers\adminController\jadwalBarberman;

Route::middleware('guest')->group(function () {
  Route::get('/', [LoginBasic::class, 'index'])->name('login');
  Route::post('/auth/login-user', [LoginBasic::class, 'authenticate'])->name('auth-login-user');
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::post('/auth/register-user', [RegisterBasic::class, 'store'])->name('auth-register-user');
  Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
  // Main Page Route
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');
  Route::get('/akunBarberman', [Analytics::class, 'akunBarberman'])->name('akunBarberman');


  Route::get('/TambahAkunBarberman', [BuatAkunBarberman::class, 'index'])->name('TambahAkunBarberman');
  Route::post('/BuatAkunBarberman', [BuatAkunBarberman::class, 'store'])->name('BuatAkunBarberman');

  Route::get('/TambahAkunAdmin', [BuatAkunAdmin::class, 'index'])->name('TambahAkunAdmin');
  Route::post('/BuatAkunAdmin', [BuatAkunAdmin::class, 'store'])->name('BuatAkunAdmin');
  Route::get('JadwalBarberman/{id}', [jadwalBarberman::class, 'index'])->name('JadwalBarberman');
  Route::post('JadwalBarberman/{id}/simpan', [jadwalBarberman::class, 'store'])->name('SimpanJadwalBarberman');

  Route::get('/dashboard/{id}', [Analytics::class, 'cekJadwal'])->name('cekJadwal');
  Route::post('/Dashboard/AjukanReservasiOffline',  [Analytics::class, 'store'])->name('AjukanReservasiOffline');
  Route::post('/Dashboard/transaksi', [Analytics::class, 'transaksi'])->name('transaksi');

  // layout
  Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
  Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
  Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
  Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
  Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

  // pages
  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
  Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
  Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
  Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
  Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

  // cards
  Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

  // User Interface
  Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
  Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
  Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
  Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
  Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
  Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
  Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
  Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
  Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
  Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
  Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
  Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
  Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
  Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
  Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
  Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
  Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
  Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
  Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

  // extended ui
  Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
  Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

  // icons
  Route::get('/icons/icons-ri', [RiIcons::class, 'index'])->name('icons-ri');

  // form elements
  Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
  Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

  // form layouts
  Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
  Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

  // tables
  Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
});

Route::middleware(['auth', 'role:user'])->prefix('pelanggan')->group(function () {
  Route::get('/HalamanUtama', [pelangganController::class, 'index'])->name('halamanPelanggan');
  Route::get('/HalamanReservasi/{id}', [reservasiController::class, 'index'])->name('HalamanReservasi');
  Route::post('/HalamanReservasi/mengajukan', [reservasiController::class, 'store'])->name('AjukanReservasi');
  Route::get(
    '/reservasi/{id}/cek-jadwal',
    [reservasiController::class, 'cekJadwal']
  )->name('reservasi.cekJadwal');
});

Route::middleware(['auth', 'role:barberman'])->prefix('barberman')->group(function () {
  Route::get('/index', [BarbermanController::class, 'index'])->name('barberman.dashboard');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/auth/logout-basic', [LoginBasic::class, 'logout'])->name('auth-logout-basic');
});
 //Logout
