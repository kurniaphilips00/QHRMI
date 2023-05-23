<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\rhModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelController extends BaseController
{
    protected $rhModel;
    public function __construct()
    {
        $rh = $this->rhModel = new rhModel();     
    }

    public function exportExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Alamat');
        $sheet->setCellValue('D1', 'Kota');
        $sheet->setCellValue('E1', 'Tgl. lahir');
        $sheet->setCellValue('F1', 'Usia');
        $sheet->setCellValue('G1', 'No. KTP');
        $sheet->setCellValue('H1', 'No. NPWP');
        $sheet->setCellValue('I1', 'No. telp');
        $sheet->setCellValue('J1', 'No. hp');
        $sheet->setCellValue('K1', 'Email');
        $sheet->setCellValue('L1', 'Posisi');
        $sheet->setCellValue('M1', 'Perusahaan');
        $sheet->setCellValue('N1', 'Kategori');
        $sheet->setCellValue('O1', 'Ijazah S1');
        $sheet->setCellValue('P1', 'Univ.');
        $sheet->setCellValue('Q1', 'Thn lulus');
        $sheet->setCellValue('R1', 'Ijazah S2');
        $sheet->setCellValue('S1', 'Univ.');
        $sheet->setCellValue('T1', 'Thn lulus');
        $sheet->setCellValue('U1', 'Ijazah S3');
        $sheet->setCellValue('V1', 'Univ.');
        $sheet->setCellValue('W1', 'Thn lulus');
        $sheet->setCellValue('X1', 'SIPP');
        $sheet->setCellValue('Y1', 'SIPP e.d.');
        $sheet->setCellValue('Z1', 'STR');
        $sheet->setCellValue('AA1', 'SIPP e.d.');
        $sheet->setCellValue('AB1', 'KTA');
        $sheet->setCellValue('AC1', 'KTA e.d.');
        $sheet->setCellValue('AD1', 'Asosiasi');
        $sheet->setCellValue('AE1', 'Ref');
        $sheet->setCellValue('AF1', 'Status');
        $row = 2;
        $cv = $this->rhModel->getCV();
        foreach ($cv as $v => $item) {
              
           // $sheet->setCellValue('A'.$row, $v+1)
            $sheet->setCellValue('A'.$row, $item['id'])
            ->setCellValue('B'.$row, $item['nama'])
            ->setCellValue('C'.$row, $item['alamat'])
            ->setCellValue('D'.$row, $item['kota'])
            ->setCellValue('E'.$row, $item['tgl'])
            ->setCellValue('F'.$row, $item['usia'])
            ->setCellValue('G'.$row, $item['no_ktp'])
            ->setCellValue('H'.$row, $item['no_npwp'])
            ->setCellValue('I'.$row, $item['no_telp'])
            ->setCellValue('J'.$row, $item['no_hp'])
            ->setCellValue('K'.$row, $item['email'])
            ->setCellValue('L'.$row, $item['posisi'])
            ->setCellValue('M'.$row, $item['perusahaan'])
            ->setCellValue('N'.$row, $item['kategori'])
            ->setCellValue('O'.$row, $item['ijazahS1'])
            ->setCellValue('P'.$row, $item['s1_univ'])
            ->setCellValue('Q'.$row, $item['s1_thn'])
            ->setCellValue('R'.$row, $item['ijazahS2'])
            ->setCellValue('S'.$row, $item['s2_univ'])
            ->setCellValue('T'.$row, $item['s2_thn'])
            ->setCellValue('U'.$row, $item['ijazahS3'])
            ->setCellValue('V'.$row, $item['s3_univ'])
            ->setCellValue('W'.$row, $item['s3_thn'])
            ->setCellValue('X'.$row, $item['sipp'])
            ->setCellValue('Y'.$row, $item['sipp_ed'])
            ->setCellValue('Z'.$row, $item['str'])
            ->setCellValue('AA'.$row, $item['str_ed'])
            ->setCellValue('AB'.$row, $item['kta'])
            ->setCellValue('AC'.$row, $item['kta_ed'])
            ->setCellValue('AD'.$row, $item['asosiasi'])
            ->setCellValue('AE'.$row, $item['ref'])
            ->setCellValue('AF'.$row, $item['status']);
            $row++;
        }
        
          /*'id','nama','alamat','kota','tgl','usia','no_ktp','no_npwp','no_telp','no_hp','email',
                        'posisi','perusahaan','kategori','ijazahS1','s1_univ','s1_thn',
                        'ijazahS2','s2_univ','s2_thn',
                        'ijazahS3','s3_univ','s3_thn','sipp','sipp_ed','str','str_ed',
                        'kta','kta_ed','asosiasi',
                        'ref','status'
                        */
        $filename = "ta";
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$filename.'.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function importExcel() {
        $spreadsheet = new Spreadsheet();
        //  Ambil file dari name (input type="file".... name="excel".....) di dalam index.php
        $file = $this->request->getFile('excel');
        $ext = $file->getExtension();
        if ($ext === "xls" || $ext === "xlsx") {
            $this->rhModel->kosongkan();
            if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
            else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
            $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
            $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
           
            foreach ($sheet as $index=>$item) {
                if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
                //  Jika semua kolom kosong berhenti
                    if ($item[0] == "" &&
                        $item[1] == "" &&
                        $item[2] == "" &&
                        $item[3] == "" &&
                        $item[4] == "" &&
                        $item[5] == "" &&
                        $item[6] == "" &&
                        $item[7] == "" &&
                        $item[8] == "" &&
                        $item[9] == "" &&
                        $item[10] == "" &&
                        $item[11] == "" &&
                        $item[12] == "" &&
                        $item[13] == "" &&
                        $item[14] == "" &&
                        $item[15] == "" &&
                        $item[16] == "" &&
                        $item[17] == "" &&
                        $item[18] == "" &&
                        $item[19] == "" &&
                        $item[20] == "" &&
                        $item[21] == "" &&
                        $item[22] == "" &&
                        $item[23] == "" &&
                        $item[24] == "" &&
                        $item[25] == "" &&
                        $item[26] == "" &&
                        $item[27] == "" &&
                        $item[28] == "" &&
                        $item[29] == "" &&
                        $item[30] == "" &&
                        $item[31] == "" &&
                        $item[32] == "" &&
                        $item[33] == ""
                    ) {
                        break;       
                    }

                    if ($item[0] == "" || $item[1] == "" || $item[2] == "" || $item[3] == "" || $item[4] == "") {
                        continue;       
                     }
                     if ($item[0] != "" && $item[1] != "" && $item[2] != "" && $item[3] != "" && $item[4] != "") {
                        $data =
                           [  
                            'id'=>$item[0],         //      kolom A
                            'kode_ta'=>$item[1],    //      kolom B
                            'nama'=>$item[2],       //      kolom C
                            'alamat'=>$item[3],
                            'kota'=>$item[4],
                            'tgl'=>$item[5],
                            'usia'=>$item[6],
                            'no_ktp'=>$item[7],
                            'no_npwp'=>$item[8],
                            'no_telp'=>$item[9],
                            'no_hp'=>$item[10],
                            'email'=>$item[11],
                            'posisi'=>$item[12],
                            'perusahaan'=>$item[13],
                            'kategori'=>$item[14],
                            'created_at'=>$item[15],
                            'updated_at'=>$item[16],
                            'ijazahS1'=>$item[17],
                            's1_univ'=>$item[18],
                            's1_thn'=>$item[19],
                            'ijazahS2'=>$item[20],
                            's2_univ'=>$item[21],
                            's2_thn'=>$item[22],
                            'ijazahS3'=>$item[23],
                            's3_univ'=>$item[24],
                            's3_thn'=>$item[25],
                            'sipp'=>$item[26],
                            'sipp_ed'=>$item[27],
                            'str'=>$item[28],
                            'str_ed'=>$item[29],
                            'kta'=>$item[30],
                            'kta_ed'=>$item[31],
                            'asosiasi'=>$item[32], 
                            'ref'=>$item[33],
                           // 'status'=>$item[34]
                            ];      
                            $this->rhModel->insert($data);  // mulai baris 1 dan seterusnya 
                     } 

            }
            session()->setFlashdata('import','Data berhasil di-impor'); 
        }
        else {
            session()->setFlashdata('error','Bukan format file excel'); 
        }
        return redirect()->to('/');
    }
}
?>