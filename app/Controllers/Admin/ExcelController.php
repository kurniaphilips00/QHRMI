<?php
namespace App\Controllers\Admin;
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
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Alamat');
        $sheet->setCellValue('D1', 'Kota');
        $sheet->setCellValue('E1', 'Tgl. lahir');
        $sheet->setCellValue('F1', 'Usia');
        $sheet->setCellValue('G1', 'No. ktp');
        $sheet->setCellValue('H1', 'No. npwp');
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
        $sheet->setCellValue('Z1', 'KTA');
        $sheet->setCellValue('AA1', 'KTA e.d.');
        $sheet->setCellValue('AB1', 'Asosiasi');
       
    
        $row = 2;
        $cv = $this->rhModel->getCV();
        foreach ($cv as $v => $item) {
            $sheet->setCellValue('A'.$row, $v+1)
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
            ->setCellValue('Z'.$row, $item['kta'])
            ->setCellValue('Z'.$row, $item['kta'])
            ->setCellValue('Z'.$row, $item['kta'])
            ->setCellValue('AA'.$row, $item['kta_ed'])
            ->setCellValue('AB'.$row, $item['asosiasi']);
            $row++;
        }
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
            if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
            else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
            $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
            $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
            // dd($sheet);
        
            foreach ($sheet as $index=>$item) {
                if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
             
                    $data =
                       [  //baris 1 dst.
                        // 'id'=>$item[0],
                            'nama'=>$item[1],//kolom1
                            'alamat'=>$item[2],
                            'kota'=>$item[3],
                            'tgl'=>$item[4],
                            'usia'=>$item[5],
                            'no_ktp'=>$item[6],
                            'no_npwp'=>$item[7],
                            'no_telp'=>$item[8],
                            'no_hp'=>$item[9],
                            'email'=>$item[10],
                            'posisi'=>$item[11],
                            'perusahaan'=>$item[12],
                            'kategori'=>$item[13],
                            'ijazahS1'=>$item[14],
                            's1_univ'=>$item[15],
                            's1_thn'=>$item[16],
                            'ijazahS2'=>$item[17],
                            's2_univ'=>$item[18],
                            's2_thn'=>$item[19],
                            'ijazahS3'=>$item[20],
                            's3_univ'=>$item[21],
                            's3_thn'=>$item[22],
                            'sipp'=>$item[23],
                            'sipp_ed'=>$item[24],
                            'kta'=>$item[25],
                            'kta_ed'=>$item[26],
                            'asosiasi'=>$item[27]              
                        ];
                    
                     $this->rhModel->insert($data);
            }
            session()->setFlashdata('import','Data berhasil di-impor'); 
        }
        else {
            session()->setFlashdata('error','Bukan format file excel'); 
        }
        return redirect()->to('/admin');
    }
}
?>