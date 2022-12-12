<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CVController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'cv\CVController::index');
$routes->get('cv', 'cv\CVController::index');
//$routes->post('add', 'cv\CVController::simpan');
//$routes->get('update/(:num)', 'cv\CVController::update/S1');
//$routes->get('/', 'ta\TA::index');
//$routes->get('ta', 'ta\TA::index');
//$routes->get('ta/indexAjax', 'ta\TA::indexAjax');
$routes->get('tambah-CV', 'cv\CVController::create');  //  dashboard (cv) > tambah data
$routes->post('tambah-CV', 'cv\CVController::simpan', ['as'=>'simpan']); //  dashboard > simpan data
//////////////////  MEMBACA DATA CV DENGAN MODAL (BOOTSTRAP 5) ///////////////// 
$routes->get('baca-CV/(:any)', 'cv\CVController::read/$1'); 
//////////////////  MEMBACA DATA CV DENGAN MODAL (BOOTSTRAP 5)  ////////////////

$routes->get('update/(:num)', 'cv\CVController::update/$1', ['as'=>'upd']);    //  dashboard > edit/update data
$routes->put('update/(:num)', 'cv\CVController::simpan_update/$1', ['as'=>'simdat']);  //  dashboard > simpan update
$routes->get('delete/(:num)', 'cv\CVController::delete/$1', ['as'=>'delete']);                      //  dashboard > hapus data
//  Membuat laporan pdf Curriculum Vitae tanpa memmbuat halaman baru ( menampilkan lengsung pada halaman yang sama ) 
$routes->get('cetak-laporan/(:num)', 'cv\PrintController::cetak/$1');        
//  Membuat laporan pdf Curriculum Vitae dengan memmbuat halaman baru ( menampilkan pada halaman lain )                                
$routes->get('laporan1/(:num)', 'cv\PrintController::cetak/$1');  
//  Membuat laporan pdf Curriculum Vitae tanpa membuat tampilan ( preview ), langsung download dan cetak ke folder Downloads   
$routes->get('laporan2/(:num)', 'cv\PrintController::cetak2/$1');  
//////////////////////// Laporan laporanIntermitten ////////////////////// 
$routes->get('laporanIntermitten/(:num)', 'cv\PrintController::cetaklaporanIntermitten/$1'); 


/////////////////////////////////// START FILTER   ///////////////////////////////////////////////////////////////////
$routes->get('fPosisi/(:any)', 'cv\CVController::fPosisi/$1'); 
$routes->get('fUsia/(:num)', 'cv\CVController::Usia/$1'); 
$routes->get('fSarjana/(:any)', 'cv\CVController::OrderByEducation/$1'); 
$routes->get('fMaster/(:any)', 'cv\CVController::OrderByMaster/$1'); 
$routes->get('Doctor/(:any)', 'cv\CVController::OrderByDoktor/$1'); 
$routes->post('urutSIPP_ED', 'cv\CVController::OrderBySIPPED'); 

////////////////////////// Help    //////////////////////////////////////////
$routes->get('help', 'cv\CVController::sop');               
////////////////////////// End Help   //////////////////////////////////////////


//---------------------------- export - import file excel--------------------------------
$routes->get('exporExcel', 'cv\ExcelController::exportExcel'); //  Export ke file Excel
$routes->post('imporExcel', 'cv\ExcelController::importExcel'); //  Import dari file Excel
//---------------------------- export - import file excel------------------
/////////////////////////////////// END FILTER   ///////////////////////////////////////////////////////////////////

