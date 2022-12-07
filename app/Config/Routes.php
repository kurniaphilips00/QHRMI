<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

//  Load the system's routing file first, 
//  so that the app and ENVIRONMENT
//  can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
//$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('TA');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();




$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin\Dashboard');
//$routes->setDefaultController('PostController');
$routes->setDefaultMethod('index');
//$routes->setTranslateURIDashes(false);
//$routes->set404Override();

$routes->setAutoRoute(false);

// We get a performance increase by specifying the default
// DASHBOARD////////////////////////////////
//$routes->get('/', 'PostController::index');
//$routes->post('post/add', 'PostController::add');
$routes->get('/', 'Admin\Dashboard::index', ['as'=>'ta']);
$routes->get('admin', 'Admin\Dashboard::index');//dashboard route
$routes->get('tambah-CV', 'Admin\Dashboard::create');  //  dashboard (cv) > tambah data
$routes->post('tambah-CV', 'Admin\Dashboard::simpan', ['as'=>'simpan']); //  dashboard > simpan data
$routes->get('fPosisi/(:any)', 'Admin\Dashboard::fPosisi/$1'); 
$routes->get('fUsia/(:num)', 'Admin\Dashboard::Usia/$1'); 
$routes->get('fSarjana/(:any)', 'Admin\Dashboard::OrderByEducation/$1'); 
$routes->get('fMaster/(:any)', 'Admin\Dashboard::OrderByMaster/$1'); 

/////////////////////////////////// Pendidikan S3   ///////////////////////////////////////////////////////////////////
$routes->get('Doctor/(:any)', 'Admin\Dashboard::OrderByDoktor/$1'); 


//////////////////////// export - import file excel////////////////////////////////////////////////////////////////
$routes->get('exporExcel', 'Admin\ExcelController::exportExcel'); //  Export ke file Excel
$routes->post('imporExcel', 'Admin\ExcelController::importExcel'); //  Import dari file Excel

$routes->post('urutSIPP_ED', 'Admin\Dashboard::OrderBySIPPED'); 
//////////////////  MEMBACA DATA CV DENGAN MODAL (BOOTSTRAP 5) ///////////////// 
$routes->get('baca-CV/(:any)', 'Admin\Dashboard::read/$1'); 
//////////////////  MEMBACA DATA CV DENGAN MODAL (BOOTSTRAP 5)  ////////////////

$routes->get('update/(:num)', 'Admin\Dashboard::update/$1', ['as'=>'upd']);    //  dashboard > edit/update data
$routes->put('update/(:num)', 'Admin\Dashboard::simpan_update/$1', ['as'=>'simdat']);  //  dashboard > simpan update
//$routes->post('update/(:num)', 'Admin\Dashboard::simpan_update/$1', ['as'=>'simdat'], ['filter' => 'role:administrator']);              
$routes->get('delete/(:num)', 'Admin\Dashboard::delete/$1', ['as'=>'delete']);                      //  dashboard > hapus data
//  Membuat laporan pdf Curriculum Vitae tanpa memmbuat halaman baru ( menampilkan lengsung pada halaman yang sama ) 
$routes->get('cetak-laporan/(:num)', 'Admin\PrintController::cetak/$1');        
//  Membuat laporan pdf Curriculum Vitae dengan memmbuat halaman baru ( menampilkan pada halaman lain )                                
$routes->get('laporan1/(:num)', 'Admin\PrintController::cetak/$1');  
//  Membuat laporan pdf Curriculum Vitae tanpa membuat tampilan ( preview ), langsung download dan cetak ke folder Downloads   
$routes->get('laporan2/(:num)', 'Admin\PrintController::cetak2/$1');  
//////////////////////// Laporan laporanIntermitten ////////////////////// 
$routes->get('laporanIntermitten/(:num)', 'Admin\PrintController::cetaklaporanIntermitten/$1');  


