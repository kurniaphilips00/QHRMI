<?php

namespace App\Controllers\Admin;
use App\Models\rhModel;
use App\Controllers\BaseController;
use App\Models\expModel;
use App\Models\posisiModel;
use App\Models\proyekModel;
use App\Models\viewModel;
class ExpController extends BaseController
{
    public function __construct()
    {
        $view = $this->viewModel = new viewModel();  
        $rh = $this->rhModel = new rhModel();    
        $exp = $this->expModel = new expModel();  
        $posisi = $this->posisiModel = new posisiModel();  
        $proyek = $this->proyekModel = new proyekModel();
    }

    public function index($FilterByName=null)
    {

        if ($FilterByName!=null) {    
            $rh = $this->rhModel->getCV();
            $exp = $this->expModel->getFilterByName($FilterByName);
            $data = [    'rh' => $rh, 'exp' => $exp   ]; 
            return view('admin/exp/index', $data);
        } 
        else {
            $exp = $this->expModel->getExp();// Join ke ta untuk mencetak nama tenaga ahli
            $rh = $this->rhModel->getCV();
            $data = [           
                'rh' => $rh,
                'exp' => $exp
            ];
            return view('/admin/exp/index', $data);
        }
    }

    public function FilterByName($n) {
      
        return $this->index($n);
    }
      ///////////Tambah data pengalaman//////////////////////////
      public function tambah_exp()
      {       
        $proyek = $this->proyekModel->getProyek();
        $posisi = $this->posisiModel->getPosisi();
          $ta = $this->rhModel->getCV();// Untuk memilih nama dan mengambil id Tenaga Ahli
          $exp = $this->expModel->getExp();  
          
          $data = [ 
              'title' => 'Tambah Data Pengalaman',   
              'ta' => $ta, // Untuk memilih nama dan mengambil id dari Tenaga Ahli
              'exp' => $exp,    
              'posisi' => $posisi, 
              'proyek' => $proyek,
              'validation' => \Config\Services::validation()
          ];  
          return view('admin/exp/tambah_exp', $data);
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
            'pengguna'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pengguna harus diisi.',
                ],
            ],
            'kegiatan'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kegiatan harus diisi.',
                ],
            ]
        ]);
        if (!$rules) 
           {    //--pasangannya di tambah_exp.php 
            session()->setFlashdata('gagal-menambah-pengalaman','Tambah data pengalaman gagal !!!');
            return redirect()->back()->withInput();
          } 
 
          $this->expModel->save([
            // id tidak perlu disimpan karena autoincrement, otomatis di-update, 
              'kode_ta' => $this->request->getVar('kode_ta'),  
              'nama_ta' => $this->request->getVar('nama_ta'),   
              'kegiatan' => $this->request->getVar('kegiatan'),
              'lokasi' => $this->request->getVar('lokasi'),
              'pengguna' => $this->request->getVar('pengguna'),
              'pers' => $this->request->getVar('pers'),
              'posisitugas' => $this->request->getVar('posisi'),
              'referensi' => $this->request->getVar('referensi'),
              'statuse' => $this->request->getVar('status'),
              'tahun' => $this->request->getVar('tahun'), 
              'uraian' => $this->request->getVar('uraian'),
              'mulai' => $this->request->getVar('mulai'),
              'selesai' => $this->request->getVar('selesai'),
              'jml_bln' => $this->request->getVar('jml_bln'),
              'inter' => $this->request->getVar('inter')
          ]);    
          //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
          session()->setFlashdata('sukses-tambah-pengalaman','Data pengalaman berhasil ditambah'); 
         return redirect()->to('pengalaman');
      }

    public function edit_exp($id)
    {   
        $posisi = $this->posisiModel->getPosisi();
        $pengalaman = $this->expModel->getExp($id);
     //   dd($pengalaman);
        $data = [        
            'exp' => $pengalaman,
            'posisi' => $posisi,
            'validation' => \Config\Services::validation()
        ];
       return view('admin/exp/edit_exp', $data);
    }
     
    public function update_exp($id)
    { 
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
            'pengguna'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pengguna harus diisi.',
                ],
            ],
            'kegiatan'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kegiatan harus diisi.',
                ],
            ]
        ]);
        if (!$rules) 
           {    //--pasangannya di tambah_exp.php 
            session()->setFlashdata('gagal-update-pengalaman','Update data pengalaman gagal !!!');
            return redirect()->back()->withInput();
          } 
        //  dd($this->request->getVar('inter'));
        $this->expModel->save([
            'id_exp'=>$id,  // Jika memakai id berarti diasumsikan update, kode_ta dan nama_ta tidak boleh diedit karena merupakan penghubung ke TA
            'kode_ta' => $this->request->getVar('kode_ta'),  
            'nama_ta' => $this->request->getVar('nama_ta'),   
            'kegiatan' => $this->request->getVar('kegiatan'),
            'lokasi' => $this->request->getVar('lokasi'),
            'pengguna' => $this->request->getVar('pengguna'),
            'pers' => $this->request->getVar('pers'),
            'posisitugas' => $this->request->getVar('posisipenugasan'),
            'referensi' => $this->request->getVar('referensi'),
            'statuse' => $this->request->getVar('status'),
            'tahun' => $this->request->getVar('tahun'), 
            'uraian' => $this->request->getVar('uraian'),
            'mulai' => $this->request->getVar('mulai'),
            'selesai' => $this->request->getVar('selesai'),
            'jml_bln' => $this->request->getVar('jml_bln'),
            'inter' => $this->request->getVar('inter')
        ]);    
       //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
       session()->setFlashdata('sukses-update-pengalaman','Data pengalaman berhasil di-update');  
       return redirect()->to('pengalaman');
    }
  

    public function baca_pengalaman($id)
    {     
      //  $data = ['cv'=>$this->cvModel->getCV($id)];
        //dd($data);
        //return view('admin/read', $data);
        $data = [
            'title'=>'Detil Pengalaman Tenaga Ahli',
            'exp'=>$this->expModel->getExp($id)
           // 'category' => $category_model -> orderby('category')->findAll(),
           // 'validation' => \Config\Services::validation()      
           ];
          //dd($data);
           return view('admin/ta/baca_pengalaman', $data);
    }
  
 
   
    public function delete_exp($id) {
        //dd($id);
        $this->expModel->delete($id);
        session()->setFlashdata('success','Data berhasil dihapus');
        return redirect()->to('pengalaman');
    }

    public function tambah_uraian()
      {       
        
          $ta = $this->rhModel->getCV();// Ini diperlukan untuk memilih nama dan mengambil id dari Tenaga Ahli
          $exp = $this->expModel->getExp();  
          $uraian = $this->uraianModel->getUraian();    
          $data = [ 
              'title' => 'Tambah Data Uraian',   
              'ta' => $ta, // Ini diperlukan untuk memilih nama dan mengambil id dari Tenaga Ahli
              'exp' => $exp, 
              'uraian' => $uraian,   
              'validation' => \Config\Services::validation()
          ];
        
          return view('admin/exp/uraian/tambah_uraian', $data);
      }

}