/********************PENGALAMAN-------------------------------------------------------------------------------- */
$routes->get('pengalaman', 'exp\expController::index');
$routes->get('edit-pengalaman/(:any)', 'exp\expController::edit_exp/$1');   //  Edit pengalaman tenaga ahli
$routes->post('edit-pengalaman/(:any)', 'exp\expController::update_exp/$1', ['as'=>'simdat']);//  Simpan edit pengalaman tenaga ahli
$routes->get('tambah-pengalaman', 'exp\expController::tambah_exp');     //  Tambah pengalaman tenaga ahli 
$routes->post('tambah-pengalaman', 'exp\expController::simpan_exp/$1'); //  Simpan tambah pengalaman tenaga ahli 
//  Tidak bisa memakai modal, karena tidak bisa mengirim variabel posisi ke modal
$routes->get('delete-pengalaman/(:num)', 'exp\expController::delete_exp/$1', ['as'=>'delexp']); 
$routes->get('fNama/(:any)', 'exp\expController::FilterByName/$1'); 
/********************PENGALAMAN-------------------------------------------------------------------------------- */

/**************************************SERTIFIKAT*********************************************/
$routes->get('sertifikat', 'sertifikat\SertController::index'); //sertifikat tenaga ahli
$routes->get('delete-sertifikat/(:num)', 'sertifikat\SertController::delete_sertifikat/$1', ['as'=>'deletesert']); 
$routes->post('tambah-sertifikat', 'sertifikat\SertController::tambah_sertifikat');
$routes->post('baca-sertifikat(:num)', 'sertifikat\SertController::baca_sertifikat/$1');
$routes->post('update-sertifikat(:num)', 'sertifikat\SertController::update_sertifikat/$1');
/**************************************END OF SERTIFIKAT*********************************************/

/**************************************POSISI*********************************************/      
$routes->get('position', 'posisi\PosisiController::index');   
$routes->post('tambah-posisi', 'posisi\PosisiController::tambah_posisi');
$routes->post('update-posisi(:num)', 'posisi\PosisiController::update_posisi/$1');
$routes->get('delete-posisi/(:num)', 'posisi\PosisiController::delete_posisi/$1'); 
/*----------------------------------END OF POSISI-------------------------------------*/

/*-----------------------------------JURUSAN-------------------------------------------*/
$routes->get('jurusan', 'jurusan\JurusanController::index');   
$routes->post('tambah-jurusan', 'jurusan\JurusanController::tambah_jurusan');
$routes->post('update-jurusan(:num)', 'jurusan\JurusanController::update_jurusan/$1');
$routes->get('delete-jurusan/(:num)', 'jurusan\JurusanController::delete_jurusan/$1'); 
/*-----------------------------------END OF JURUSAN-------------------------------------------*/

/*-----------------------------------BAHASA-------------------------------------------*/     
$routes->get('bahasa', 'bahasa\BahasaController::index');           
$routes->post('tambah-bahasa', 'bahasa\BahasaController::tambah_bahasa');
$routes->post('update-bahasa(:num)', 'bahasa\BahasaController::update_bahasa/$1');
$routes->get('delete-bahasa/(:num)', 'bahasa\BahasaController::delete_bahasa/$1', ['as'=>'deletebhs']); 
/*-------------------------------END OF BAHASA------------------------------------------*/

////////////////    PROYEK  //////////////////////////////////////////////
$routes->get('proyek', 'proyek\ProyekController::index');   //  Proyek tenaga ahli
$routes->post('tambah-proyek', 'proyek\ProyekController::tambah_proyek');
$routes->post('update-proyek(:num)', 'proyek\ProyekController::update_proyek/$1');
$routes->get('delete-proyek/(:num)', 'proyek\ProyekController::delete_proyek/$1', ['as'=>'deleteproyek']); 
////////////////    PROYEK  //////////////////////////////////////////////

////////////////    KATEGORI  //////////////////////////////////////////////
$routes->get('kategori', 'kategori\CategoryController::index');   //  Proyek tenaga ahli
$routes->post('tambah-kategori', 'kategori\CategoryController::tambah_kategori');
$routes->post('update-kategori(:num)', 'kategori\CategoryController::update_kategori/$1');
$routes->get('delete-kategori/(:num)', 'kategori\CategoryController::delete_kategori/$1'); 
////////////////    KATEGORI  //////////////////////////////////////////////


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
