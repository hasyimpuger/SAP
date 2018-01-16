<?php

// === Auth === //
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', ['uses' => 'AuthController@index', 'as' => 'login']);
    Route::post('/login', ['uses' => 'AuthController@postLogin']);
});
Route::get('/logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);

// Main Menu
Route::group(['middleware' => 'auth'], function() {
    // Menu
    // Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);
    Route::get('/', ['uses' => 'HomeController@getDashboard', 'as' => 'home.dashboard']);
    //Gudang
    Route::group(['prefix' => 'gudang', 'middleware' => 'gudang'], function() {
        //Barang
        Route::get('/barang', ['uses' => 'GudangController@getBarang', 'as' => 'barang.index']);
        Route::post('/barang/create', ['uses' => 'GudangController@postBarang', 'as' => 'postBarang']);
        Route::post('/barang/edit', ['uses' => 'GudangController@postBarangEdit', 'as' => 'postBarangEdit']);
        Route::post('/barang/kategori', ['uses' => 'GudangController@postKategori', 'as' => 'postKategori']);
        Route::get('/barang/hapus', ['uses' => 'GudangController@getHapusBarang', 'as' => 'getHapusBarang']);
        Route::get('/barang/stok-habis', ['uses' => 'GudangController@getStokBarang', 'as' => 'getStokBarang']);
        Route::post('/barang/stok-habis/edit', ['uses' => 'GudangController@postStokBarangEdit', 'as' => 'postStokBarangEdit']);
        Route::post('/barang/export/{type}', ['uses' => 'GudangController@exportBarang', 'as' => 'exportBarang']);
        Route::post('/barang/import', ['uses' => 'GudangController@importBarang', 'as' => 'importBarang']);
        Route::post('/barang/pdf', ['uses' => 'GudangController@exportBarangPDF', 'as' => 'exportBarangPDF']);

         // History
         Route::get('/barang/history/', ['uses' => 'GudangController@getHistory', 'as' => 'getHistory']);
         Route::post('/barang/history/detail', ['uses' => 'GudangController@postCariHistory', 'as' => 'postCariHistory']);
         Route::get('/barang/history/detail/id={id}', ['uses' => 'GudangController@getHistoryDetail', 'as' => 'getHistoryDetail']);

        //Distributor
        Route::get('/distributor', ['uses' => 'GudangController@getDistributor', 'as' => 'distributor.index']);
        Route::post('/distributor', ['uses' => 'GudangController@postDistributor', 'as' => 'postDistributor']);
        Route::post('/distributor/edit', ['uses' => 'GudangController@postEditDistributor', 'as' => 'postEditDistributor']);
        Route::get('/distributor/delete', ['uses' => 'GudangController@getDeleteDistributor', 'as' => 'getDeleteDistributor']);
        Route::get('/distributor/export/{type}', ['uses' => 'GudangController@exportExcelDistributor', 'as' => 'exportExcelDistributor']);
        Route::get('/distributor/PDF', ['uses' => 'GudangController@exportDistributorPDF', 'as' => 'exportDistributorPDF']);

        // Kategori
        Route::get('/kategori', ['uses' => 'GudangController@getKategori', 'as' => 'kategori.index']);
        Route::post('/kategori/create', ['uses' => 'GudangController@postDataKategori', 'as' => 'postDataKategori']);
        Route::post('/kategori/delete', ['uses' => 'GudangController@postKategoriDelete', 'as' => 'postKategoriDelete']);
        Route::post('/kategori/update', ['uses' => 'GudangController@postKategoriUpdate', 'as' => 'postKategoriUpdate']);

    });

    Route::group(['prefix' => 'penjualan', 'middleware' => 'kasir'], function() {
        //penjualan
        Route::get('/transaksi', ['uses' => 'PenjualanController@getTransaksi', 'as' => 'transaksi.index']);
        Route::post('/transaksi/create', ['uses' => 'PenjualanController@postTransaksi', 'as' => 'postTransaksi']);
        Route::post('/transaksi/getData', ['uses' => 'PenjualanController@getDataTransaksi', 'as' => 'getDataTransaksi']);
        Route::post('/transaksi/exportExcel/{type}', ['uses' => 'PenjualanController@exportExcelTransaksi', 'as' => 'exportExcelTransaksi']);
        Route::post('/transaksi/exportPDF', ['uses' => 'PenjualanController@exportTransaksiPDF', 'as' => 'exportTransaksiPDF']);
        Route::get('/transaksi/edit/{Inv}', ['uses' => 'PenjualanController@getTransaksiEdit', 'as' => 'getTransaksiEdit']);
        Route::post('/transaksi/update', ['uses' => 'PenjualanController@postTransaksiEdit', 'as' => 'postTransaksiEdit']);
        Route::get('/transaksi/delete', ['uses' => 'PenjualanController@getTransaksiDelete', 'as' => 'getTransaksiDelete']);
        Route::get('/transaksi/One-Trans/delete', ['uses' => 'PenjualanController@getOneTransDelete', 'as' => 'getOneTransDelete']);
        Route::get('/transaksi/invoicePDF', ['uses' => 'PenjualanController@InvoicePDF', 'as' => 'invoicePDF']);
        Route::get('/transaksi/print', ['uses' => 'PenjualanController@printTransaksi', 'as' => 'transaksi.print']);
        Route::get('/transaksi/edit/{Inv}/print-ulang', ['uses' => 'PenjualanController@invoicePDF', 'as' => 'invoicePDF']);
        // Route::get('/transaksi/getDataBarang', ['uses' => 'PenjualanController@getDataBarang', 'as' => 'getDataBarang']);
         // Route::get('/transaksi/getDataBarang', ['uses' => 'PenjualanController@getDataBarang', 'as' => 'getDataBarang']);

         // Laporan
         Route::post('/transaksi/laporan/', ['uses' => 'PenjualanController@getLaporan', 'as' => 'getLaporan']);
         Route::get('/transaksi/laporan/pdf/date={start}&{end}', ['uses' => 'PenjualanController@postLaporanPDF', 'as' => 'postLaporanPdf']);
    });

    Route::group(['prefix' => 'keuangan', 'middleware' => 'kasir'], function() {
        Route::get('/', ['uses' => 'KeuanganController@getKeuangan', 'as' => 'getKeuangan']);
        // pemasukan
        Route::get('/pemasukan', ['uses' => 'KeuanganController@getPemasukan', 'as' => 'getPemasukan']);
        Route::post('/pemasukan/create', ['uses' => 'KeuanganController@postPemasukan', 'as' => 'postPemasukan']);
        Route::get('/pemasukan/delete', ['uses' => 'KeuanganController@getHapusPemasukan', 'as' => 'getHapusPemasukan']);
        Route::post('/pemasukan/update', ['uses' => 'KeuanganController@postEditPemasukan', 'as' => 'postEditPemasukan']);
        Route::post('/pemasukan/excel/{xlsx}', ['uses' => 'KeuanganController@exportExcelPemasukan', 'as' => 'exportExcelPemasukan']);
        Route::post('/pemasukan/PDF', ['uses' => 'KeuanganController@exportPDFPemasukan', 'as' => 'exportPDFPemasukan']);
        Route::post('/pemasukan/Print', ['uses' => 'KeuanganController@exportPrintPemasukan', 'as' => 'exportPrintPemasukan']);

        // Pengeluaran
        Route::get('/pengeluaran', ['uses' => 'KeuanganController@getPengeluaran', 'as' => 'getPengeluaran']);
        Route::post('/pengeluaran/create', ['uses' => 'KeuanganController@postPengeluaran', 'as' => 'postPengeluaran']);
        Route::get('/pengeluaran/delete', ['uses' => 'KeuanganController@getHapusPengeluaran', 'as' => 'getHapusPengeluaran']);
        Route::post('/pengeluaran/excel/{xlsx}', ['uses' => 'KeuanganController@exportExcelPengeluaran', 'as' => 'exportExcelPengeluaran']);
        Route::post('/pengeluaran/update', ['uses' => 'KeuanganController@postEditPengeluaran', 'as' => 'postEditPengeluaran']);
        Route::post('/pengeluaran/PDF', ['uses' => 'KeuanganController@exportPDFPengeluaran', 'as' => 'exportPDFPengeluaran']);
        Route::post('/pengeluaran/Print', ['uses' => 'KeuanganController@exportPrintPengeluaran', 'as' => 'exportPrintPengeluaran']);

    });

    Route::group(['middleware' => 'admin'], function() {
        Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');
        Route::get('/pelanggan/data', 'PelangganController@getDataPelanggan')->name('pelanggan.getDataPelanggan');
        Route::post('/pelanggan/store', 'PelangganController@store')->name('pelanggan.store');
        Route::post('/pelanggan/update', 'PelangganController@update')->name('pelanggan.update');
        Route::post('/pelanggan/delete', 'PelangganController@destroy')->name('pelanggan.destroy');

         Route::group(['prefix' => 'setting'], function() {
                //Setting
                Route::get('/toko', ['uses' => 'SettingController@getSetting', 'as' => 'setting.index']);
                Route::post('/toko', ['uses' => 'SettingController@postSetting', 'as' => 'postSetting']);
                Route::get('/register/toko', ['uses' => 'SettingController@getRegisterToko', 'as' => 'getRegisterToko']);
                Route::post('/register/toko', ['uses' => 'SettingController@postRegisterToko', 'as' => 'postRegisterToko']);

                // ecpos
                Route::get('/ecpos/configuration', ['uses' => 'EcposController@getEcpos', 'as' => 'getEcpos']);
                Route::post('/ecpos/configuration', ['uses' => 'EcposController@postEcpos', 'as' => 'postEcpos']);
          });

            Route::group(['prefix' => 'akun'], function() {
                // akun
                Route::get('/', ['uses' => 'AkunController@index', 'as' => 'akun.index']);
                Route::post('/', ['uses' => 'AkunController@postAkun', 'as' => 'postAkun']);
            });
    });
});
