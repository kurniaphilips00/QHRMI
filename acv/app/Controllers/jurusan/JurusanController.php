<?php

namespace App\Controllers\jurusan;
use App\Models\jurusanModel;
use App\Controllers\BaseController;

class JurusanController extends BaseController
{
    public function __construct()
    {         
        $jurusan = $this->jurusanModel = new jurusanModel();     
    }
    
    public function index()
    {
        $jurusan = $this->jurusanModel->getJurusan();
        $data = [            
            'jurusan' => $jurusan
        ];
        return view ('jurusan/index', $data);
    }

    public function tambah_jurusan() {
        $data = [
            'jurusan'=>esc($this->request->getPost('jurusan'))
        ];
        $this->jurusanModel->insert($data);
        return redirect()->back()->with('sukses','Data jurusan berhasil ditambah');
    }
    
    public function update_jurusan($id) {
        $data = [
            'id'=>esc($this->request->getPost('id')),
            'jurusan'=>esc($this->request->getPost('jurusan'))
                ];
        $this->jurusanModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data jurusan berhasil diubah');
    }
    public function delete_jurusan($id) {
        $this->jurusanModel->delete($id);
        session()->setFlashdata('success','Data jurusan berhasil dihapus');
        return redirect()->to('/jurusan');
    }
}
