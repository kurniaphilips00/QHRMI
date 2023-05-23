<?php

namespace App\Controllers;
use App\Models\rhModel;
use App\Controllers\BaseController;
use App\Models\posisiModel;
use App\Models\proyekModel;
use App\Models\proyekTAModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pengalaman extends BaseController
{
    protected $rhModel;
    protected $posisiModel;
    protected $proyekModel;
    protected $proyekTAModel;
    protected $base;
    public function __construct()
    {
       
        $rh = $this->rhModel = new rhModel();    
        $posisi = $this->posisiModel = new posisiModel();  
        //      Pengalaman diambilkan dari tabel proyek
        $proyek = $this->proyekModel = new proyekModel();
        $proyekTA = $this->proyekTAModel = new proyekTAModel();
    }

    public function index($FilterByName=null)
    {
        if ($FilterByName != null) {
            $proyek = $this->proyekModel->getProyekFilteredByName($FilterByName);
            $rh = $this->rhModel->getCV();
            $data = [           
                'judul' => 'Daftar Pengalaman',
                'rh' => $rh,
                'exp' => $proyek    //      Pengalaman diambilkan dari tabel proyek
            ];
            return view('/exp/index', $data);
        }
        
        else    {
            $proyek = $this->proyekModel->getProyek();
           
            $rh = $this->rhModel->getCV();
            $data = [           
                'judul' => 'Daftar Pengalaman',
                'rh' => $rh,
                'exp' => $proyek    //      Pengalaman diambilkan dari tabel proyek
            ];
           // dd($data);
            return view('/exp/index', $data);
        }
    }

    public function FilterByName($n)
    {
        return $this->index($n);
    }
    
      ///////////Tambah data pengalaman//////////////////////////
    public function tambah_exp()
      {       
        helper('custom_helper'); // Loading single helper
     
        $proyek = $this->proyekModel->getProyekOrderByKode();
        if (checkSkip($proyek,'tb_proyek') == null) {
          $kode = hitungKode('tb_proyek');
        }
        else {
            $kode = checkSkip($proyek, 'tb_proyek');
        }

        $posisi = $this->posisiModel->getPosisi();
        //  $ta = $this->rhModel->getCV();// Untuk memilih nama dan mengambil id Tenaga Ahli
        //  $exp = $this->proyekModel->getExp();  
          
          $data = [ 
              'judul' => 'Tambah Data Pengalaman',   
            // 'ta' => $ta, // Untuk memilih nama dan mengambil id dari Tenaga Ahli
              'posisi' => $posisi, 
              'proyek' => $proyek,  //  Pengalaman diambilkan dari tabel proyek
              'kode' => $kode,
              'validation' => \Config\Services::validation()
          ];  
          return view('exp/tambah_exp', $data);
    }
      
      ///////////  Menyimpan hasil tambah pengalaman/////////////////////////
    public function simpan_exp()
      {           
//dd($this->request->getVar('tahun'));
        $rules = $this->validate([
            'tahun'         => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tahun harus diisi.',
                ],
                'rules'  => 'numeric', 
                'errors' => [
                    'numeric' => 'Tahun harus diisi angka.',
                ],
            ],
            'instansi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Instansi harus diisi.',
                ],
            ],
            'pekerjaan'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pekerjaan harus diisi.',
                ],
            ]
        ]);
        if (!$rules) 
           {    //--pasangannya di tambah_exp.php 
            session()->setFlashdata('gagal-menambah-pengalaman','Tambah data pengalaman gagal !!!');
            return redirect()->back()->withInput();
          } 
 
          $ref = $this->request->getFile('refpdf');
        //  dd($ref);
          if ($ref->getError() === 4) {      //      Jika tidak ada file yang di-upload
            $fileref = '';//$this->request->getVar('oldpdf');    //      
          } else {
              $fileref = $ref->getName();
              $ref->move(WRITEPATH . '../public/uploads/', $fileref);
          }

          $this->proyekModel->save([
          
            // id_exp tidak perlu disimpan karena autoincrement, otomatis di-update,
            'kode_proyek' => $this->request->getVar('kode_proyek'),
            'tahun' => $this->request->getVar('tahun'), 
              'pekerjaan' => $this->request->getVar('pekerjaan'),
              'lokasi' => $this->request->getVar('lokasi'),
              'instansi' => $this->request->getVar('instansi'),
              'alamat' => $this->request->getVar('alamat'),
              'nokontrak' => $this->request->getVar('nokontrak'),
              
              'nilai' => $this->request->getVar('nilai'),
              'referensi' => $this->request->getVar('referensi'),             
              'refpdf' => $fileref,
              'mulai' => $this->request->getVar('mulai'),
              'selesai' => $this->request->getVar('selesai'),
              'jml_bln' => $this->request->getVar('jml_bln'),
              'inter' => $this->request->getVar('inter')
          ]);    
          //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
       //   session()->setFlashdata('sukses-tambah-pengalaman','Data pengalaman berhasil ditambah'); 
        // return redirect()->to('pengalaman');
         return redirect()->to(base_url('pengalaman/tambah'))->with('sukses-tambah-pengalaman', 'Data berhasil disimpan');
      }
      /*Menambah tenaga ahli untuk satu pengalaman*/
    public function tambahTA()
    {       
      $posisi = $this->posisiModel->getPosisi();
      $proyekID = $this->proyekModel->getProyekOrderByID();// Untuk memilih pengalaman urut berdasarkan ID
      $proyekName = $this->proyekModel->getProyekOrderByProyek();// Untuk memilih pengalaman urut berdasarkan nama
      $proyekTA = $this->proyekTAModel->getTAProyek();
      $taID = $this->rhModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
      $taName = $this->rhModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
      $data = [ 
          'judul' => 'Tambah Tenaga Ahli',   
          'taID' => $taID, // Untuk memilih nama dan mengambil id dari Tenaga Ahli
          'taName' => $taName,
          'proyekID' => $proyekID,  //  Pengalaman diambilkan dari tabel proyek
          'proyekName' => $proyekName,
          'proyekTA' => $proyekTA,
          'posisi' => $posisi,
          'validation' => \Config\Services::validation()
        ];  
        return view('exp/tambahTA0', $data);
    }
      
    public function simpanTA1()
      { 
        // $id contains the id of the model or data 
        //$id = $this->proyekTAModel->getId();
        
        // $nama contains the name of the model or data 
       // $nama = $this->proyekTAModel->getNama();
        
        // $check contains the boolean value that check if the input has passed validation
       // $check = $this->validation->run($_POST);
        
       
        $id = $this->request->getVar('id');
        dd($id);
        //$nama = $this->request->getVar('nama');
        //$check = $this->request->getVar('check');
      }
      ///////////  Menyimpan hasil tambah pengalaman/////////////////////////
    public function simpanTA()
      {           
        $rules = $this->validate([
            'id_exp'         => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Pekerjaan harus diisi.',
                ],
                'rules'  => 'numeric', 
                'errors' => [
                    'numeric' => 'ID Pekerjaan harus diisi angka.',
                ],
            ],
            'id_TA'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Tenaga Ahli harus diisi.',
                ],
                'rules'  => 'numeric', 
                'errors' => [
                    'numeric' => 'ID Tenaga Ahli harus diisi angka.',
                ],
            ],
        ]);
      if (!$rules) 
       {    //--pasangannya di tambah_exp.php 
        session()->setFlashdata('gagal-menambah-ta','Tambah tenaga ahli gagal !!!');
        return redirect()->back()->withInput();
      } 

      $this->proyekTAModel->save([
      
        // id tidak perlu disimpan karena autoincrement, otomatis di-update, 
          'id_exp' => $this->request->getVar('id_exp'), 
          'nama_pekerjaan' => $this->request->getVar('nama_pekerjaan'),
          'id_TA' => $this->request->getVar('id_TA'),
          'nama_TA' => $this->request->getVar('nama_TA'),
          'perusahaan' => $this->request->getVar('perusahaan'),
          'posisitugas' => $this->request->getVar('posisi'),
          'statuskepegawaian' => $this->request->getVar('statuskepegawaian'),
          'uraian' => $this->request->getVar('editor')
      ]);    
     
         return redirect()->to(base_url('/pengalaman/tambahTA'))->with('sukses-tambah-ta', 'Data berhasil disimpan');
      }

    /*Menambah pengalaman untuk satu tebaga ahli*/
    public function tambahPengalaman()
    {       

      $posisi = $this->posisiModel->getPosisi();
      $proyekID = $this->proyekModel->getProyekOrderByID();// Untuk memilih pengalaman urut berdasarkan ID
      $proyekName = $this->proyekModel->getProyekOrderByProyek();// Untuk memilih pengalaman urut berdasarkan nama
      $proyekTA = $this->proyekTAModel->getTAProyek();
      $taID = $this->rhModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
      $taName = $this->rhModel->getTAOrderByName();// Untuk memilih Tenaga Ahli urut berdasarkan nama
      $data = [ 
          'judul' => 'Tambah Pengalaman Tenaga Ahli',   
          'taID' => $taID, // Untuk memilih nama dan mengambil id dari Tenaga Ahli
          'taName' => $taName,
          'proyekID' => $proyekID,  //  Pengalaman diambilkan dari tabel proyek
          'proyekName' => $proyekName,
          'proyekTA' => $proyekTA,
          'posisi' => $posisi,
          'validation' => \Config\Services::validation()
      ];  

    
          return view('exp/tambahPengalaman0', $data);
    }
              
    public function simpanPengalaman()
    {           
      $rules = $this->validate([
          'id_exp'         => [
              'rules'  => 'required',
              'errors' => [
                  'required' => 'ID Pekerjaan harus diisi.',
              ],
              'rules'  => 'numeric', 
              'errors' => [
                  'numeric' => 'ID Pekerjaan harus diisi angka.',
              ],
          ],
          'id_TA'    => [
              'rules'  => 'required',
              'errors' => [
                  'required' => 'ID Tenaga Ahli harus diisi.',
              ],
              'rules'  => 'numeric', 
              'errors' => [
                  'numeric' => 'ID Tenaga Ahli harus diisi angka.',
              ],
          ],
       
      ]);
      if (!$rules) 
         {    //--pasangannya di tambah_exp.php 
          session()->setFlashdata('gagal-menambah-pengalaman','Tambah pengalaman gagal !!!');
          return redirect()->back()->withInput();
        } 

        $this->proyekTAModel->save([
        
          // id tidak perlu disimpan karena autoincrement, otomatis di-update, 
            'id_exp' => $this->request->getVar('id_exp'), 
            'nama_pekerjaan' => $this->request->getVar('nama_pekerjaan'),
            'id_TA' => $this->request->getVar('id_TA'),
            'nama_TA' => $this->request->getVar('nama_TA'),
            'perusahaan' => $this->request->getVar('perusahaan'),
            'posisitugas' => $this->request->getVar('posisi'),
            'statuskepegawaian' => $this->request->getVar('statuskepegawaian'),
            'uraian' => $this->request->getVar('editor')
        ]);    
        //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
     //   session()->setFlashdata('sukses-tambah-pengalaman','Data pengalaman berhasil ditambah'); 
      // return redirect()->to('pengalaman');
       return redirect()->to(base_url('/pengalaman/tambahPengalaman'))->with('sukses-tambah', 'Data berhasil disimpan');
    }

  
    public function edit_exp($id)
    {   
        
        $posisi = $this->posisiModel->getPosisi();
        $proyek = $this->proyekModel->getProyek($id);  //  Pengalaman diambilkan dari tabel proyek
        $ta = $this->rhModel->getCV();// Untuk memilih nama dan mengambil id Tenaga Ahli
        $data = [        
            'ta' => $ta,
            'judul' => 'Edit Data Pengalaman', 
            'proyek' => $proyek,   //  Pengalaman diambilkan dari tabel proyek
            'posisi' => $posisi,
            'validation' => \Config\Services::validation()
        ];
       // dd($proyek);
       return view('exp/edit_exp', $data);
    }

    public function update_exp($id)
    { 
        $ref = $this->request->getFile('refpdf');
    //    dd($ref);
        if ($ref->getError() === 4) {      //      Jika tidak ada file yang di-upload
           
            $fileref = $this->request->getVar('oldpdf');     //      Nama file gambar adalah 'orang.png'
           // dd($fileref);
        } else {
            if ($this->request->getPost('pdfREFLama') != "") {
                  unlink('uploads/'.$this->request->getPost('pdfREFLama'));
                //  unlink('public/uploads/' . $this->request->getPost('pdfREFLama'));
              }
            $fileref = $ref->getName();
            $ref->move(WRITEPATH . '../public/uploads/', $fileref);
        }
        //dd($fileref);
        $this->proyekModel->save([
            'id'=>$id,  // Jika memakai id berarti diasumsikan update, kode_ta dan nama_ta tidak boleh diedit karena merupakan penghubung ke TA
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'tahun' => $this->request->getVar('tahun'),
            'lokasi' => $this->request->getVar('lokasi'),
            'instansi' => $this->request->getVar('instansi'),
            'alamat' => $this->request->getVar('alamat'),
            'nokontrak' => $this->request->getVar('nokontrak'),
           
            'nilai' => $this->request->getVar('nilai'),
            'referensi' => $this->request->getVar('referensi'),             
            'refpdf' => $fileref,
            'mulai' => $this->request->getVar('mulai'),
            'selesai' => $this->request->getVar('selesai'),
            'jml_bln' => $this->request->getVar('jml_bln'),
            'inter' => $this->request->getVar('inter')
        ]);    
       //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
      // session()->setFlashdata('sukses-update-pengalaman','Data pengalaman berhasil di-update');  
      // return redirect()->to('pengalaman');
       return redirect()->to(base_url('pengalaman'))->with('sukses-edit', 'Data berhasil diupdate');
    }
 
    public function delete($id) {
        //dd($id);
        $this->proyekModel->delete($id);
      //  session()->setFlashdata('success','Data berhasil dihapus');
        return redirect()->to(base_url('/pengalaman'))->with('sukses-hapus', 'Data berhasil dihapus');
    }

    public function baca($id)
    {
      $proyek = $this->proyekModel->getProyek($id); 
        $data = [
            'judul' => 'Baca Data Pengalaman',
            'result' => $proyek,
        ];
        return view('exp/baca', $data);
    }
    public function exportpdf() {
      $result = $this->proyekModel->getProyek();
      $data = ['result'=>$result];
      $view = view('exp/pdf_report',$data);
      $dompdf = new Dompdf();
      $dompdf->loadHtml($view);
      $dompdf->setPaper('A4', 'landscape');
      $dompdf->render();
      $dompdf->stream('Daftar Pengalaman', array("Attachment" => false));
    }

    
    public function importExcel() {//importExcel
      $spreadsheet = new Spreadsheet();
      //  Ambil file dari name (input type="file".... name="excel".....) di dalam index.php
      $file = $this->request->getFile('excel');
      $ext = $file->getExtension();
      
      if ($ext === "xls" || $ext === "xlsx") {
          $this->proyekModel->kosongkan();
          if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
          else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
          $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
          $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
          foreach ($sheet as $index=>$item) {
              if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
           
              if ($item[0] == "") {
                  break;       
               }
               if ($item[8]!="" && $item[9]!="") {
                  //  Memanggil fungsi dari Base.php untuk menghitung intermitten
                  $this->base = new Base();
                  $inter = $this->base->hitung_intermitten($item[8], $item[9]); 
                //dd($inter);
                  $jml_bln = $this->base->hitung_bulan($item[8], $item[9]);
               }
               else {
                  $inter = "";
                  $jml_bln = 0;
               }
               
                  $data =
                     [  
                          'id'=>$item[0],           //      kolom A
                          'kode_proyek'=>$item[1],  //      kolom B
                          'instansi'=>$item[2],     //      kolom C
                          'pekerjaan'=>$item[3],    //      kolom D
                          'tahun'=>$item[4],        //      kolom E
                          'lokasi'=>$item[5],       //      kolom F
                          'alamat'=>$item[6],       //      kolom G
                          'nokontrak'=>$item[7],    //      kolom H
                          'mulai'=>$item[8],        //      kolom I
                          'selesai'=>$item[9],      //      kolom J
                          'nilai'=>$item[10],       //      kolom K
                          'referensi'=>$item[11],   //      kolom L
                          'jml_bln'=>$jml_bln,      //      kolom M
                          'inter'=>$inter,          //      kolom N
                          'refpdf'=>$item[14]       //      kolom O                      
                        ];
                  
                   $this->proyekModel->insert($data);  // mulai baris 1 dan seterusnya
                   
          }
          session()->setFlashdata('import','Data berhasil di-impor'); 
      }
      else {
          session()->setFlashdata('error','Bukan format file excel'); 
      }
      return redirect()->to('/pengalaman/');
  }
}
