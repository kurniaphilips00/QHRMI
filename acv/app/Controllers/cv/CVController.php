<?php


namespace App\Controllers\cv;

use App\Controllers\BaseController;
use App\Models\rhModel;
use App\Models\posisiModel;
use App\Models\kategoriModel;
use App\Models\jurusanModel;

class CVController extends BaseController
{
    protected $rhModel;
    protected $posisiModel;
    protected $kategoriModel;
    protected $jurusanModel;
    public function __construct()
    {
        $rh = $this->rhModel = new rhModel();
        $posisi = $this->posisiModel = new posisiModel();
        $kategori = $this->kategoriModel = new kategoriModel(); 
        $jurusan = $this->jurusanModel = new jurusanModel(); 
    }

    public function index($S1=null, $S2=null, $S3=null, $pos=null, $usia1=null, $OrderBySIPPED=null)
    {       
        $data = []; 

        if ((int)$OrderBySIPPED==1) {
            $cv = $this->rhModel->getOrderBySIPP_ED();
            $posisi = $this->posisiModel->getPosisi();
            $data = [ 'cv' => $cv, 'posisi' => $posisi  ]; 
            return view('ta/index', $data);
        }  

        if ($usia1!=null) {    
            $usia1=(int)$usia1;       
            $usia2=$usia1+10; 
            $posisi = $this->posisiModel->getPosisi();    
            $cv = $this->rhModel->getFilterUsia($usia1, $usia2);
           // dd($cv);
            $data = [    'cv' => $cv, 'posisi' => $posisi   ]; 
            return view('ta/index', $data);
        }  
      
        if ($pos!=null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getFilterPosisi($pos);
            $data = [ 'cv' => $cv, 'posisi' => $posisi ];
            return view('ta/index', $data);
        } 
        if ($S1!=null) {    
            $posisi = $this->posisiModel->getPosisi();    
            $cv = $this->rhModel->getFilterPendidikanS1($S1);
            $data = [    'cv' => $cv, 'posisi' => $posisi    ]; 
            if ($cv=="") {
                echo "Record yang dicari tidak ada";
            }
            else {
                $data = [    'cv' => $cv, 'posisi' => $posisi    ]; 
                return view('ta/index', $data);
            }
        } 
        if ($S2!=null) {    
            $posisi = $this->posisiModel->getPosisi();    
            $cv = $this->rhModel->getFilterPendidikanS2($S2);
            $data = [    'cv' => $cv, 'posisi' => $posisi    ]; 
            if ($cv=="") {
                echo "Record yang dicari tidak ada";
            }
            else {
                $data = [    'cv' => $cv, 'posisi' => $posisi    ]; 
                return view('ta/index', $data);
            }
        } 
        if ($S3!=null) {    
            $posisi = $this->posisiModel->getPosisi();    
            $cv = $this->rhModel->getFilterPendidikanS3($S3);
            if ($cv=="") {
                echo "Record yang dicari tidak ada";
            }
            else {
                $data = [    'cv' => $cv, 'posisi' => $posisi    ]; 
                return view('ta/index', $data);
            }
        } 
        if ($S1==null && $S2==null && $S3==null && $pos==null && $usia1==null && $OrderBySIPPED==null) {
            $posisi = $this->posisiModel->getPosisi();
            $cv = $this->rhModel->getCV();
            $data = [    'cv' => $cv, 'posisi' => $posisi  ]; 
            return view('ta/index', $data);
        }
    }

    public function OrderByEducation($S1) {
      
        return $this->index($S1, null, null, null, null, null);
    }
    public function OrderByMaster($S2) {
        return $this->index(null, $S2, null, null, null, null);
    }
    public function OrderByDoktor($S3) {
        return $this->index(null, null, $S3, null, null, null);
    }
    public function OrderBySIPPED() {
         return $this->index(null, null, null, null, null, 1);
    }
    public function Usia($umur) {
        return $this->index(null, null, null, null, $umur, null);
    }
    public function fPosisi($p) {
        return $this->index(null, null, null, $p, null, null);
    }

