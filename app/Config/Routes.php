<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('TA');
$routes->setDefaultMethod('index');
$routes->get('/', 'Home::index');
$routes->get('/ta', 'TA::index');
$routes->group("ta", function ($routes) {
    $routes->get('home', 'TA::index', ['as' => 'ta.home']);
    $routes->get('baca/(:any)', 'TA::baca/$1', ['as' => 'ta.baca']);    //  dashboard > baca data   
    $routes->get('tambah', 'TA::tambah', ['as' => 'ta.tambah']);  //  dashboard (cv) > tambah data
    $routes->post('tambah', 'TA::simpan', ['as' => 'ta.tambah']); //  dashboard > simpan data
    $routes->get('edit/(:num)', 'TA::edit/$1', ['as' => 'ta.edit']);    //  dashboard > edit/update data
    $routes->put('edit/(:num)', 'TA::update/$1', ['as' => 'ta.edit']);  //  dashboard > simpan update
    $routes->get('hapus/(:any)', 'TA::delete/$1', ['as' => 'ta.hapus']);
    $routes->get('posisi/(:any)', 'TA::posisi/$1', ['as' => 'ta.posisi']);
    $routes->get('usia/(:num)', 'TA::usia/$1', ['as' => 'ta.usia']);
    $routes->get('sarjana/(:any)', 'TA::sarjana/$1', ['as' => 'ta.sarjana']);
    $routes->get('master/(:any)', 'TA::master/$1', ['as' => 'ta.master']);
    $routes->get('doktor/(:any)', 'TA::doktor/$1', ['as' => 'ta.doktor']);
    $routes->get('cetakpdf', 'TA::exportpdf', ['as' => 'ta.cetakpdf']);
    $routes->post('hapus_semua', 'TA::hapus_semua', ['as' => 'ta.hapus_semua']);
    $routes->get('help', 'TA::help', ['as' => 'ta.help']);
});

$routes->get('/cv', 'CV::index');
$routes->group("cv", function ($routes) {
    $routes->get('home', 'CV::index', ['as' => 'cv.home']);
    $routes->get('cetak/(:any)', 'CV::cetakCV/$1', ['as' => 'cv.cetak']);
    $routes->get('intermitten', 'CV::intermitten', ['as' => 'cv.intermitten']);
});
//  Mencetak intermitten untuk urutan yang berdekatan (pada halaman yang sama) 
$routes->get('/imt', 'Imt::index');
$routes->group("imt", function ($routes) {
    $routes->get('home', 'Imt::index', ['as' => 'imt.home']);
    $routes->get('cetak/(:any)', 'Imt::cetakCV/$1', ['as' => 'imt.cetak']);
    $routes->get('intermitten_detil', 'Imt::intermitten_detil', ['as' => 'imt.intermitten_detil']);
});

//  Mencetak intermitten untuk urutan (jaraknya) berjauhan (hanya 1 halaman) 
$routes->get('/imt2', 'Imt2::index');
$routes->group("imt2", function ($routes) {
    $routes->get('home', 'Imt2::index', ['as' => 'imt2.home']);
    $routes->get('cetak/(:any)', 'Imt2::cetakCV/$1', ['as' => 'imt2.cetak']);
    $routes->get('intermitten_detil', 'Imt2::intermitten_detil', ['as' => 'imt2.intermitten_detil']);
});

$routes->get('/water', 'Water::index');
$routes->group("water", function ($routes) {
    $routes->get('home', 'Water::index', ['as' => 'water.home']);
    $routes->get('cetak/(:any)', 'Water::cetak/$1', ['as' => 'water.cetak']);
});


//////////////////////// Laporan laporanIntermitten ////////////////////// 
$routes->get('laporanIntermitten/(:any)', 'PrintController::cetaklaporanIntermitten/$1');

//  Export   / import untuk tabel tb_ta (tenaga ahli)
//---------------------------- export - import file excel--------------------------------
$routes->get('exporExcel', 'ExcelController::exportExcel'); //  Export ke file Excel
$routes->post('imporExcel', 'ExcelController::importExcel'); //  Import dari file Excel
//$routes->get('uploadExcel', 'ExcelController::exportExcel');
//---------------------------- export - import file excel------------------
/////////////////////////////////// END FILTER   ///////////////////////////////////////////////////////////////////

