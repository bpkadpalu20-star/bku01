<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OPDController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\RekapBKUController;
use App\Http\Controllers\TamilBKUController;
use App\Http\Controllers\LaporanBKUController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BkuPenerimaanController;
use App\Http\Controllers\PaguPenerimanController;
use App\Http\Controllers\BkuPengeluaranController;
use App\Http\Controllers\lapBkuPenerimaanController;
use App\Http\Controllers\lapBkuPengeluaranController;
use App\Http\Controllers\LaporanRincianBKUController;
use App\Http\Controllers\LaporanRekapPenerimaanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Permissions Routes
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/create', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Roles Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Article Routes
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/create', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles', [ArticleController::class, 'destroy'])->name('articles.destroy');

      // User Routes
      Route::get('/users', [UserController::class, 'index'])->name('users.index');
      Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
      Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
      Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
      Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
      Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');

      // User Routes
      Route::resource('/opd', OPDController::class);
    //   Route::get('/opd', [OPDController::class, 'index'])->name('opd.index');
    //   Route::get('/opd/create', [ArticleController::class, 'create'])->name('opd.create');
      Route::post('/opd/create', [OPDController::class, 'create'])->name('opd.create');
    //   Route::get('/opd/{id}/edit', [ArticleController::class, 'edit'])->name('opd.edit');
      Route::post('/opd/update', action: [OPDController::class, 'update'])->name('opd.update');
      Route::delete('/opd', [OPDController::class, 'destroy'])->name('opd.destroy');

      // Rekanan Routes
      Route::resource('/rekanan', RekananController::class);
      Route::get('/rekanan/{id}/edit', [RekananController::class, 'edit'])->name('rekanan.edit');
      Route::post('/rekanan/create', [RekananController::class, 'create'])->name('rekanan.create');
      Route::post('/rekanan/update', action: [RekananController::class, 'update'])->name('rekanan.update');
      Route::delete('/rekanan', [RekananController::class, 'destroy'])->name('rekanan.destroy');

      // Bank Routes
      Route::resource('/bank', BankController::class);
      Route::get('/bank/{id}/edit', [BankController::class, 'edit'])->name('bank.edit');
      Route::post('/bank/create', [BankController::class, 'create'])->name('bank.create');
      Route::post('/bank/update', action: [BankController::class, 'update'])->name('bank.update');
      Route::delete('/bank', [BankController::class, 'destroy'])->name('bank.destroy');

      // Dana Routes
      Route::resource('/dana', DanaController::class);
      Route::get('/dana/{id}/edit', [DanaController::class, 'edit'])->name('dana.edit');
      Route::post('/dana/create', [DanaController::class, 'create'])->name('dana.create');
      Route::post('/dana/update', action: [DanaController::class, 'update'])->name('dana.update');
      Route::delete('/dana', [DanaController::class, 'destroy'])->name('dana.destroy');

      // BKU Pengeluaran Routes
      Route::resource('/bku-pengeluaran', BkuPengeluaranController::class);
      Route::get('/bku-pengeluaran/edit', [BkuPengeluaranController::class, 'edit'])->name('bku-pengeluaran.editbaru');
      Route::get('/bku-pengeluaran/{id}/edit', [BkuPengeluaranController::class, 'edit'])->name('bku-pengeluaran.edit');
      Route::post('/bku-pengeluaran/create', [BkuPengeluaranController::class, 'store'])->name('bku-pengeluaran.store');
      Route::post('/bku-pengeluaran/update',  [BkuPengeluaranController::class, 'update'])->name('bku-pengeluaran.update');
    //   Route::post('/bku-pengeluaran/batal', [BkuPengeluaranController::class, 'batal'])->name('bku-pengeluaran.batal');
      Route::get('/bku-pengeluaran/show', [BkuPengeluaranController::class, 'show'])->name('bku-pengeluaran.show');
      Route::get('/bku-pengeluaran/create', [BkuPengeluaranController::class, 'create'])->name('bku-pengeluaran.create');

    Route::get('/bku-pengeluaran/{id}/batal', [BkuPengeluaranController::class, 'batal'])->name('bku-pengeluaran.batal');
    Route::post('/bku-pengeluaran/batal', [BkuPengeluaranController::class, 'update1'])->name('bku-pengeluaran.update1');
    Route::get('/bku-pengeluaran/{id}/unbatal', [BkuPengeluaranController::class, 'unbatal'])->name('bku-pengeluaran.unbatal');
    Route::post('/bku-pengeluaran/unbatal', [BkuPengeluaranController::class, 'update2'])->name('bku-pengeluaran.update2');


    // BKU Pengeluaran Routes
    Route::resource('/bku-penerimaan', BkuPenerimaanController::class);
    Route::get('/bku-penerimaan/edit', [BkuPenerimaanController::class, 'edit'])->name('bku-penerimaan.editbaru');
    Route::get('/bku-penerimaan/{id}/edit', [BkuPenerimaanController::class, 'edit'])->name('bku-penerimaan.edit');
    Route::post('/bku-penerimaan/create', [BkuPenerimaanController::class, 'store'])->name('bku-penerimaan.store');
    Route::post('/bku-penerimaan/update',  [BkuPenerimaanController::class, 'update'])->name('bku-penerimaan.update');
  //   Route::post('/bku-penerimaan/batal', [BkuPenerimaanController::class, 'batal'])->name('bku-pengeluaran.batal');
    Route::get('/bku-penerimaan/show', [BkuPenerimaanController::class, 'show'])->name('bku-penerimaan.show');
    Route::get('/bku-penerimaan/create', [BkuPenerimaanController::class, 'create'])->name('bku-penerimaan.create');

  Route::get('/bku-penerimaan/{id}/batal', [BkuPenerimaanController::class, 'batal'])->name('bku-penerimaan.batal');
  Route::post('/bku-penerimaan/batal', [BkuPenerimaanController::class, 'update1'])->name('bku-penerimaan.update1');
  Route::get('/bku-penerimaan/{id}/unbatal', [BkuPenerimaanController::class, 'unbatal'])->name('bku-penerimaan.unbatal');
  Route::post('/bku-penerimaan/unbatal', [BkuPenerimaanController::class, 'update2'])->name('bku-penerimaan.update2');

  Route::get('/bku-penerimaan/{id}/kelompok', [BkuPenerimaanController::class, 'kelompok'])->name('bku-penerimaan.kelompok');
  Route::get('/bku-penerimaan/{id}/jenis', [BkuPenerimaanController::class, 'jenis'])->name('bku-penerimaan.jenis');
  Route::get('/bku-penerimaan/{id}/objek', [BkuPenerimaanController::class, 'objek'])->name('bku-penerimaan.objek');
  Route::get('/bku-penerimaan/{id}/rincian_objek', [BkuPenerimaanController::class, 'rincian_objek'])->name('bku-penerimaan.rincian_objek');
  Route::get('/bku-penerimaan/{id}/sub_rincian_objek', [BkuPenerimaanController::class, 'sub_rincian_objek'])->name('bku-penerimaan.sub_rincian_objek');
  Route::post('/bku-penerimaan/akun', [BkuPenerimaanController::class, 'akun'])->name('bku-penerimaan.akun');

  // BKU Pengeluaran Routes

  Route::get('/laporan/bkupengeluaran', [lapBkuPengeluaranController::class, 'index'])->name('laporan.bkupengeluaran.index');
  Route::get('/laporan/bkupengeluaran/{id}/tampilawal', [lapBkuPengeluaranController::class, 'tampil'])->name('laporan.bkupengeluaran.tampil');
  Route::get('/laporan/bkupengeluaran/{id}/tampil', [lapBkuPengeluaranController::class, 'tampil'])->name('laporan.bkupengeluaran.tampil');
  Route::get('/laporan/bkupengeluaran/{id}/tampilcetak', [lapBkuPengeluaranController::class, 'tampilcetak'])->name('laporan.bkupengeluaran.tampilcetak');
  Route::get('/laporan/bkupengeluaran/{id}/generatePDF', [lapBkuPengeluaranController::class, 'generatePDF'])->name('laporan.bkupengeluaran.generatePDF');
  Route::get('/laporan/bkupengeluaran/{id}/tampilexcel', [lapBkuPengeluaranController::class, 'tampilexcel'])->name('laporan.bkupengeluaran.tampilexcel');
