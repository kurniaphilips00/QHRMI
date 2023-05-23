<?php

namespace App\Controllers;
use App\Models\rhModel;
use App\Models\bhsModel;
use App\Controllers\BaseController;

class BahasaController extends BaseController
{
    protected $rhModel;
    protected $bhsModel;
    public function __construct()
    {
        $ta = $this->rhModel = new rhModel();    
        $bhs = $this->bhsModel = new bhsModel();   
    }
    public function index($FilterByName=null) {
  
            $ta = $this->rhModel->getCV();  
            $bhs = $this->bhsModel->getJoin();
            $data = [        
                'judul' => 'Data Bahasa',    
                'ta' => $ta, 
                'bhs' => $bhs
            ];
            return view ('bahasa/index', $data);   
    }
    public function FilterByName($nama) {
        return $this->index($nama);
    }
    
    public function tambah() {
        $taID = $this->rhModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
        $taName = $this->rhModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
        $bhs = $this->bhsModel->getBahasa();
        $data = [
            'judul' => 'Tambah Data Bahasa',
            'taID' => $taID,
            'taName' => $taName,
            'bhs' =>  $bhs,
            'validation' => \Config\Services::validation()
        ];
        return view('bahasa/tambah', $data);
    }
    public function simpan() {
        $rules = $this->validate([
            'kode_ta'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID tenaga ahli harus diisi.',
                ],
                'rules'  => 'numeric', 
                'errors' => [
                    'numeric' => 'ID Tenaga Ahli harus diisi angka.',
                ],
            ],
          
        ]);
        if (!$rules) {
            session()->setFlashdata('gagal-menambah-bahasa','Tambah data bahasa gagal !!!');
            return redirect()->back()->withInput();
        } 
        $this->bhsModel->save([  
                'kode_ta'=>esc($this->request->getPost('kode_ta')),   
                'nama_ta'=>esc($this->request->getPost('nama_TA')), 
                'nilai_bhs_indo'=>esc($this->request->getPost('nilai_bhs_indo')),
                'nilai_bhs_inggris'=>esc($this->request->getPost('nilai_bhs_inggris')),
                'nilai_bhs_setempat'=>esc($this->request->getPost('nilai_bhs_setempat')),                
        ]);
        return redirect()->to(base_url('/bahasa/tambah'))->with('sukses-tambah-bahasa', 'Bahasa berhasil disimpan');
    }
    public function edit($id) {
        $taID = $this->rhModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
        $taName = $this->rhModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
        $bhs = $this->bhsModel->getBahasa($id);
        $data = [
            'judul' => 'Edit Data Bahasa',
            'taID' => $taID,
            'taName' => $taName,
            'bahasa' =>  $bhs,
        ];
        return view('bahasa/edit', $data);
    }
    public function update($id) {
        $this->bhsModel->save([  
            'id_bahasa' => $id,
            'nilai_bhs_indo'=>esc($this->request->getPost('nilai_bhs_indo')),
            'nilai_bhs_inggris' =>esc($this->request->getPost('nilai_bhs_inggris')),
            'nilai_bhs_setempat' =>esc($this->request->getPost('nilai_bhs_setempat')) 
        ]);
        return redirect()->to(base_url('/bahasa'))->with('sukses-update-bahasa', 'Bahasa berhasil diupdate');
    }
    public function baca($id)
    {
        $bhs = $this->bhsModel->getBahasa($id);
        $data = [
            'judul' => 'Baca Data Bahasa',
            'bahasa' =>  $bhs];
        return view('bahasa/baca', $data);
    }
    public function  delete($id) {
       
        $this->bhsModel->delete($id);
        session()->setFlashdata('delete-success','Data bahasa berhasil dihapus');
        return redirect()->to('bahasa');
    }
}