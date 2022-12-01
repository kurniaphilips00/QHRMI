<?php

namespace App\Controllers\Admin;
use App\Models\posisiModel;
use App\Controllers\BaseController;

class PosisiController extends BaseController
{
    public function __construct()
    {         
        $posisi = $this->posisiModel = new posisiModel();     
    }
    
    public function index()
    {
        $posisi = $this->posisiModel->getPosisi();
        $data = [            
            'posisi' => $posisi
        ];
        return view ('admin/posisi/index', $data);
    }

    public function tambah_posisi() {
        $data = [
            'posisi'=>esc($this->request->getPost('posisi'))
        ];
        $this->posisiModel->insert($data);
        return redirect()->back()->with('sukses','Data posisi berhasil ditambah');
    }
    public function update_posisi($id) {
        $data = [
            'id'=>esc($this->request->getPost('id')),
            'posisi'=>esc($this->request->getPost('posisi'))
                ];
        $this->posisiModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data posisi berhasil diubah');
    }
    public function delete_posisi($id) {
        $this->posisiModel->delete($id);
        session()->setFlashdata('success','Data posisi berhasil dihapus');
        return redirect()->to('posisi');
    }
}
