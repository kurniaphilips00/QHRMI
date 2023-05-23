<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\tenderModel;

class Tender extends BaseController
{
    protected $tenderModel;

   public function __construct()
    {
        $tender = $this->tenderModel = new tenderModel();
    }
 
    public function index($instansi = null, $ThnAnggaran = null)
    {
        $data = [];

        if ($instansi != null) {
            $tender = $this->tenderModel->getFilteredTenderByInstansi();
           
            $data = ['tender' => $tender, 'judul' => 'Tender(Filter Instansi)'];
            if ($tender == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/tender/index', $data);
            }
        }
        if ($ThnAnggaran != null) {
            $tender = $this->tenderModel->getFilteredTenderByThnAnggaran();
            
            $data = ['tender' => $tender, 'judul' => 'Tender(Filter Tahun Anggaran)'];
            if ($tender == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/tender/index', $data);
            }
        }
       
        //  Tidak ada pemfilteran
        if ($ThnAnggaran == null && $instansi == null) {           
            $tender = $this->tenderModel->getTender();
            $data = ['tender' => $tender, 'judul' => 'Tender', 'validation' => \Config\Services::validation()];          
            return view('/tender/index', $data);   
        }
    }

    public function getFilteredTenderByThnAnggaran($ThnAnggaran)
    {
        return $this->index(null, $ThnAnggaran);
    }
    public function getFilteredTenderByInstansi($Instansi)
    {
        return $this->index($Instansi, null);
    }
    
    //  Menambah data dengan refresh
    public function tambah()
    {
        $tender = $this->tenderModel->getTender();
        $data = [
            'judul' => 'Tambah Data Tender',
            'tender' => $tender,
            'validation' => \Config\Services::validation()//Modal tidak bisa menampilkan validasi
        ];
        return view('tender/tambah', $data);
    }
    public function simpan()    //  Menyimpan  data baru
    {
        //dd($this->request->getVar('Instansi'));
        $rules = $this->validate([
            /*--------------------------------------Validasi teks---------------------------------*/
            'Kode' => ['rules'  => 'required','errors' => ['required' => 'Kode tender harus diisi.']],
            'Nama' => ['rules'  => 'required','errors' => ['required' => 'Nama tender harus diisi.']],
         
        ]);
        if (!$rules) {   
            session()->setFlashdata('add-failed', 'Tambah Data gagal !!!');
            return redirect()->back()->withInput();
        }
      /*  Kode, Nama, Kode_RUP, Paket_RUP, SumberDana_RUP, Tgl_Pembuatan, Tahap, Instansi, SatKer,
        JenisPengadaan, MetodePengadaan, TahunAnggaran, NilaiPagu, NilaiHPS, JenisKontrak, Lokasi,
        BobotTeknis, BobotBiaya*/
        $this->tenderModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'Kode' => $this->request->getVar('Kode'),
            'Nama' => $this->request->getVar('Nama'),
            'Instansi' => $this->request->getVar('Instansi'),
            'Kode_RUP' => $this->request->getVar('Kode_RUP'),
            'Paket_RUP' => $this->request->getVar('Paket_RUP'),
            'SumberDana_RUP' => $this->request->getVar('SumberDana_RUP'),
            'Tgl_Pembuatan' => $this->request->getVar('Tgl_Pembuatan'),
            'Tahap' => $this->request->getVar('Tahap'),
            'SatKer' => $this->request->getVar('SatKer'),
            'JenisPengadaan' => $this->request->getVar('JenisPengadaan'),
            'MetodePengadaan' => $this->request->getVar('MetodePengadaan'),
            'TahunAnggaran' => $this->request->getVar('TahunAnggaran'),
            'NilaiPagu' => $this->request->getVar('NilaiPagu'),
            'NilaiHPS' => $this->request->getVar('NilaiHPS'),
            'JenisKontrak' => $this->request->getVar('JenisKontrak'),
            'Lokasi' => $this->request->getVar('Lokasi'),
            'BobotTeknis' => $this->request->getVar('BobotTeknis'),
            'BobotBiaya' => $this->request->getVar('BobotBiaya'),
            'LPSE' => $this->request->getVar('LPSE'),
            'JadwalLPSE' => $this->request->getVar('JadwalLPSE')
        ]);
        // Pasangannya di create.php..... <?php if (session('tambah'))
        session()->setFlashdata('tambah', 'Data berhasil ditambah');
        return redirect()->to(base_url('tender/'))->with('sukses-tambah', 'Data berhasil ditambah');
       // return redirect()->to('/');
    }
  
    public function baca($id)
    {
        $tender = $this->tenderModel->getTender($id);
        $data = [
            'judul' => 'Baca Data Tender',
            'tender' => $tender];
        return view('tender/baca', $data);
    }
    public function edit($id)
    {
        $tender = $this->tenderModel->getTender($id);
       // dd($tender);
        $data = [
            'judul' => 'Edit Data Tender',
            'tender' => $tender,
        ];
        return view('tender/edit', $data);
    }
    public function update($id)
    {
        //dd($this->request->getVar('Tgl_Pembuatan'));
        $this->tenderModel->save([  /////////UPDATE//////////////////////////////////
            'id' => $id,
          //  'Kode' => $this->request->getVar('Kode'), >>>>>>>>>>>     Ini tidak boleh diubah
          //  'Nama' => $this->request->getVar('Nama'), >>>>>>>>>>>     Ini tidak boleh diubah
            'Kode_RUP' => $this->request->getVar('Kode_RUP'),
            'Paket_RUP' => $this->request->getVar('Paket_RUP'),
            'SumberDana_RUP' => $this->request->getVar('SumberDana_RUP'),
            
            'Tgl_Pembuatan' => $this->request->getVar('Tgl_Pembuatan'),
            'Tahap' => $this->request->getVar('Tahap'),
            'Instansi' => $this->request->getVar('Instansi'), 
            'SatKer' => $this->request->getVar('SatKer'),
            'JenisPengadaan' => $this->request->getVar('JenisPengadaan'),
            'MetodePengadaan' => $this->request->getVar('MetodePengadaan'),
            'TahunAnggaran' => $this->request->getVar('TahunAnggaran'),
            'NilaiPagu' => $this->request->getVar('NilaiPagu'),
            'NilaiHPS' => $this->request->getVar('NilaiHPS'),
            'JenisKontrak' => $this->request->getVar('JenisKontrak'),
            'Lokasi' => $this->request->getVar('Lokasi'),
            'BobotTeknis' => $this->request->getVar('BobotTeknis'),
            'BobotBiaya' => $this->request->getVar('BobotBiaya'),
            'LPSE' => $this->request->getVar('LPSE'),
            'JadwalLPSE' => $this->request->getVar('JadwalLPSE')

        ]);
        return redirect()->to(base_url('tender/'))->with('sukses-edit', 'Data berhasil diupdate');
        //session()->setFlashdata('berhasilUpdate', 'Data berhasil diupdate');
        //return redirect()->to('/');
    }

    public function delete($id)
    {
        $v = $this->tenderModel->getTender($id);
     
        $this->tenderModel->delete($id); //
       
        session()->setFlashdata('sukses-hapus', 'Data berhasil dihapus');
        return redirect()->to(base_url('tender/'))->with('sukses-hapus', 'Data berhasil dihapus');
    }
}