/********************PENGALAMAN-------------------------------------------------------------------------------- */
$routes->get('/pengalaman', 'Pengalaman::index');
$routes->group("pengalaman", function ($routes) {
    $routes->get('home', 'Pengalaman::index', ['as' => 'pengalaman.home']);
    $routes->get('baca/(:num)', 'Pengalaman::baca/$1', ['as' => 'pengalaman.baca']);
    $routes->get('tambah', 'Pengalaman::tambah_exp', ['as' => 'pengalaman.tambah']);     //  Tambah pengalaman tenaga ahli 
    $routes->post('tambah', 'Pengalaman::simpan_exp/$1', ['as' => 'pengalaman.tambah']);
    $routes->put('edit/(:num)', 'Pengalaman::update_exp/$1', ['as' => 'pengalaman.edit']);
    $routes->get('edit/(:num)', 'Pengalaman::edit_exp/$1', ['as' => 'pengalaman.edit']);
    $routes->get('hapus/(:num)', 'Pengalaman::delete/$1', ['as' => 'pengalaman.hapus']);
    $routes->get('tambahTA', 'Pengalaman::tambahTA', ['as' => 'pengalaman.tambahTA']);     //  Tambah pengalaman tenaga ahli 
    $routes->post('tambahTA', 'Pengalaman::simpanTA', ['as' => 'pengalaman.tambahTA']);
    $routes->get('tambahPengalaman', 'Pengalaman::tambahPengalaman', ['as' => 'pengalaman.tambahPengalaman']);     //  Tambah pengalaman tenaga ahli 
    $routes->post('tambahPengalaman', 'Pengalaman::simpanPengalaman', ['as' => 'pengalaman.tambahPengalaman']);
    $routes->get('cetakpdf', 'Pengalaman::exportpdf', ['as' => 'pengalaman.cetakpdf']);

    //  Pengganti dari: $routes->post('imporxlsExp', 'EximController::importExcel');
    $routes->post('importExcel', 'Pengalaman::importExcel', ['as' => 'pengalaman.importExcel']);
});


//////////////// Awal Pengalaman TENAGA AHLI   //////////////////////////////////////////////
//  
$routes->get('/ta-exp', 'TA_Pengalaman::index');
$routes->group("ta-exp", function ($routes) {
    $routes->get('home', 'TA_Pengalaman::index', ['as' => 'ta-exp.home']);
    $routes->get('baca/(:any)', 'TA_Pengalaman::baca/$1', ['as' => 'ta-exp.baca']);
    $routes->get('tambah', 'TA_Pengalaman::tambah', ['as' => 'ta-exp.tambah']);
    $routes->post('tambah', 'TA_Pengalaman::simpan', ['as' => 'ta-exp.tambah']);
    $routes->get('edit/(:num)', 'TA_Pengalaman::edit/$1', ['as' => 'ta-exp.edit']);
    $routes->post('edit/(:num)', 'TA_Pengalaman::update/$1', ['as' => 'ta-exp.edit']);
    $routes->get('hapus/(:num)', 'TA_Pengalaman::delete/$1', ['as' => 'ta-exp.hapus']);
    $routes->get('FilterTAByName/(:any)', 'TA_Pengalaman::FilterTAByName/$1', ['as' => 'ta-exp.FilterTAByName']);
    $routes->get('FilterTAByID/(:num)', 'TA_Pengalaman::FilterTAByID/$1', ['as' => 'ta-exp.FilterTAByID']);
    $routes->get('FilterProyekByName/(:any)', 'TA_Pengalaman::FilterProyekByName/$1', ['as' => 'ta-exp.FilterProyekByName']);
    $routes->get('FilterProyekByID/(:num)', 'TA_Pengalaman::FilterProyekByID/$1', ['as' => 'ta-exp.FilterProyekByID']);
    // $routes->get('exporPengalaman', 'TA_Pengalaman::exportExcel'); //  Export ke file Excel
    $routes->post('importExcel', 'TA_Pengalaman::importExcel', ['as' => 'ta-exp.importExcel']); //  Import dari file Excel
    $routes->get('intermitten/(:any)', 'TA_Pengalaman::intermitten/$1', ['as' => 'ta-exp.intermitten']);
});
//////////////// Awal Pengalaman TENAGA AHLI   //////////////////////////////////////////////
//$routes->get('/experience', 'Experience::index');
//$routes->get('/experience/ajax', 'Experience::ajax');

$routes->get('fNama/(:any)', 'exp\expController::FilterByName/$1');