//   Route::get('/laporan/cetakpengeluaran', [cetakBkuPengeluaranController::class, 'index'])->name('laporan.cetakpengeluaran.index');


// BKU Penerimaan Routes

  Route::get('/laporan/bkupenerimaan', [lapBkuPenerimaanController::class, 'index'])->name('laporan.bkupenerimaan.index');
  Route::get('/laporan/bkupenerimaan/{id}/tampilawal', [lapBkuPenerimaanController::class, 'tampilawal'])->name('laporan.bkupenerimaan.tampilawal');
  Route::get('/laporan/bkupenerimaan/{id}/tampil', [lapBkuPenerimaanController::class, 'tampil'])->name('laporan.bkupenerimaan.tampil');
  Route::get('/laporan/bkupenerimaan/{id}/tampilcetak', [lapBkuPenerimaanController::class, 'tampilcetak'])->name('laporan.bkupenerimaan.tampilcetak');
  Route::get('/laporan/bkupenerimaan/{id}/generatePDF', [lapBkuPenerimaanController::class, 'generatePDF'])->name('laporan.bkupenerimaan.generatePDF');
  Route::get('/laporan/bkupenerimaan/{id}/tampilexcel', [lapBkuPenerimaanController::class, 'tampilexcel'])->name('laporan.bkupenerimaan.tampilexcel');
