<?php

namespace App\Controllers;

use App\Models\kategoriModel;
use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    protected $kategoriModel;
    public function __construct()
    {         
        $kategori = $this->kategoriModel = new kategoriModel();     
    }
    
    public function index()
    {
        $kategori = $this->kategoriModel->getKategori();
        $data = ['kategori' => $kategori, 'judul' => 'Data Kategori',];
      //  dd($data);
        return view ('/kategori/index', $data);
    }

    public function tambah() {
        $kategori = $this->kategoriModel->getKategori();
        $data = [
            'judul' => 'Tambah Data Kategori',
            'kategori' => $kategori, 
            'validation' => \Config\Services::validation()
        ];
        return view('kategori/tambah', $data);
    }
    public function simpan() {
        //dd($this->request->getPost('editor1'));
        $rules = $this->validate([
            'kategori'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi.',
                ],
            ],
        ]);
        if (!$rules) {
            session()->setFlashdata('gagal-menambah-kategori','Tambah data kategori gagal !!!');
            return redirect()->back()->withInput();
        } 
        $this->kategoriModel->save([  
                'kategori'=>esc($this->request->getPost('kategori')),   
                
        ]);
        return redirect()->to(base_url('/kategori/tambah'))->with('sukses-tambah-kategori', 'Kategori berhasil disimpan');
    }
    public function update($id) {
        $this->kategoriModel->save([  
            'id' => $id,
            'kategori'=>esc($this->request->getPost('kategori'))
        ]);
        return redirect()->to(base_url('/kategori'))->with('sukses-update-kategori', 'Kategori berhasil diupdate');
    }
    public function edit($id) {
        $kategori = $this->kategoriModel->getKategori($id);
        $data = [
            'judul' => 'Edit Data Kategori',
            'kategori' => $kategori
        ];
        return view('kategori/edit', $data);
    } 
    public function delete($id) {
       // dd($id);
        $this->kategoriModel->delete($id);
        session()->setFlashdata('del-success','Data kategori berhasil dihapus');
        return redirect()->to('/kategori');
    }
}
