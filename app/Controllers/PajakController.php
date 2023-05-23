<?php

namespace App\Controllers\pajak;
use App\Models\pajakModel;
use App\Controllers\BaseController;

class PajakController extends BaseController
{
   
    protected $pajakModel; 
    public function __construct()
    {
        $pajak = $this->pajakModel = new pajakModel();   
    }
    public function index() {
            $pajak = $this->pajakModel->getPajak();
            $data = ['pajak' => $pajak, 'judul' => 'Data pajak PT. Quantum HRMI'];      
        return view ('/pajak/index', $data);
    }
    public function tambah_pajak() {
        $pajak = $this->pajakModel->getPajak();
        $data = ['pajak' => $pajak, 'judul' => 'Tambah Data Pajak'];
        return view('pajak/tambah', $data);
    }
    public function simpan_tambah_pajak()    //  Menyimpan  data baru
    {
        $pdf = $this->request->getFile('namafile');
       // dd($pdf);
        if ($pdf->getError() === 4) {      //      Jika tidak ada file yang di-upload
            $namafilepdf = '';     //      Nama file gambar adalah 'orang.png'
        } else {
            $namafilepdf = $pdf->getName();//  Jika ada file yang di-upload, nama file diambil dari nama asli file yang di-upload
            $pdf->move(WRITEPATH . '../public/uploads', $namafilepdf);//   Pindah file ke direktori penyimpanan
 
        }
        $this->pajakModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'namafile' => $namafilepdf,
            'jenis' => $this->request->getVar('jenis'),  
            'nomor' => $this->request->getVar('nomor'),
            'tglterbit' => $this->request->getVar('tglterbit')
        ]);
        // Pasangannya di create.php..... <?php if (session('tambah'))
    //    session()->setFlashdata('AddSuccess', 'Dokumen berhasil ditambah');
        //   Kembali ke dashboard admin
     //   return redirect()->to('/pajak/');
        return redirect()->to(base_url('pajak'))->with('sukses-tambah', 'Data berhasil ditambah');
    }
    public function edit_pajak($id)
    {       
        $pajak = $this->pajakModel->getPajak($id);
        $data = [                        
            'pajak' => $pajak,
            'judul' => 'Edit Data Pajak'
        ];    
        return view('pajak/edit', $data);
    }
    public function simpan_edit_pajak($id)
    {
        $this->pajakModel->save([  /////////UPDATE//////////////////////////////////
            'id' => $id,
            'jenis' => $this->request->getVar('jenis'),  
            'nomor' => $this->request->getVar('nomor'),
            'tglterbit' => $this->request->getVar('tglterbit')
        ]);
        //session()->setFlashdata('EditSuccess', 'Data berhasil diupdate');
        //return redirect()->to('/pajak/');
        return redirect()->to(base_url('pajak'))->with('sukses-update', 'Data berhasil diupdate');
    }

    public function delete_pajak($id)
    {
        $this->pajakModel->delete($id); //
        //session()->setFlashdata('DelSuccess', 'Data berhasil dihapus');
        //return redirect()->to('/pajak/');
        return redirect()->to(base_url('pajak'))->with('sukses-hapus', 'Data berhasil dihapus');
    }
}