//   Route::get('/laporan/cetakpengeluaran', [cetakBkuPengeluaranController::class, 'index'])->name('laporan.cetakpengeluaran.index');

// BKU Penerimaan Routes
Route::get('/laporan/bku', [LaporanBKUController::class, 'index'])->name('laporan.bku.index');
Route::get('/laporan/bku/{id}/tampil', [LaporanBKUController::class, 'tampil'])->name('laporan.bku.tampil');
Route::get('/laporan/bku/{id}/tampilawal', [LaporanBKUController::class, 'tampilawal'])->name('laporan.bku.tampilawal');
Route::get('/laporan/bku/{id}/generatePDF', [LaporanBKUController::class, 'generatePDF'])->name('laporan.bku.generatePDF');
Route::get('/laporan/bku/{id}/tampilcetak', [LaporanBKUController::class, 'tampilcetak'])->name('laporan.bku.tampilcetak');

// BKU Penerimaan Routes
Route::get('/laporan/rincianbku', [LaporanRincianBKUController::class, 'index'])->name('laporan.rincianbku.index');
Route::get('/laporan/rincianbku/{id}/tampil', [LaporanRincianBKUController::class, 'tampil'])->name('laporan.rincianbku.tampil');
Route::get('/laporan/rincianbku/{id}/tampilawal', [LaporanRincianBKUController::class, 'tampilawal'])->name('laporan.rincianbku.tampilawal');
Route::get('/laporan/rincianbku/{id}/generatePDF', [LaporanRincianBKUController::class, 'generatePDF'])->name('laporan.rincianbku.generatePDF');
Route::get('/laporan/rincianbku/{id}/tampilcetak', [LaporanRincianBKUController::class, 'tampilcetak'])->name('laporan.rincianbku.tampilcetak');

