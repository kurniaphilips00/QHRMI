<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\rhModel;
use App\Models\posisiModel;
use App\Models\kategoriModel;
use App\Models\jurusanModel;
use App\Models\proyekTAModel;
use App\Models\bhsModel;
use App\Models\sertModel;

use Dompdf\Dompdf;

class TA extends BaseController
{
    protected $rhModel;
    protected $posisiModel;
    protected $kategoriModel;
    protected $jurusanModel;
    protected $proyekTAModel;
    protected $bhsModel;
    protected $sertModel;
    protected $base;

   public function __construct()
    {
        $rh = $this->rhModel = new rhModel();
        $posisi = $this->posisiModel = new posisiModel();
        $kategori = $this->kategoriModel = new kategoriModel();
        $bhs = $this->bhsModel = new bhsModel();
        $sertifikat = $this->sertModel = new sertModel();
        $proyekTAModel = $this->proyekTAModel = new proyekTAModel();
        $jurusanModel = $this->jurusanModel = new jurusanModel();
       // helper(['url']);
    }
    
    public function index($S1 = null, $S2 = null, $S3 = null, 
    $pos = null, $usia1 = null, $OrderBySIPPED = null)
    {
        $data = [];

        if ((int)$OrderBySIPPED == 1) {
            $cv = $this->rhModel->getOrderBySIPP_ED();
            $posisi = $this->posisiModel->getPosisi();
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli(filtered)'];
            if ($cv == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }
        if ($usia1 != null) {
            $usia1 = (int)$usia1;
            $usia2 = $usia1 + 10;
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterUsia($usia1, $usia2);
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli(filtered)'];
            if ($cv == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }

        if ($pos != null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterPosisi($pos);
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli(filtered)'];
            if ($cv == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }
        if ($S1 != null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterPendidikanS1($S1);
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli (filtered)'];
            if ($cv == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }
        if ($S2 != null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterPendidikanS2($S2);
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli(filtered)'];
            if ($cv == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }
        if ($S3 != null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterPendidikanS3($S3);
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli(filtered)'];
            if ($cv == "") {                  
                    echo '<script type="text/javascript">';
                    echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                    echo '</script>';
            } else {
                return view('ta/index', $data);
            }
        }
        //  Tidak ada pemfilteran
        if ($S1 == null && $S2 == null && $S3 == null && $pos == null && $usia1 == null && $OrderBySIPPED == null) {           
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getCVwithKode();
            //$ckval = array();
            $data = ['cv' => $cv, 'posisi' => $posisi, 'judul' => 'Tenaga Ahli'];          
            return view('ta/index', $data);   
        }
    }

    public function sarjana($S1)
    {
        return $this->index($S1, null, null, null, null, null);
    }
    public function master($S2)
    {
        return $this->index(null, $S2, null, null, null, null);
    }
    public function doktor($S3)
    {
        return $this->index(null, null, $S3, null, null, null);
    }
  
    public function usia($umur)
    {
        return $this->index(null, null, null, null, $umur, null);
    }
    public function posisi($p)
    {
        return $this->index(null, null, null, $p, null, null);
    }
    //  Menambah data dengan refresh
    public function tambah()
    {
        helper('custom_helper'); // Loading single helper
        //$kode = hitungKode('tb_ta');
        
        //dd($kode);
        /////////////////
        $cv = $this->rhModel->getTAOrderByKode();
       // dd(check($cv));
        if (check($cv) == null) {
            $kode = hitungKode('tb_ta');
        }
        else {
            $kode = check($cv);
        }
        
        //dd($kode);
       // $jurusan = $this->jurusanModel->getJurusan();
        $posisi = $this->posisiModel->getPosisi();
        $kategori = $this->kategoriModel->getKategori();
        $data = [
            'judul' => 'Tambah Data Tenaga Ahli',
            'posisi' => $posisi,
            'kategori' => $kategori,
            'kode' => $kode,
            'validation' => \Config\Services::validation()
        ];
        return view('ta/add', $data);
    }
    public function simpan()    //  Menyimpan  data baru
    {
      
        $npwp = $this->request->getVar('no_npwp1') ."." . $this->request->getVar('no_npwp2') . "." . $this->request->getVar('no_npwp3') . "-" . $this->request->getVar('no_npwp4') . "." . $this->request->getVar('no_npwp5') . "." . $this->request->getVar('no_npwp6');

        $rules = $this->validate([
            /*--------------------------------------Validasi teks---------------------------------*/
            'nama' => ['rules'  => 'required','errors' => ['required' => 'Nama harus diisi.']],
            //'perusahaan' => ['rules'  => 'required','errors' => ['required' => 'Perusahaan harus diisi.']]
        ]);
        if (!$rules) {    
            session()->setFlashdata('add-failed', 'Tambah Data gagal !!!');
            return redirect()->back()->withInput();
        }
        $ref = $this->request->getFile('ref');
        if ($ref->getError() === 4) {      //      Jika tidak ada file yang di-upload
            $fileref = '';     //      
        } else {
            if ($ref->getExtension() != 'pdf') {
                session()->setFlashdata('bukan-pdf', 'File referensi yang di-upload bukan file pdf !!!');
                return redirect()->back()->withInput();
            }
            else {
                $fileref = $ref->getName();
                $ref->move(WRITEPATH . '../public/uploads/', $fileref);
            }
        }
    
        $this->rhModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'kode_ta' => $this->request->getVar('kode_ta'),
            'posisi' => $this->request->getVar('posisi'),
            'perusahaan' => $this->request->getVar('perusahaan'),
            'nama' => $this->request->getVar('nama'),
            'kategori' => $this->request->getVar('kategori'),
            'alamat' => $this->request->getVar('alamat'),
            'kota' => $this->request->getVar('kota'),
            'tgl' => $this->request->getVar('tgl_lahir'),
            'usia' => $this->request->getVar('usia'),
            'no_npwp' => $npwp,
            'no_telp' => $this->request->getVar('no_telp'),
            'no_hp' => $this->request->getVar('no_hp'),
            'no_ktp' => $this->request->getVar('no_ktp'),
            'ijazahS1' => $this->request->getVar('ijazahS1'),
            's1_univ' => $this->request->getVar('s1_univ'),
            's1_thn' => $this->request->getVar('s1_thn'),
            'ijazahS2' => $this->request->getVar('ijazahS2'),
            's2_univ' => $this->request->getVar('s2_univ'),
            's2_thn' => $this->request->getVar('s2_thn'),
            'ijazahS3' => $this->request->getVar('ijazahS3'),
            's3_univ' => $this->request->getVar('s3_univ'),
            's3_thn' => $this->request->getVar('s3_thn'),
            'sipp' => $this->request->getVar('sipp'),
            'sipp_ed' => $this->request->getVar('sipp_ed'),
            'str' => $this->request->getVar('str'),
            'str_ed' => $this->request->getVar('str_ed'),
            'kta' => $this->request->getVar('kta'),
            'kta_ed' => $this->request->getVar('kta_ed'),
            'asosiasi' => $this->request->getVar('asosiasi'),
            'email' => $this->request->getVar('email'),
            'status' => $this->request->getVar('status'),
            'ref' => $fileref,
        ]);
        return redirect()->to(base_url('ta/tambah'))->with('add-success', 'Data berhasil ditambah');
       
    }
    public function baca($kode)
    {
        $jurusan = $this->jurusanModel->getJurusan();
        $posisi = $this->posisiModel->getPosisi();
        $kategori = $this->kategoriModel->getKategori();
        $data = [
            'judul' => 'Baca Data Tenaga Ahli',
            'result' => $this->rhModel->getCVwithKode($kode),
            'posisi' => $posisi,
            'jurusan' => $jurusan,
            'kategori' => $kategori,
            'validation' => \Config\Services::validation()
        ];
        return view('ta/read', $data);
    }

    public function edit($id)
    {
        $jurusan = $this->jurusanModel->getJurusan();
        $posisi = $this->posisiModel->getPosisi();
        $kategori = $this->kategoriModel->getKategori();
        $data = [
            'judul' => 'Edit Tenaga Ahli',
            'result' => $this->rhModel->getCV($id),
            'posisi' => $posisi,
            'jurusan' => $jurusan,
            'kategori' => $kategori,
            'validation' => \Config\Services::validation()
        ];
        return view('ta/edit', $data);
    }
    public function update($id)
    {
       // dd($this->request->getPost('pdfREFLama'));
        $ref = $this->request->getFile('ref');
        if ($ref->getError() === 4) {      //      Jika tidak ada file yang di-upload
            if ($this->request->getVar('oldref') != "") // jika ada file lama
                $fileref = $this->request->getVar('oldref'); 
            else {  // jika tidak ada file lama
                $fileref = ''; 
            }
                //      Nama file gambar adalah 'orang.png'
        } else {
            //  Hapus file lama
            if ($this->request->getPost('pdfREFLama') != "") {
                  unlink('uploads/'.$this->request->getPost('pdfREFLama'));
                //  unlink('public/uploads/' . $this->request->getPost('pdfREFLama'));
              }
            $fileref = $ref->getName();
            $ref->move(WRITEPATH . '../public/uploads/', $fileref);
        }
        /*-----------------------------------End of File referensi pdf--------------------------*/       
        /////////////////////////     File pdf end   ///////////////////////////////////////////////
        $this->rhModel->save([  /////////UPDATE//////////////////////////////////
            'id' => $id,
            'posisi' => $this->request->getVar('posisi'),
            'perusahaan' => $this->request->getVar('perusahaan'),
            'kategori' => $this->request->getVar('kategori'),
            'alamat' => $this->request->getVar('alamat'),
            'kota' => $this->request->getVar('kota'),
            'tgl' => $this->request->getVar('tgl'),
            'usia' => $this->request->getVar('usia'),
            'no_npwp' => $this->request->getVar('no_npwp'),
            'no_telp' => $this->request->getVar('no_telp'),
            'no_hp' => $this->request->getVar('no_hp'),
            'no_ktp' => $this->request->getVar('no_ktp'),
            'ijazahS1' => $this->request->getVar('ijazahS1'),
            's1_univ' => $this->request->getVar('s1_univ'),
            's1_thn' => $this->request->getVar('s1_thn'),
            'ijazahS2' => $this->request->getVar('ijazahS2'),
            's2_univ' => $this->request->getVar('s2_univ'),
            's2_thn' => $this->request->getVar('s2_thn'),
            'ijazahS3' => $this->request->getVar('ijazahS3'),
            's3_univ' => $this->request->getVar('s3_univ'),
            's3_thn' => $this->request->getVar('s3_thn'),
            'sipp' => $this->request->getVar('sipp'),
            'sipp_ed' => $this->request->getVar('sipp_ed'),
            'str' => $this->request->getVar('str'),
            'str_ed' => $this->request->getVar('str_ed'),
            'kta' => $this->request->getVar('kta'),
            'kta_ed' => $this->request->getVar('kta_ed'),
            'asosiasi' => $this->request->getVar('asosiasi'),
            'email' => $this->request->getVar('email'),
            'status' => $this->request->getVar('status'),
            'ref' => $fileref
        ]);
        return redirect()->to(base_url('/ta'))->with('sukses-edit', 'Data berhasil diupdate');
      
    }

    
    public function delete($id)
    {
        
        $v = $this->rhModel->getCV($id);
        //  Hapus file ref lama
        $ref_lama = isset($v['ref']) ? $v['ref'] : '';
        //  Jika nama file masih ada.....
        if ($ref_lama != '' ) {
            //  Jika file fisiknya masih ada > hapus !!!
            if (file_exists('uploads/'.$ref_lama))
            unlink('uploads/'.$ref_lama);
        }
        $this->rhModel->delete($id); //
        
        return redirect()->to(base_url('/ta'))->with('sukses-hapus', 'Data berhasil dihapus');
    }

    public function help()
    {
        return view('/ta/help');
    }
   

    public function exportpdf() {
        $result = $this->rhModel->getCV();
        $data = ['result'=>$result];
        $view = view('ta/pdf_report',$data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Daftar Tenaga Ahli', array("Attachment" => false));
    }
//  Hanya bisa untuk halaman 1 (pertama), halaman kedua dst. tidak bisa ????????
    public function hapus_semua() {
       // dd(isset($_POST['dell_all']));
        //  Tombol hapus semua diklik

        if (isset($_POST['dell_all']) == true) {
           
            //dd(isset($_POST['ckval']));
           // dd($this->request->getPost('ckval'));
            
            if (!empty($this->request->getPost('ckval'))) {
            //dd($this->request->getPost('ckval'));
                $check = $this->request->getPost('ckval');
              //  dd($this->request->getPost('ckval'));
               foreach($check as $brs) {
                    $this->rhModel->delete($brs);
               }
               return redirect()->to(base_url('/ta'))->with('sukses-hapus-semua', 'Data berhasil dihapus');
            }
            else {
                echo '<script type="text/javascript">';
                echo 'alert("Pilih minimal satu kotak check box")';  //not showing an alert box.
                echo '</script>';
                return redirect()->to(base_url('/ta'))->with('gagal-hapus-semua', 'Gagal hapus,...pilih minimal satu kotak check box');
            }
            
        }
    }

}