////////////  PENGALAMAN      /////////////////////////////////
$routes->get('pengalaman', 'Admin\ExpController::index');               //  Daftar pengalaman tenaga ahli 
$routes->get('tambah-pengalaman', 'Admin\ExpController::tambah_exp');                       //  Tambah pengalaman tenaga ahli 
$routes->post('tambah-pengalaman', 'Admin\ExpController::simpan_exp/$1'); //  Simpan tambah pengalaman tenaga ahli 
$routes->get('baca-pengalaman/(:any)', 'Admin\ExpController::baca_pengalaman/$1'); 
$routes->get('edit-pengalaman/(:any)', 'Admin\ExpController::edit_exp/$1');
$routes->post('edit-pengalaman/(:any)', 'Admin\ExpController::update_exp/$1');
//  Tidak bisa memakai modal, karena tidak bisa mengirim variabel posisi ke modal
$routes->get('delete-pengalaman/(:num)', 'Admin\ExpController::delete_exp/$1', ['as'=>'delexp']); 
$routes->get('fNama/(:any)', 'Admin\ExpController::FilterByName/$1'); 
////////////  END OF PENGALAMAN      /////////////////////////////////

/////////////////////SERTIFIKAT////////////////////////////////////
$routes->get('sertifikat', 'Admin\SertController::index'); //sertifikat tenaga ahli
$routes->get('delete-sertifikat/(:num)', 'Admin\SertController::delete_sertifikat/$1', ['as'=>'deletesert']); 
$routes->post('tambah-sertifikat', 'Admin\SertController::tambah_sertifikat');
$routes->post('baca-sertifikat(:num)', 'Admin\SertController::baca_sertifikat/$1');
$routes->post('update-sertifikat(:num)', 'Admin\SertController::update_sertifikat/$1');
/////////////////////SERTIFIKAT////////////////////////////////////

////////////////    POSISI  //////////////////////////////////////////////
$routes->get('position', 'posisi\PositionController::index');   
$routes->post('tambah-posisi', 'posisi\PositionController::tambah_posisi');
$routes->post('update-posisi(:num)', 'posisi\PositionController::update_posisi/$1');
$routes->get('delete-posisi/(:num)', 'posisi\PositionController::delete_posisi/$1'); 
////////////////    POSISI  //////////////////////////////////////////////


///////////////    JURUSAN  //////////////////////////////////////////////
$routes->get('jurusan', 'jurusan\JurusanController::index');   
$routes->post('tambah-jurusan', 'jurusan\JurusanController::tambah_jurusan');
$routes->post('update-jurusan(:num)', 'jurusan\JurusanController::update_jurusan/$1');
$routes->get('delete-jurusan/(:num)', 'jurusan\JurusanController::delete_jurusan/$1'); 
////////////////    JURUSAN  //////////////////////////////////////////////


/////////////////////////   BAHASA  //////////////////////////////////////////
$routes->get('bahasa', 'Admin\BahasaController::index');           //   Bahasa tenaga ahli
$routes->post('tambah-bahasa', 'Admin\BahasaController::tambah_bahasa');
$routes->post('update-bahasa(:num)', 'Admin\BahasaController::update_bahasa/$1');
$routes->get('delete-bahasa/(:num)', 'Admin\BahasaController::delete_bahasa/$1', ['as'=>'deletebhs']); 
/////////////////////////  END OF BAHASA  //////////////////////////////////////////

////////////////////////// Standard Operating Procedure    //////////////////////////////////////////
$routes->get('help', 'Admin\Dashboard::sop');               
////////////////////////// End Standard Operating Procedure   //////////////////////////////////////////

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

/////////////////////////   akun  //////////////////////////////////////////
$routes->get('akun', 'UserController::index', ['as'=>'user']); 
$routes->post('update-user(:num)', 'UserController::update_user/$1');
$routes->get('delete-user/(:num)', 'UserController::delete_user/$1'); 
/////////////////////////   akun  //////////////////////////////////////////


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