    //  Menambah data dengan refresh
    public function create()
    {           
        $jurusan = $this->jurusanModel->getJurusan();
        $posisi = $this->posisiModel->getPosisi();
        $kategori = $this->kategoriModel->getKategori();
        $data = [ 
            'title' => 'Tambah Data',    
            'jurusan' => $jurusan,
            'posisi' => $posisi,    
            'kategori' => $kategori,
            'validation' => \Config\Services::validation()
        ];       
        return view('ta/create', $data);
    }
    public function simpan()    //  Menambah data
    {
        $rules = $this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.',
                ]
            ],
            'perusahaan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Perusahaan harus diisi.',
                ]
            ],
            'posisi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Posisi harus diisi.',
                ]
            ],
            
            'pasfoto'=> [
                'rules'  =>  [
                   
                    'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
                'label' => 'pas foto',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ],
            'fktp'=> [
                'rules'  => [
                    // 'is_image[pasfoto]'
                      'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                     . '|max_size[pasfoto,1024]'
                     . '|max_dims[pasfoto,1000,1000]'
                     . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                 ],
                'label' => 'KTP',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ],
            'fnpwp'=> [
                'rules'  => [
                    // 'is_image[pasfoto]'
                      'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                     . '|max_size[pasfoto,1024]'
                     . '|max_dims[pasfoto,1000,1000]'
                     . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                 ],
                'label' => 'NPWP',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ],          
            'fsipp'=> [
                'rules'  => [
                    // 'is_image[pasfoto]'
                      'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                     . '|max_size[pasfoto,1024]'
                     . '|max_dims[pasfoto,1000,1000]'
                     . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                 ],
                'label' => 'SIPP',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
            ],           
            'fstr'=> [
                'rules'  => [
                    // 'is_image[pasfoto]'
                      'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                     . '|max_size[pasfoto,1024]'
                     . '|max_dims[pasfoto,1000,1000]'
                     . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                 ],
                'label' => 'STR',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ], 
            'fkta'=> [
                'rules'  => [
                    // 'is_image[pasfoto]'
                      'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                     . '|max_size[pasfoto,1024]'
                     . '|max_dims[pasfoto,1000,1000]'
                     . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                 ],
                'label' => 'KTA',
                'errors' => [
                    'max_size' => 'Ukuran file {field} > 1 MB',
                    'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                    'mime_in' => '{field} bukan file gambar',
                    'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
                ]
            ]
        ]);
        if (!$rules) 
           {    //--pasangannya di create.php 
            session()->setFlashdata('add-failed','Tambah Data gagal !!!');
            return redirect()->back()->withInput();
          }        
        
        $foto = $this->request->getFile('pasfoto');
        if ($foto->getError()===4) {
            $namagbrfoto = 'placeholder.png';
        }
        else {
            $namagbrfoto = $foto->getName();
            $foto -> move (WRITEPATH. '../public/img', $namagbrfoto);
        }

        $ktp = $this->request->getFile('ktp');
        if ($ktp->getError()===4) {
            $filektp = 'placeholder.png';
        }
        else {
            $filektp = $ktp->getName();
            $ktp -> move (WRITEPATH. '../public/img', $filektp);
        }

        $npwp = $this->request->getFile('npwp');
        if ($npwp->getError()===4) {
            $filenpwp = 'placeholder.png';
        }
        else {
            $filenpwp = $npwp->getName();
            $npwp -> move (WRITEPATH. '../public/img', $filenpwp);
        }

        $sipp = $this->request->getFile('gbrSIPP');
        if ($sipp->getError()===4) {
            $filesipp = 'placeholder.png';
        }
        else {
            $filesipp = $sipp->getName();
            $sipp -> move (WRITEPATH. '../public/img', $filesipp);
        }

        $str = $this->request->getFile('gbrSTR');
        if ($str->getError()===4) {
            $filestr = 'placeholder.png';
        }
        else {
            $filestr = $str->getName();
            $str -> move (WRITEPATH. '../public/img', $filestr);
        }

        $kta = $this->request->getFile('gbrKTA');
        if ($kta->getError()===4) {
            $filekta = 'placeholder.png';
        }
        else {
            $filekta = $kta->getName();
            $kta -> move (WRITEPATH. '../public/img', $filekta);
        }

        $ref = $this->request->getFile('ref');
        if ($ref->getError()===4) {
            $fileref = 'placeholder.png';
        }
        else {
            $fileref = $ref->getName();
            $ref -> move (WRITEPATH. '../public/img', $fileref);
        }
        //dd($this->request->getVar('posisi'));
        $this->rhModel->save([   //  /////////      Simpan data baru ////////////////////////////////// 
              'posisi' => $this->request->getVar('posisi'),
              'perusahaan' => $this->request->getVar('perusahaan'),
              'nama' => $this->request->getVar('nama'),
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
              'pasfoto' => $namagbrfoto, 
              'fktp' => $filektp,         
              'fnpwp' => $filenpwp, 
              'fsipp' => $filesipp, 
              'fstr' => $filestr, 
              'fkta' => $filekta, 
              'ref' => $fileref
         ]);
         // Pasangannya di create.php..... <?php if (session('tambah'))
         session()->setFlashdata('tambah','Data berhasil ditambah'); 
         //   Kembali ke dashboard admin
         return redirect()->to('tambah-CV');          
    }
   //  Ini untuk menyimpan data dari hasil edit ( update data )
   public function update($id)
   {    
       $jurusan = $this->jurusanModel->getJurusan();
       $posisi = $this->posisiModel->getPosisi();
       $data = [
       'title'=>'Detil Tenaga Ahli',
       'result'=>$this->rhModel->getCV($id),
       'posisi' => $posisi, 
       'jurusan' => $jurusan, 
       'validation' => \Config\Services::validation()      
      ];
      return view('ta/update', $data);
   }
   public function simpan_update($id)
   { 
     
       $rules = $this->validate([
           'nama' => [
               'rules'  => 'required',
               'errors' => [
                   'required' => 'Nama harus diisi.',
               ]
           ],
           'perusahaan' => [
               'rules'  => 'required',
               'errors' => [
                   'required' => 'Perusahaan harus diisi.',
               ]
           ],
           'posisi' => [
               'rules'  => 'required',
               'errors' => [
                   'required' => 'Posisi harus diisi.',
               ]
           ],
           'pasfoto'=> [
               'rules' =>[
                   'mime_in[pasfoto,image/png,image/PNG,image/jpeg,image/jpg]'
                   . '|max_size[pasfoto,1024]'
                   . '|max_dims[pasfoto,1000,1000]'
                   . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
               ],
               'label' => 'pas foto',
               'errors' => [
                   'mime_in' => '{field} bukan file gambar',
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
           ],
           'fktp'=> [
               'rules'  => [
                   // 'is_image[pasfoto]'
                     'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
               'label' => 'KTP',
               'errors' => [
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'mime_in' => '{field} bukan file gambar',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
           ],
           'fnpwp'=> [
               'rules'  => [
                   // 'is_image[pasfoto]'
                     'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
               'label' => 'NPWP',
               'errors' => [
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'mime_in' => '{field} bukan file gambar',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
           ],          
           'fsipp'=> [
               'rules'  => [
                   // 'is_image[pasfoto]'
                     'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
               'label' => 'SIPP',
               'errors' => [
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'mime_in' => '{field} bukan file gambar',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
              ]
           ],           
           'fstr'=> [
               'rules'  => [
                   // 'is_image[pasfoto]'
                     'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
               'label' => 'STR',
               'errors' => [
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'mime_in' => '{field} bukan file gambar',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
           ], 
           'fkta'=> [
               'rules'  => [
                   // 'is_image[pasfoto]'
                     'mime_in[pasfoto,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[pasfoto,1024]'
                    . '|max_dims[pasfoto,1000,1000]'
                    . '|ext_in[pasfoto,jpg,jpeg,gif,png]'
                ],
               'label' => 'KTA',
               'errors' => [
                   'max_size' => 'Ukuran file {field} > 1 MB',
                   'max_dims' => 'Dimensi file {field} > 1000 x 1000',
                   'mime_in' => '{field} bukan file gambar',
                   'ext_in' => 'Ekstensi file {field} bukan jpg,jpeg,gif, atau png'
               ]
           ]
       ]);
     
       
       if (!$rules) 
          {
           session()->setFlashdata('update-failed','Update Data gagal !!!');
           return redirect()->back()->withInput();
         }  
         $foto = $this->request->getFile('pasfoto');
        
       //  Jika gambar tidak berubah
         if ($foto->getError()===4) {
             $namagbrfoto = $this->request->getPost('gbrFotoLama');
         }
         else {
           //  Ambil nama file gambar
             $namagbrfoto = $foto->getName();
             //    Pindahkan ke folder img
             $foto -> move (WRITEPATH. '../public/img', $namagbrfoto);
             //    Hapus gambar lama jika ada
            if ($this->request->getPost('gbrFotoLama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrFotoLama'));
            }             
         }
       //  Jika gambar tidak berubah
         $ktp = $this->request->getFile('ktp');
         if ($ktp->getError()===4) {
           $namagbrKTP = $this->request->getPost('gbrKTPLama');
         }
         else {
           //  Ambil nama file gambar
             $namagbrKTP = $ktp->getName();
             //    Pindahkan ke folder img
             $ktp -> move (WRITEPATH. '../public/img', $namagbrKTP);
             //    Hapus gambar lama jika ada
            if ($this->request->getPost('gbrKTPLama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrKTPLama'));
            }
         }
        //  Jika gambar tidak berubah
         $npwp = $this->request->getFile('npwp');
         if ($npwp->getError()===4) {
           $namagbrNPWP = $this->request->getPost('gbrNPWPLama');
         }
         else {
            //  Ambil nama file gambar
             $namagbrNPWP = $npwp->getName();
              //    Pindahkan ke folder img
             $npwp -> move (WRITEPATH. '../public/img', $namagbrNPWP);
             //    Hapus gambar lama jika ada
             if ($this->request->getPost('gbrNPWPLama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrNPWPLama'));
            }
         }
         //  Jika gambar tidak berubah
         $sipp = $this->request->getFile('gbrSIPP');
         if ($sipp->getError()===4) {
           $namagbrSIPP = $this->request->getPost('gbrSIPPLama');
            
         }
         else {
            //  Ambil nama file gambar
             $namagbrSIPP = $sipp->getName();
               //    Pindahkan ke folder img
             $sipp -> move (WRITEPATH. '../public/img', $namagbrSIPP);
             //    Hapus gambar lama jika ada
             if ($this->request->getPost('gbrSIPPLama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrSIPPLama'));
               }
         }
         /////////////////////////     STR START   ///////////////////////////////////////////////
           //  Jika gambar tidak berubah
         $str = $this->request->getFile('gbrSTR');
         if ($str->getError()===4) {
               $namagbrSTR = $this->request->getPost('gbrSTRLama');
         }
         else {
           //  Ambil nama file gambar
           $namagbrSTR = $str->getName();
            //    Pindahkan ke folder img
           $str -> move (WRITEPATH. '../public/img', $namagbrSTR);
                  //    Hapus gambar lama jika ada
           if ($this->request->getPost('gbrSTRLama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrSTRLama'));
           }
         }
         /////////////////////////     STR END     ///////////////////////////////////////////////

       /////////////////////////     KTA START   ///////////////////////////////////////////////
         //  Jika gambar tidak berubah
         $kta = $this->request->getFile('gbrKTA');
         if ($kta->getError()===4) {
             $namagbrKTA = $this->request->getPost('gbrKTALama');
         }
         else {
           //  Ambil nama file gambar
             $namagbrKTA = $kta->getName();
              //    Pindahkan ke folder img
             $kta -> move (WRITEPATH. '../public/img', $namagbrKTA);
           //    Hapus gambar lama jika ada
           if ($this->request->getPost('gbrKTALama') != "" )  {
               unlink(WRITEPATH. '../public/img/'.$this->request->getPost('gbrKTALama'));
           }
         }
        /////////////////////////     KTA END   ///////////////////////////////////////////////
         
        /////////////////////////     File pdf start   ///////////////////////////////////////////////
        //  Jika file pdf tidak berubah
           $ref = $this->request->getFile('ref');
           if ($ref->getError()===4) {
               $namapdf = $this->request->getPost('pdfREFLama');
           }
           else {
             //  Ambil nama file gambar
               $namapdf = $ref->getName();
                //    Pindahkan ke folder img
               $ref -> move (WRITEPATH. '../public/img', $namapdf);
             //    Hapus gambar lama jika ada
             if ($this->request->getPost('pdfREFLama') != "" )  {
                   unlink(WRITEPATH. '../public/img/'.$this->request->getPost('pdfREFLama'));
               }

           }
       /////////////////////////     File pdf end   ///////////////////////////////////////////////
       $this->rhModel->save([  /////////UPDATE//////////////////////////////////
           'id' => $id,
           'posisi' => $this->request->getVar('posisinya'),
           'perusahaan' => $this->request->getVar('perusahaan'),
           'nama' => $this->request->getVar('nama'),
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
           'pasfoto' => $namagbrfoto,
           'fktp' => $namagbrKTP,
           'fsipp' => $namagbrSIPP,
           'fnpwp' => $namagbrNPWP,
           'fstr' => $namagbrSTR,
           'fkta' => $namagbrKTA, 
           'ref' => $namapdf 
      ]);
  
      session()->setFlashdata('berhasilUpdate','Data berhasil diupdate');
      return redirect()->to('cv');
   }

   public function delete($id) {
       $this->rhModel->delete($id);//
       session()->setFlashdata('hapus','Data berhasil dihapus');
       return redirect()->to('cv');
   }
   public function sop() {
       return view('ta/help');
   }

}