// BKU Penerimaan Routes
Route::get('/laporan/rekappenerimaan', [LaporanRekapPenerimaanController::class, 'index'])->name('laporan.rekappenerimaan.index');
Route::get('/laporan/rekappenerimaan/{id}/tampil', [LaporanRekapPenerimaanController::class, 'tampil'])->name('laporan.rekappenerimaan.tampil');
Route::get('/laporan/rekappenerimaan/{id}/tampilawal', [LaporanRekapPenerimaanController::class, 'tampilawal'])->name('laporan.rekappenerimaan.tampilawal');
Route::get('/laporan/rekappenerimaan/{id}/generatePDF', [LaporanRekapPenerimaanController::class, 'generatePDF'])->name('laporan.rekappenerimaan.generatePDF');
Route::get('/laporan/rekappenerimaan/{id}/tampilcetak', [LaporanRekapPenerimaanController::class, 'tampilcetak'])->name('laporan.rekappenerimaan.tampilcetak');

// BKU Rekap Routes
Route::get('/rekap', [RekapBKUController::class, 'index'])->name('rekap.index');
Route::get('/rekap/{id}/createsaldo', [RekapBKUController::class, 'createsaldo'])->name('rekap.createsaldo');
Route::post('/rekap/storesaldo', [RekapBKUController::class, 'storesaldo'])->name('rekap.storesaldo');
Route::get('/rekap/{id}/createrincian', [RekapBKUController::class, 'createrincian'])->name('rekap.createrincian');
Route::post('/rekap/storerincian', [RekapBKUController::class, 'storerincian'])->name('rekap.storerincian');
Route::get('/rekap/{id}/createrinciansub', [RekapBKUController::class, 'createrinciansub'])->name('rekap.createrinciansub');
Route::post('/rekap/storerinciansub', [RekapBKUController::class, 'storerinciansub'])->name('rekap.storerinciansub');
// Route::delete('/rekap/deleterinciansub', [RekapBKUController::class, 'deleterinciansub'])->name('rekap.deleterinciansub');
Route::get('/rekap/{id}/deleterincian', [RekapBKUController::class, 'deleterincian'])->name('rekap.deleterincian');
Route::get('/rekap/{id}/deleterinciansub', [RekapBKUController::class, 'deleterinciansub'])->name('rekap.deleterinciansub');
Route::get('/rekap/{id}/tampil', [RekapBKUController::class, 'tampil'])->name('rekap.tampil');

// BKU Rekap Routes
Route::get('/pagupeneriman', [PaguPenerimanController::class, 'index'])->name('pagupeneriman.index');
Route::get('/pagupeneriman/{id}/createsaldo', [PaguPenerimanController::class, 'createsaldo'])->name('pagupeneriman.createsaldo');
Route::post('/pagupeneriman/storesaldo', [PaguPenerimanController::class, 'storesaldo'])->name('pagupeneriman.storesaldo');
Route::get('/pagupeneriman/{id}/createrincian', [PaguPenerimanController::class, 'createrincian'])->name('pagupeneriman.createrincian');
Route::post('/pagupeneriman/storerincian', [PaguPenerimanController::class, 'storerincian'])->name('pagupeneriman.storerincian');
Route::get('/pagupeneriman/{id}/createrinciansub', [PaguPenerimanController::class, 'createrinciansub'])->name('pagupeneriman.createrinciansub');
Route::post('/pagupeneriman/storerinciansub', [PaguPenerimanController::class, 'storerinciansub'])->name('pagupeneriman.storerinciansub');
// Route::delete('/pagupeneriman/deleterinciansub', [PaguPenerimanController::class, 'deleterinciansub'])->name('pagupeneriman.deleterinciansub');
Route::get('/pagupeneriman/{id}/deleterincian', [PaguPenerimanController::class, 'deleterincian'])->name('pagupeneriman.deleterincian');
Route::get('/pagupeneriman/{id}/deleterinciansub', [PaguPenerimanController::class, 'deleterinciansub'])->name('pagupeneriman.deleterinciansub');
Route::get('/pagupeneriman/{id}/tampil', [PaguPenerimanController::class, 'tampil'])->name('pagupeneriman.tampil');
Route::post('/pagupeneriman/update', [PaguPenerimanController::class, 'update'])->name('pagupeneriman.update');

});

require __DIR__.'/auth.php';
