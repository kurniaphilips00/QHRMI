<?php

namespace App\Controllers;

use App\Models\rhModel;
use App\Models\posisiModel;
//use App\Models\kategoriModel;
//use App\Models\jurusanModel;

class Home extends BaseController
{
    protected $rhModel;
    protected $posisiModel;
   // protected $kategoriModel;
   // protected $jurusanModel;
    public function __construct()
    {
        $rh = $this->rhModel = new rhModel();        
        $posisi = $this->posisiModel = new posisiModel();    
      //  $kategori = $this->kategoriModel = new kategoriModel(); 
      //  $jurusan = $this->jurusanModel = new jurusanModel(); 
    }
    public function index()
    {
        $posisi = $this->posisiModel->getPosisi();
        $cv = $this->rhModel->getCV();
        $data = [   'judul' => 'Data Tenaga Ahli', 'cv' => $cv, 'posisi' => $posisi  ]; 
        return view('cv', $data);
    }
    public function simpan() {   
      print_r($_POST);
      print_r($_FILES);
    /*    $file = $this->request->getFile('pasfoto');
        $filename = $file->getRandomName();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'pasfoto' => $filename
        ];   
     $validation = \Config\Services::validation();
     $validation->setRules([
        'pasfoto' => 'uploaded[pasfoto]|max_size[pasfoto,1024]|is_image[pasfoto]|mime_in[pasfoto,image/jpg,image/jpeg,
        image/png]',
     ]);
     if (!$validation->withRequest($this->request)->run()){
        return $this->response->setJSON([
            'error' => true,
            'message' => $validation->getErrors()
        ]);
     }
     else {
        $file->move('uploads', $filename);
        $cv = $this->rhModel->getCV();
        $cv->save($data);
        return $this->response->setJSON([
            'error'=>false,
            'message'=>'Sukses menambah data'
        ]);
     }*/
    }
}
