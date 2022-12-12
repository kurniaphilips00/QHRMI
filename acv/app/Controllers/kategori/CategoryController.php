<?php

namespace App\Controllers\kategori;

use App\Models\kategoriModel;
use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    public function __construct()
    {         
        $kategori = $this->kategoriModel = new kategoriModel();     
    }
    
    public function index()
    {
        $kategori = $this->kategoriModel->getKategori();
        $data = ['kategori' => $kategori];
        return view ('/kategori/index', $data);
    }

    public function tambah_kategori() {
       
        $data = [
            'kategori'=>esc($this->request->getPost('kategori'))
        ];
        $this->kategoriModel->insert($data);
        return redirect()->back()->with('sukses','Data kategori berhasil ditambah');

    }
    public function update_kategori($id) {

        $data = [
            'id'=>esc($this->request->getPost('id')),
            'kategori'=>esc($this->request->getPost('kategori'))
                ];
        $this->kategoriModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data kategori berhasil diubah');
    }
    public function delete_kategori($id) {
       // dd($id);
        $this->kategoriModel->delete($id);
        session()->setFlashdata('success','Data kategori berhasil dihapus');
        return redirect()->to('/kategori');
    }
}
