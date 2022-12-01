<?php

namespace App\Controllers\Admin;
use App\Models\rhModel;
use App\Models\sertModel;
use App\Controllers\BaseController;


class SertController extends BaseController
{
    public function __construct()
    {
         //  ta diperlukan untuk menambah data memakai modal > c:\xampp\htdocs\ta\app\Views\admin\sertifikat\index.php  
        $ta = $this->taModel = new rhModel();   
        $sert = $this->sertModel = new sertModel();   
        $sertifikat = $this->sertModel = new sertModel(); 
    }
    public function index() {
        $ta = $this->taModel->getCV();
        $sertifikat = $this->sertModel->getJoin();   
        $data = [  
            'ta' => $ta,   // baris 110 file index.php > menampilkan pilihan nama tenaga ahli dan nomor id    
                        //  memakai drop down menu     
            'sertifikat' =>  $sertifikat
        ];
        return view ('admin/sertifikat/index', $data);
    }
    public function tambah_sertifikat() {
        $rules = $this->validate([
            'sertifikat'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Sertifikat harus diisi.',
                ],
            ]
        ]);
        if (!$rules) {
            session()->setFlashdata('gagal-menambah-sertifikat','Tambah data sertifikat gagal !!!');
            return redirect()->back()->with('gagal-menambah-sertifikat','Data sertifikat gagal ditambah');
          } 
          else {
            $data = [
                    'kode_ta'=>esc($this->request->getPost('kode_ta')),   
                    'sertifikat'=>esc($this->request->getPost('sertifikat')) 
            ];
            $this->sertModel->insert($data);
            return redirect()->back()->with('sukses-menambah-sertifikat','Data sertifikat berhasil ditambah');
        }
    }
    public function update_sertifikat($id) {
        $data = [
              
            'sertifikat'=>esc($this->request->getPost('sertifikat')) 
                ];
        $this->sertModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data sertifikat berhasil diubah');
    }
    public function delete_sertifikat($id) {
       // dd($id);
        $this->sertModel->delete($id);
        session()->setFlashdata('success','Data berhasil dihapus');
        return redirect()->to('sertifikat');
    }
}