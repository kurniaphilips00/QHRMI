<?php

namespace App\Controllers\ijin;
use App\Models\ijinModel;
use App\Controllers\BaseController;

class IjinController extends BaseController
{
   
    protected $ijinModel; 
    public function __construct()
    {
        $ijin = $this->ijinModel = new ijinModel();   
    }
    public function index() {
            $ijin = $this->ijinModel->getIjin();
            $data = ['ijin' => $ijin, 'judul' => 'Surat ijin Usaha'];      
        return view ('/ijin/index', $data);
    }

    public function tambah_ijin() {
        
        $ijin = $this->ijinModel->getIjin();
        $data = ['ijin' => $ijin, 'judul' => 'Tambah Data Ijin Usaha'];
        return view('ijin/tambah', $data);
    }
    public function simpan_tambah_ijin()    //  Menyimpan  data baru
    {
        $pdf = $this->request->getFile('namafile');
       // dd($pdf);
        if ($pdf->getError() === 4) {      //      Jika tidak ada file yang di-upload
            $namafilepdf = '';     //      Nama file gambar adalah 'orang.png'
        } else {
            $namafilepdf = $pdf->getName();//  Jika ada file yang di-upload, nama file diambil dari nama asli file yang di-upload
            $pdf->move(WRITEPATH . '../public/uploads', $namafilepdf);//   Pindah file ke direktori penyimpanan
          
        }
        $this->ijinModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'namafile' => $namafilepdf,
            'jenis' => $this->request->getVar('jenis'),  
            'nomor' => $this->request->getVar('nomor'),
            'instansi' => $this->request->getVar('instansi'),
            'kualifikasi' => $this->request->getVar('kualifikasi'),
            'tglkadaluarsa' => $this->request->getVar('tglkadaluarsa')
        ]);
        // Pasangannya di create.php..... <?php if (session('tambah'))
       // session()->setFlashdata('AddSuccess', 'Dokumen berhasil ditambah');
        //   Kembali ke dashboard admin
        return redirect()->to(base_url('ijin'))->with('sukses-tambah', 'Data berhasil disimpan');
    }
    public function edit_ijin($id)
    {       
        $ijin = $this->ijinModel->getIjin($id);
        $data = [                        
            'ijin' => $ijin,
            'judul' => 'Tambah Data Ijin Usaha'
        ];    
        return view('ijin/edit', $data);
    }
    public function simpan_edit_ijin($id)
    {
        $this->ijinModel->save([  /////////UPDATE//////////////////////////////////
            'id' => $id,
            'jenis' => $this->request->getVar('jenis'),  
            'nomor' => $this->request->getVar('nomor'),
            'instansi' => $this->request->getVar('instansi'),
            'kualifikasi' => $this->request->getVar('kualifikasi'),
            'tglberlaku' => $this->request->getVar('tglberlaku')
        ]);
        return redirect()->to(base_url('ijin'))->with('sukses-edit', 'Data berhasil diupdate');
        
    }

    public function delete_ijin($id)
    {
        $this->ijinModel->delete($id); //
        //session()->setFlashdata('sukses-hapus', 'Data berhasil dihapus');
        return redirect()->to(base_url('ijin'))->with('sukses-hapus', 'Data berhasil dihapus');
        //return redirect()->to('/ijin/');
    }
}