//  Export   / import untuk tabel tb_proyek (pengalaman)
$routes->get('exporxlsExp', 'EximController::exportExcel'); //  Export ke file Excel
//$routes->post('imporxlsExp', 'EximController::importExcel'); //  Import dari file Excel
/********************PENGALAMAN-------------------------------------------------------------------------------- */

//  Export   / import untuk tabel jurusan (pengalaman)
$routes->get('expor_jurusan', 'JurusanController::exportExcel'); //  Export ke file Excel
$routes->post('impor_jurusan', 'JurusanController::importExcel'); //  Import dari file Excel
/********************PENGALAMAN-------------------------------------------------------------------------------- */

/**************************************SERTIFIKAT*********************************************/

$routes->get('/sertifikat', 'SertController::index');
$routes->group("sertifikat", function ($routes) {
    //  $routes->get('index', 'SertController::index', ['as'=>'sertifikat.index']);
    $routes->get('baca/(:num)', 'SertController::baca/$1', ['as' => 'sertifikat.baca']);
    $routes->get('tambah', 'SertController::tambah', ['as' => 'sertifikat.tambah']);     //  Tambah pengalaman tenaga ahli 
    $routes->post('tambah', 'SertController::simpan', ['as' => 'sertifikat.tambah']);
    $routes->get('edit/(:num)', 'SertController::edit/$1', ['as' => 'sertifikat.edit']);     //  Tambah pengalaman tenaga ahli 
    $routes->post('edit/(:num)', 'SertController::update/$1', ['as' => 'sertifikat.edit']);
    $routes->get('hapus/(:num)', 'SertController::delete/$1', ['as' => 'sertifikat.hapus']);
});
$routes->get('/upload', 'Upload::index');
$routes->get('/proses', 'Proses::index');

/*-----------------------------------BAHASA-------------------------------------------*/
$routes->get('/bahasa', 'BahasaController::index');
$routes->group("bahasa", function ($routes) {
    $routes->get('baca/(:num)', 'BahasaController::baca/$1', ['as' => 'bahasa.baca']);
    $routes->get('tambah', 'BahasaController::tambah', ['as' => 'bahasa.tambah']);
    $routes->post('tambah', 'BahasaController::simpan', ['as' => 'bahasa.tambah']);
    $routes->post('edit/(:num)', 'BahasaController::update/$1', ['as' => 'bahasa.edit']);
    $routes->get('edit/(:num)', 'BahasaController::edit/$1', ['as' => 'bahasa.edit']);
    $routes->get('hapus/(:num)', 'BahasaController::delete/$1', ['as' => 'bahasa.hapus']);
    $routes->get('filter-Nama-TA-bahasa/(:any)', 'BahasaController::FilterByName/$1');
});
/*-------------------------------END OF BAHASA------------------------------------------*/

/**************************************POSISI*********************************************/
$routes->get('/posisi', 'PosisiController::index');
$routes->group("posisi", function ($routes) {
    $routes->get('baca/(:num)', 'PosisiController::baca/$1', ['as' => 'posisi.baca']);
    $routes->get('tambah', 'PosisiController::tambah', ['as' => 'posisi.tambah']);
    $routes->post('tambah', 'PosisiController::simpan', ['as' => 'posisi.tambah']);
    $routes->post('edit/(:num)', 'PosisiController::update/$1', ['as' => 'posisi.edit']);
    $routes->get('edit/(:num)', 'PosisiController::edit/$1', ['as' => 'posisi.edit']);
    $routes->get('hapus/(:num)', 'PosisiController::delete/$1', ['as' => 'posisi.hapus']);
    $routes->post('importExcel', 'PosisiController::importExcel', ['as' => 'posisi.importExcel']);
});
/*----------------------------------END OF POSISI-------------------------------------*/

////////////////    KATEGORI  //////////////////////////////////////////////
$routes->get('/kategori', 'CategoryController::index');   //  Proyek tenaga ahli
$routes->group("kategori", function ($routes) {
    $routes->post('tambah', 'CategoryController::simpan', ['as' => 'kategori.tambah']);
    $routes->get('tambah', 'CategoryController::tambah', ['as' => 'kategori.tambah']);
    $routes->post('edit/(:num)', 'CategoryController::update/$1', ['as' => 'kategori.edit']);
    $routes->get('edit/(:num)', 'CategoryController::edit/$1', ['as' => 'kategori.edit']);
    $routes->get('hapus/(:num)', 'CategoryController::delete/$1', ['as' => 'kategori.hapus']);
});
////////////////    KATEGORI  //////////////////////////////////////////////

