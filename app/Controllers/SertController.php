<?php

namespace App\Controllers;
use App\Models\rhModel;
use App\Models\sertModel;
use App\Controllers\BaseController;


class SertController extends BaseController
{
    protected $taModel;
    protected $sertModel;
    
    public function __construct()
    {
         //  ta diperlukan untuk menampilkan nama pada drop down pilihan nama tenaga ahli (index & modal tambah)
        $ta = $this->taModel = new rhModel();   
        $sertifikat = $this->sertModel = new sertModel(); 
    }
    public function index($FilterByName=null) {
        if ($FilterByName!=null) {    
            $ta = $this->taModel->getCV();
            $sertifikat = $this->sertModel->getFilterByName($FilterByName);
            $data = [ 'judul' => 'Data Sertifikat Tenaga Ahli', 'ta' => $ta, 'sertifikat' => $sertifikat ]; 
            return view('sertifikat/index', $data);
        } 
        else {
            $ta = $this->taModel->getCV();
            $sertifikat = $this->sertModel->getSertifikat(); 
            $data = [  
                'judul' => 'Data Sertifikat Tenaga Ahli', 
                'ta' => $ta,    
                'sertifikat' =>  $sertifikat
            ];
            return view ('sertifikat/index', $data);
        }
    }
    public function FilterByName($nama) {
        return $this->index($nama);
    }
    public function tambah() {
        $taID = $this->taModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
        $taName = $this->taModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
        $sertifikat = $this->sertModel->getSertifikat(); 
        $data = [
            'judul' => 'Tambah Data Sertifikat',
            'taID' => $taID,
            'taName' => $taName,
            'sertifikat' =>  $sertifikat,
            'validation' => \Config\Services::validation()
        ];
        return view('sertifikat/tambah', $data);
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
            'sertifikat'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Sertifikat harus diisi.',
                ],
            ]
        ]);
        if (!$rules) {
            session()->setFlashdata('gagal-menambah-sertifikat','Tambah data sertifikat gagal !!!');
            return redirect()->back()->withInput();
        } 
        $this->sertModel->save([  
                'kode_ta'=>esc($this->request->getPost('kode_ta')),   
                'nama_ta'=>esc($this->request->getPost('nama_TA')), 
                'sertifikat'=>esc($this->request->getPost('sertifikat')),
                'tgl_kadaluarsa' =>esc($this->request->getPost('tgl_kadaluarsa')) 
        ]);
        return redirect()->to(base_url('/sertifikat/tambah'))->with('sukses-tambah-srt', 'Sertifikat berhasil disimpan');
        
    }

    public function edit($id) {
        $taID = $this->taModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
        $taName = $this->taModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
        $sertifikat = $this->sertModel->getSertifikat($id); 
        $data = [
            'judul' => 'Edit Data Sertifikat',
            'taID' => $taID,
            'taName' => $taName,
            'sertifikat' =>  $sertifikat,
            'validation' => \Config\Services::validation()
        ];
        return view('sertifikat/edit', $data);
    }
    public function update($id) {
       // dd($this->request->getVar('nomor_sert'));
        $this->sertModel->save([  
            'id_sert' => $id,
            'sertifikat'=>esc($this->request->getVar('sertifikat')),
            'nomor_sert'=>esc($this->request->getVar('nomor_sert')),
            'tgl_kadaluarsa' =>esc($this->request->getVar('tgl_kadaluarsa')) 
        ]);
        return redirect()->to(base_url('/sertifikat'))->with('sukses-update-srt', 'Sertifikat berhasil diupdate');
    }
    public function delete($id) {
       // dd($id);
        $this->sertModel->delete($id);
        session()->setFlashdata('del','Sertifikat berhasil dihapus');
        return redirect()->to('/sertifikat');
    }
    public function baca($id)
    {
        $sertifikat = $this->sertModel->getSertifikat(($id));
        $data = [
            'judul' => 'Baca Data Sertifikat',
            'sertifikat' =>  $sertifikat];
        return view('sertifikat/baca', $data);
    }
}