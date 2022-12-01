<?php

namespace App\Controllers\proyek;

use App\Models\proyekModel;
use App\Controllers\BaseController;

class ProyekController extends BaseController
{
    public function __construct()
    {         
        $proyek = $this->proyekModel = new proyekModel();     
    }
    
    public function index()
    {
        $proyek = $this->proyekModel->getProyek();
        $data = [            
            'proyek' => $proyek
        ];
       // dd($data);
        return view ('/proyek/index', $data);
    }

    public function tambah_proyek() {
       
        $data = [
                'instansi'=>esc($this->request->getPost('instansi')),
                'pekerjaan'=>esc($this->request->getPost('pekerjaan')), 
                'ruang_lingkup'=>esc($this->request->getPost('ruang_lingkup')),
                'lokasi'=>esc($this->request->getPost('lokasi')), 
                'alamat'=>esc($this->request->getPost('alamat')),
                'nokontrak'=>esc($this->request->getPost('nokontrak')), 
                'mulai'=>esc($this->request->getPost('mulai')),
                'selesai'=>esc($this->request->getPost('selesai')),
                'nilai'=>esc($this->request->getPost('nilai'))  
        ];
        
        $this->proyekModel->insert($data);
        return redirect()->back()->with('sukses','Data proyek berhasil ditambah');
    }
    public function update_proyek($id) {
        $data = [
            'id'=>esc($this->request->getPost('id')),
            'instansi'=>esc($this->request->getPost('instansi')),
            'pekerjaan'=>esc($this->request->getPost('pekerjaan')), 
            'ruang_lingkup'=>esc($this->request->getPost('ruang_lingkup')),
            'lokasi'=>esc($this->request->getPost('lokasi')), 
            'alamat'=>esc($this->request->getPost('alamat')),
            'nokontrak'=>esc($this->request->getPost('nokontrak')), 
            'mulai'=>esc($this->request->getPost('mulai')),
            'selesai'=>esc($this->request->getPost('selesai')),
            'nilai'=>esc($this->request->getPost('nilai'))  
                ];
        $this->proyekModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data proyek berhasil diubah');
    }
    public function delete_proyek($id) {
        
        $this->proyekModel->delete($id);
        session()->setFlashdata('success','Data berhasil dihapus');
        return redirect()->to('proyek');
    }
}