/*-----------------------------------Lampiran-------------------------------------------*/
$routes->get('/lampiran', 'LampiranController::index');
$routes->group("lampiran", function ($routes) {
    $routes->get('tambah', 'LampiranController::tambah', ['as' => 'lampiran.tambah']);
    $routes->post('tambah', 'LampiranController::simpan', ['as' => 'lampiran.tambah']);
    $routes->get('baca/(:num)', 'LampiranController::baca/$1', ['as' => 'lampiran.baca']);    //  dashboard > edit/update data
    $routes->get('hapus/(:num)', 'LampiranController::delete/$1', ['as' => 'lampiran.hapus']);
    
    $routes->get('edit/(:num)', 'LampiranController::edit/$1', ['as' => 'lampiran.edit']);
    $routes->post('edit/(:num)', 'LampiranController::update/$1', ['as' => 'lampiran.edit']);
    
    $routes->get('filterNama/(:any)', 'LampiranController::FilterByName/$1');
});
/*-------------------------------END OF Lampiran------------------------------------------*/

/*-----------------------------------Ijin Usaha-------------------------------------------*/
$routes->get('/ijin', 'ijin\IjinController::index');
$routes->get('tambah-ijin', 'ijin\IjinController::tambah_ijin');
$routes->post('tambah-ijin', 'ijin\IjinController::simpan_tambah_ijin');
$routes->get('edit-ijin/(:num)', 'ijin\IjinController::edit_ijin/$1');    //  dashboard > edit/update data
$routes->post('edit-ijin/(:num)', 'ijin\IjinController::simpan_edit_ijin/$1');  //  dashboard > simpan update
$routes->get('delete-ijin/(:num)', 'ijin\IjinController::delete_ijin/$1', ['as' => 'deleteijin']);
/*-------------------------------END OF Ijin Usaha------------------------------------------*/

/*-----------------------------------Pajak-------------------------------------------*/
$routes->get('pajak', 'pajak\PajakController::index');
$routes->get('tambah-pajak', 'pajak\PajakController::tambah_pajak');
$routes->post('tambah-pajak', 'pajak\PajakController::simpan_tambah_pajak');
$routes->get('edit-pajak/(:num)', 'pajak\PajakController::edit_pajak/$1');    //  dashboard > edit/update data
$routes->post('edit-pajak/(:num)', 'pajak\PajakController::simpan_edit_pajak/$1');  //  dashboard > simpan update
$routes->get('delete-pajak/(:num)', 'pajak\PajakController::delete_pajak/$1', ['as' => 'deletepajak']);
/*-------------------------------Pajak------------------------------------------*/

/*-----------------------------------Tender-------------------------------------------*/
$routes->get('/tender', 'Tender::index');
$routes->group("tender", function ($routes) {
    $routes->get('baca/(:num)', 'Tender::baca/$1', ['as' => 'tender.baca']);
    $routes->get('tambah', 'Tender::tambah', ['as' => 'tender.tambah']);
    $routes->post('tambah', 'Tender::simpan', ['as' => 'tender.tambah']);
    $routes->get('edit/(:num)', 'Tender::edit/$1', ['as' => 'tender.edit']);    //  dashboard > edit/update data
    $routes->post('edit/(:num)', 'Tender::update/$1', ['as' => 'tender.edit']);  //  dashboard > simpan update
    $routes->get('hapus/(:num)', 'Tender::delete/$1', ['as' => 'tender.hapus']);
});
/*-------------------------------Pajak------------------------------------------*/

/*-----------------------------------Dokumen (Akta)-------------------------------------------*/
$routes->get('akta', 'Akta::index');
$routes->group("akta", function ($routes) {
    $routes->get('tambah', 'Akta::tambah', ['as' => 'akta.tambah']);
    $routes->post('tambah', 'Akta::simpan', ['as' => 'akta.tambah']);
    $routes->get('edit/(:num)', 'Akta::edit/$1', ['as' => 'akta.edit']);    //  dashboard > edit/update data
    $routes->post('edit/(:num)', 'Akta::update/$1', ['as' => 'akta.edit']);  //  dashboard > simpan update
    $routes->get('hapus/(:num)', 'Akta::delete/$1', ['as' => 'akta.hapus']);
});
/*-------------------------------END OF Dokumen(Akta)------------------------------------------*/

$routes->setTranslateURIDashes(false);
$routes->set404Override();

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
