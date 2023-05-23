<?php

namespace App\Controllers;
use App\Models\rhModel;
use App\Models\lampiranModel;
use App\Controllers\BaseController;
class LampiranController extends BaseController
{
    protected $rhModel;
    protected $lampiranModel; 
    public function __construct()
    {
        $ta = $this->rhModel = new rhModel();    
        $img = $this->lampiranModel = new lampiranModel();   
    }
    public function index($FilterByName=null) {
        if ($FilterByName!=null) {               
            $ta = $this->rhModel->getCV();  //  Untuk membuat select option "Pilih nama" > filter
            $img = $this->lampiranModel->getFilterByName($FilterByName); // Filter sesuai nama        
            $data = [ 'judul' => 'Data Lampiran Tenaga Ahli', 'ta' => $ta, 'img' => $img ]; 
            return view('/lampiran/index', $data);
        } 
        else {
            $ta = $this->rhModel->getCV();  
            $img = $this->lampiranModel->getLampiran();
            $data = [     
                'judul' => 'Data Lampiran Tenaga Ahli',       
                'ta' => $ta, 
                'img' => $img
            ];
        }
        return view ('/lampiran/index', $data);
    }
    public function FilterByName($n) {
        return $this->index($n);
    }
    public function tambah() {
        $ta = $this->rhModel->getTAOrderByKode();  
        $img = $this->lampiranModel->getLampiran();
        $data = [            
            'ta' => $ta, 
            'img' => $img,
            'judul' => 'Tambah Data Lampiran',
            'validation' => \Config\Services::validation() 
        ];
        return view('/lampiran/tambah', $data);
    }
    public function simpan()    //  Menyimpan  data baru
    {
        $gbr = $this->request->getFile('namafile');
    //    dd($gbr);
       
        $rules = $this->validate([
            
            'nama_ta' => ['rules'  => 'required','errors' => ['required' => 'Nama harus diisi.']],
             /*--------------------------------------Validasi image---------------------------------*/
            'namafile' => [
                'rules' => [
                    //'required',
                    'mime_in[namafile,image/png,image/gif,image/jpeg,image/jpg]'
                        . '|max_size[namafile,1024]'
                        . '|max_dims[namafile,1000,1000]'
                        . '|ext_in[namafile,jpg,jpeg,gif,png]'
                ],
                'label' => 'File upload',
                'errors' => [
                  //  'required' => 'File gambar harus diisi',
                    'mime_in' => '{field} bukan file gambar',
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ],
   
            /*--------------------------------------End of validasi image---------------------------------*/
        ]);
    // dd($rules);
        if (!$rules) {   
            session()->setFlashdata('add-failed', 'Tambah Data gagal !!!');
            return redirect()->back()->withInput();
        }
        
      //    nama file diambil dari nama asli file yang di-upload
            $namafilegbr = $gbr->getName();//  Pasti ada file yang di-upload, karena sudah divalidasi (required) 
            $gbr->move(WRITEPATH . '../public/uploads', $namafilegbr);//   Pindah file ke direktori penyimpanan           
            $ukuran = $gbr->getSize();
            $lokasi = "public/uploads/".$namafilegbr;
        
  //      dd($namafilegbr);
      //  dd($this->request->getVar('kode_ta'));
        $this->lampiranModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
            'namafile' => $namafilegbr,
            'ukuran' => $ukuran,
            'lampiran' => $this->request->getVar('lampiran'),
            'path' => $lokasi,
            'kode_ta' => $this->request->getVar('kode_ta'),
            'nama_ta' => $this->request->getVar('nama_ta')
        ]);
        // Pasangannya di create.php..... <?php if (session('tambah'))
        session()->setFlashdata('AddSuccess', 'Data berhasil ditambah');
        //   Kembali ke dashboard admin
        return redirect()->to('/lampiran');
    }
    public function baca($id)
    {
        $ta = $this->rhModel->getCV();  
        $img = $this->lampiranModel->getLampiran($id);
        $data = [            
            'ta' => $ta, 
            'img' => $img,
            'judul' => 'Edit Data Lampiran'
            
        ];
     
        return view('lampiran/baca', $data);
    }
    public function edit($id) {
 
        $lampiran = $this->lampiranModel->getLampiran($id);
        $ta = $this->rhModel->getTAOrderByKode(); 
        $data = [
            'ta' => $ta,
            'judul' => 'Edit Data Lampiran',
            'lampiran' => $lampiran,
           // 'validation' => \Config\Services::validation()  //  Ini diperlukan untuk validasi
        ];
        return view('lampiran/edit', $data);
    } 
    public function update($id)
    {
        $this->lampiranModel->save([  /////////UPDATE//////////////////////////////////
            /* Yang boleh di edit hanya nama lampiran (file image tidak boleh ), nama tenaga ahli dan kode tenaga ahli */ 
            'id' => $id,
            'lampiran' => $this->request->getVar('lampiran'),
            'kode_ta' => $this->request->getVar('kode_ta'),
            'nama_ta' => $this->request->getVar('nama_ta')
            
        ]);
        //session()->setFlashdata('EditSuccess', 'Data berhasil diupdate');
        return redirect()->to(base_url('lampiran/'))->with('edit-success', 'Data berhasil diupdate');
        
    }

    public function delete($id)
    {
        $img = $this->lampiranModel->getLampiran($id);
        //  Baca nama file image
        $namafile = isset($img['namafile']) ? $img['namafile'] : '';
         //  Jika namafile masih ada .....
         if ($namafile != '' ) {
            //  Jika file fisiknya masih ada > hapus !!!
            if (file_exists('uploads/'.$namafile))
                //  Hapus file lama
                unlink( 'uploads/'.$namafile);
         }
        $this->lampiranModel->delete($id); //
        session()->setFlashdata('DelSuccess', 'Lampiran berhasil dihapus');
        return redirect()->to('lampiran/');
    }
}