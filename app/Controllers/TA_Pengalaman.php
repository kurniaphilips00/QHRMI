<?php
namespace App\Controllers;
use App\Models\rhModel;
use App\Controllers\BaseController;
use App\Models\posisiModel;
use App\Models\proyekModel;
use App\Models\proyekTAModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TA_Pengalaman extends BaseController
{
    protected $rhModel;
    
    protected $posisiModel;
    protected $proyekModel;
    protected $proyekTAModel;
    public function __construct()
    {
        $posisi = $this->posisiModel = new posisiModel();
        $rh = $this->rhModel = new rhModel();    
        $proyekTA = $this->proyekTAModel = new proyekTAModel(); 
        $proyek = $this->proyekModel = new proyekModel();
    }       
    public function index($id = null, $nama = null, $idProyek = null, $namaProyek = null)
    {
        if ($idProyek != null) {
            $proyekTA = $this->proyekTAModel->getFilterIDProyek($idProyek);
            $TAOrderByID = $this->rhModel->getTAOrderByID();
            $TAOrderByName = $this->rhModel->getTAOrderByName();
            $ProyekOrderByID = $this->proyekModel->getProyekOrderByID();
            $ProyekOrderByProyek = $this->proyekModel->getProyekOrderByProyek();
            $data = [
                'judul' => 'Data Tenaga Ahli - Pengalaman (filtered)',
                'proyekTA' => $proyekTA,
                'TAOrderByID' => $TAOrderByID,
                'TAOrderByName' => $TAOrderByName,
                'ProyekOrderByID' => $ProyekOrderByID,
                'ProyekOrderByProyek' => $ProyekOrderByProyek,
            ];
            if ($proyekTA == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/expExperts/index', $data);
            }
        }

        if ($namaProyek != null) {
            $proyekTA = $this->proyekTAModel->getFilterNamaProyek($namaProyek);
            $TAOrderByID = $this->rhModel->getTAOrderByID();
            $TAOrderByName = $this->rhModel->getTAOrderByName();
            $ProyekOrderByID = $this->proyekModel->getProyekOrderByID();
            $ProyekOrderByProyek = $this->proyekModel->getProyekOrderByProyek();
            $data = [
                'judul' => 'Data Tenaga Ahli - Pengalaman (filtered)',
                'proyekTA' => $proyekTA,
                'TAOrderByID' => $TAOrderByID,
                'TAOrderByName' => $TAOrderByName,
                'ProyekOrderByID' => $ProyekOrderByID,
                'ProyekOrderByProyek' => $ProyekOrderByProyek,
            ];
            if ($proyekTA == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/expExperts/index', $data);
            }
        }

        if ($id != null) {
            $proyekTA = $this->proyekTAModel->getFilterIDTA($id);
            $TAOrderByID = $this->rhModel->getTAOrderByID();
            $TAOrderByName = $this->rhModel->getTAOrderByName();
            $ProyekOrderByID = $this->proyekModel->getProyekOrderByID();
            $ProyekOrderByProyek = $this->proyekModel->getProyekOrderByProyek();
            $data = [
                'judul' => 'Data Tenaga Ahli - Pengalaman (filtered)',
                'proyekTA' => $proyekTA,
                'TAOrderByID' => $TAOrderByID,
                'TAOrderByName' => $TAOrderByName,
                'ProyekOrderByID' => $ProyekOrderByID,
                'ProyekOrderByProyek' => $ProyekOrderByProyek,
            ];
            if ($proyekTA == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/expExperts/index', $data);
            }
        }

        if ($nama != null) {
            $proyekTA = $this->proyekTAModel->getFilterNamaTA($nama);
            $TAOrderByID = $this->rhModel->getTAOrderByID();
            $TAOrderByName = $this->rhModel->getTAOrderByName();
            $ProyekOrderByID = $this->proyekModel->getProyekOrderByID();
            $ProyekOrderByProyek = $this->proyekModel->getProyekOrderByProyek();
            $data = [
                'judul' => 'Data Tenaga Ahli - Pengalaman (filtered)',
                'proyekTA' => $proyekTA,
                'TAOrderByID' => $TAOrderByID,
                'TAOrderByName' => $TAOrderByName,
                'ProyekOrderByID' => $ProyekOrderByID,
                'ProyekOrderByProyek' => $ProyekOrderByProyek,
            ];
            if ($proyekTA == "") {
                echo '<script type="text/javascript">';
                echo ' alert("Data yang dicari tidak ada")';  //not showing an alert box.
                echo '</script>';
            } else {
                return view('/expExperts/index', $data);
            }
        }

        if ($id == null && $nama == null && $idProyek == null && $namaProyek == null) {        
            $proyekTA = $this->proyekTAModel->getViewPengalaman();
          //  $TAOrderByID = $this->rhModel->getTAOrderByID();
          $TAOrderByName = $this->rhModel->getTAOrderByName();
          //  $ProyekOrderByID = $this->proyekModel->getProyekOrderByID();
          //  $ProyekOrderByProyek = $this->proyekModel->getProyekOrderByProyek();
            $data = [           
                'judul' => 'Data Pengalaman Tenaga Ahli',
                'proyekTA' => $proyekTA,
              //  'TAOrderByID' => $TAOrderByID,
                'TAOrderByName' => $TAOrderByName,
              //  'ProyekOrderByID' => $ProyekOrderByID,
              //  'ProyekOrderByProyek' => $ProyekOrderByProyek
            ];
            return view('/expExperts/index', $data);
        }
    }

    public function FilterTAByID($id) {
        return $this->index($id, null);
    }
    public function FilterTAByName($n) {
        return $this->index(null, $n);
    }
    public function FilterProyekByID($id) {
        return $this->index($id, null);
    }
    public function FilterProyekByName($n) {
        return $this->index(null, $n);
    }
    ///////////Tambah tenaga ahli//////////////////////////
    public function tambah()
    {    
        helper('custom_helper'); // Loading single helper
        
        $proyek = $this->proyekTAModel->getPengalamanOrderByKode();
        if (checkSkip($proyek,'tb_proyek_ta') == null) {
        $kode = hitungKode('tb_proyek_ta');
        }
        else {
            $kode = checkSkip($proyek,'tb_proyek_ta');
        }
        //dd(checkPengalaman($proyek));
        $posisi = $this->posisiModel->getPosisiByKode();
       
        $proyek = $this->proyekModel->getProyekOrderByKode();// Untuk memilih pengalaman urut berdasarkan nama
       // $proyekTA = $this->proyekTAModel->getTAProyek();
    //$taID = $this->rhModel->getTAOrderByID();// Untuk memilih Tenaga Ahli urut berdasarkan ID
        $ta = $this->rhModel->getCVwithKode();// Untuk memilih Tenaga Ahli urut berdasarkan nama
        $data = [ 
            'judul' => 'Tambah Tenaga Ahli',   
//'taID' => $taID, // Untuk memilih nama dan mengambil id dari Tenaga Ahli
            'ta' => $ta,
            
            'proyek' => $proyek,
            'proyekTA' => $proyek,
            'posisi' => $posisi,
            'kode' => $kode,
            'validation' => \Config\Services::validation()
          ];    
        return view('/expExperts/add_expert', $data);
    }
   
    ///////////  Menyimpan hasil tambah pengalaman/////////////////////////
    public function simpan()
      {           
        $rules = $this->validate([
            'kode_proyek'         => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kode Pekerjaan harus diisi.',
                ],
            ],
            'kode_TA'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'kode Tenaga Ahli harus diisi.',
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
          'kode_pengalaman' => $this->request->getVar('kode_pengalaman'), 
          'kode_proyek' => $this->request->getVar('kode_proyek'),
          'kode_TA' => $this->request->getVar('kode_TA'),
          'kode_posisi' => $this->request->getVar('posisi')
      ]);    
     
         //return redirect()->to(base_url('/pengalaman/tambahTA'))->with('sukses-tambah-ta', 'Data berhasil disimpan');
          //--pasangannya di admin/exp/index.php, karena kalau berhasil langsung kembali ke route /pengalaman (admin/exp/index.php)   
         // session()->setFlashdata('sukses-tambah-TA','Data Tenaga Ahli berhasil ditambah'); 
         return redirect()->to(base_url('/ta-exp/tambah'))->with('sukses-tambah-ta', 'Data berhasil disimpan');
      }

    public function edit($id) {
        $posisi = $this->posisiModel->getPosisi();   
        $ta = $this->rhModel->getCV();// Untuk memilih nama dan mengambil id Tenaga Ahli
        $proyekTA = $this->proyekTAModel->getTAProyekByID($id);
        $proyek = $this->proyekModel->getProyek();
      
        $data = [ 
            'judul' => 'Edit Pengalaman Tenaga Ahli',   
            'ta' => $ta,   
            'proyek' => $proyek, 
            'proyekTA' => $proyekTA,
            'posisi' => $posisi,
            'validation' => \Config\Services::validation()
        ];  
        //  dd($proyek);
        return view('/expExperts/edit_expert', $data);
    }

    public function update($id) {
       
        $this->proyekTAModel->save([
            'id' => $id,
            'perusahaan' => $this->request->getVar('perusahaan'),
            'posisitugas' => $this->request->getVar('posisi'),
            'statuskepegawaian' => $this->request->getVar('statuskepegawaian'),
            'uraian'  => $this->request->getVar('editor1')
        ]);    
    
        return redirect()->to(base_url('ta-exp'))->with('sukses-update-ta', 'Data berhasil di-update');
    }
    public function delete($id) {
        //dd($id);
        $this->proyekTAModel->delete($id);
        session()->setFlashdata('success-delete','Data berhasil dihapus');
        return redirect()->to('ta-exp/');
    }
    public function baca($kode)
    {
        $proyekTA = $this->proyekTAModel->getPengalamanOrderByKode($kode); 
        $data = [
            'judul' => 'Baca Data Tenaga Ahli',
            'proyekTA' => $proyekTA,
        ];
        return view('expExperts/read_expert', $data);
    }
    
    public function importExcel() {//importExcel
        $spreadsheet = new Spreadsheet();
        //  Ambil file dari name (input type="file".... name="excel".....) di dalam index.php
        $file = $this->request->getFile('excel');
        $ext = $file->getExtension();
        $this->proyekTAModel->kosongkan();
        if ($ext === "xls" || $ext === "xlsx") {
            $this->proyekTAModel->kosongkan();
            if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
            else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
            $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
            $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
            foreach ($sheet as $index=>$item) {
                if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
             
                if ($item[0] == "" || $item[1] == "" || $item[2] == "" || $item[3] == "" || $item[4] == "") {
                    continue;       
                 }
                 if ($item[0] != "" && $item[1] != "" && $item[2] != "" && $item[3] != "" && $item[4] != "") {
                    $data =
                       [  
                            'id'=>$item[0],                 //      kolom A
                            'kode_pengalaman'=>$item[1],    //      kolom B
                            'kode_proyek'=>$item[2],        //      kolom C
                            'kode_TA'=>$item[3],            //      kolom D
                            'kode_posisi'=>$item[4],        //      kolom E
                        ];      
                        $this->proyekTAModel->insert($data);  // mulai baris 1 dan seterusnya 
                 } 
                 
            }
            session()->setFlashdata('import','Data berhasil di-impor'); 
        }
        else {
            session()->setFlashdata('error','Bukan format file excel'); 
        }
        return redirect()->to('ta-exp/');
    }

    public function intermitten($kode = null)
    {
        $dompdf = new Dompdf();
       
        $pengalaman = $this->proyekTAModel->getIntermitten($kode);
       //dd($pengalaman);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Daftar Pengalaman Tenaga Ahli</title>         
        </head>';
        $html .= '
            <div class="container-fluid px-4">
                <center>
                    <h3 class="mt-4">Pengalaman Tenaga Ahli</h3>
                <center>
                <div class="card mb-4">
                    <div class="card-body">
                        <table style="border: 1px solid;">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 5%;">
                                                      
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">No.</th>
                                        <th scope="col" style = "width:20%; text-align:center; border: 1px solid;">Tenaga Ahli</th> 
                                        
                                        <th scope="col" style = "width:30%; text-align:center; border: 1px solid;">Kegiatan</th>
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Thn</th>    
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Durasi</th>        
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Bln</th>  
                                    </tr>
                                </thead>';
        $html .= '<tbody>';
        $i = 1;
        $totbln = 0;
        foreach ($pengalaman as $v) {
            $html .= '
                                    <tr>
                                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $i . '</td>
                                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $v['nama'] . '</td>
                                        
                                        <td style = "width:30%; border: 1px solid;">' . $v['pekerjaan'] . '</td>   
                                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['tahun'] . '</td>   
                                        <td style = "width:5%; border: 1px solid;">' . $v['inter'] . '</td>   
                                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['jml_bln'] . '</td>
                                    </tr>';
            $totbln += $v['jml_bln'];
            $i++;
        }
        $html .= '</tbody>
                        </table>';
        $html .= '
                        </div><!--"card-body"-->
                            <div class="card-footer">
                                <bold>
                                <P style = "text-align : right; margin-right: 50px; background-color: #0c486e; 
                                width : 100%; color: white; font-weight: bold;">   Total pengalaman  ';
        $html .= $totbln;
        $html .= '  bulan';
        $JmlThn = floor($totbln / 12);
        if ($JmlThn > 0) {
            $html .= ' = ';
            $sisabln = $totbln % 12;
            $html .= $JmlThn;
            $html .= ' tahun ';
            $html .= $sisabln;
            $html .= ' bulan';
        }
        $html .= '
                                </p>
                                <bold>
                            </div>
                        </div>
            </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($pengalaman[0]['nama'], array("Attachment" => false));
    }
}
