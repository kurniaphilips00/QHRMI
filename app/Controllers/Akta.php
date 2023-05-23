<?php

namespace App\Controllers;
use App\Models\docModel;
use App\Controllers\BaseController;

class Akta extends BaseController
{
   
    protected $docModel; 
    public function __construct()
    {
        $doc = $this->docModel = new docModel();   
    }
    
    public function index() {
            $doc = $this->docModel->getDoc();
            $data = ['doc' => $doc, 'judul' => 'Dokumen PT. Quantum HRMI'];      
        return view ('akta/index', $data);
    }

    public function tambah() {
        
        $doc = $this->docModel->getDoc();
        $data = ['doc' => $doc, 'judul' => 'Tambah Data Akta'];
        return view('akta/tambah', $data);
    }
    public function simpan()    //  Menyimpan  data baru
    {
        $pdf = $this->request->getFile('namafile');
       // dd($pdf);
        if ($pdf->getError() === 4) {      //      Jika tidak ada file yang di-upload
            $namafilepdf = '';     //      Nama file gambar adalah 'orang.png'
        } else {
            $namafilepdf = $pdf->getName();//  Jika ada file yang di-upload, nama file diambil dari nama asli file yang di-upload
            $pdf->move(WRITEPATH . '../public/uploads', $namafilepdf);//   Pindah file ke direktori penyimpanan
          //  $tipefile = $pdf->getClientMimeType();
          //  $ukuran = $pdf->getSize();
          //  $lokasi = "public/uploads/".$namafilepdf;
        }
        $this->docModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'namafile' => $namafilepdf,
            'dokumen' => $this->request->getVar('dokumen'),  
            'nomor' => $this->request->getVar('nomor'),
            'notaris' => $this->request->getVar('notaris'),
            'tanggal' => $this->request->getVar('tanggal')
        ]);
        // Pasangannya di create.php..... <?php if (session('tambah'))
        session()->setFlashdata('AddSuccess', 'Dokumen berhasil ditambah');
        //   Kembali ke dashboard admin
        return redirect()->to('akta');
    }
    public function edit($id)
    {       
        $doc = $this->docModel->getDoc($id);
        $data = [                        
            'doc' => $doc,
            'judul' => 'Tambah Data Akta'
        ];    
        return view('akta/edit', $data);
    }
    public function update($id)
    {
        $this->docModel->save([  /////////UPDATE//////////////////////////////////
            'id' => $id,
            'dokumen' => $this->request->getVar('dokumen'),
        ]);
        session()->setFlashdata('EditSuccess', 'Data berhasil diupdate');
        return redirect()->to('akta');
    }

    public function delete_doc($id)
    {
        $this->docModel->delete($id); //
        session()->setFlashdata('DelSuccess', 'Data berhasil dihapus');
        return redirect()->to('akta');
    }
}