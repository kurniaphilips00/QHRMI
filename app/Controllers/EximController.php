<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\proyekModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EximController extends BaseController
{
    protected $expModel;
    protected $base;
    public function __construct()
    {
        $rh = $this->expModel = new proyekModel();     
    }

    public function exportExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Instansi');
        $sheet->setCellValue('C1', 'Pekerjaan');
        $sheet->setCellValue('D1', 'Tahun');
        $sheet->setCellValue('E1', 'Lokasi');
        $sheet->setCellValue('F1', 'Alamat');
        $sheet->setCellValue('G1', 'No. Kontrak');
        $sheet->setCellValue('H1', 'Mulai');
        $sheet->setCellValue('I1', 'Selesai');
        $sheet->setCellValue('J1', 'Nilai');
        $sheet->setCellValue('K1', 'Referensi');
        $sheet->setCellValue('L1', 'Jumlah Bulan');
        $sheet->setCellValue('M1', 'Intermitten');
        $sheet->setCellValue('N1', 'PDF Referensi');
        
        $row = 2;   // row 1 dipakai untuk header (judul-judul kolom di atas)
        $exp = $this->expModel->getProyek();//Pengalaman diambilkan dari tabel proyek
        foreach ($exp as $v => $item) {
              
            $sheet->setCellValue('A'.$row, $item['id'])
            ->setCellValue('B'.$row, $item['instansi'])
            ->setCellValue('C'.$row, $item['pekerjaan'])
            ->setCellValue('D'.$row, $item['tahun'])
            ->setCellValue('E'.$row, $item['lokasi'])
            ->setCellValue('F'.$row, $item['alamat'])
            ->setCellValue('G'.$row, $item['nokontrak'])
            ->setCellValue('H'.$row, $item['mulai'])
            ->setCellValue('I'.$row, $item['selesai'])
            ->setCellValue('J'.$row, $item['nilai'])
            ->setCellValue('K'.$row, $item['referensi'])
            ->setCellValue('L'.$row, $item['jml_bln'])
            ->setCellValue('M'.$row, $item['inter'])
            ->setCellValue('N'.$row, $item['refpdf']);
            $row++;
        }
  
        $filename = "pengalaman";
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$filename.'.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function importExcel() {//importExcel
        $spreadsheet = new Spreadsheet();
        //  Ambil file dari name (input type="file".... name="excel".....) di dalam index.php
        $file = $this->request->getFile('excel');
        $ext = $file->getExtension();
        $this->expModel->kosongkan();
        if ($ext === "xls" || $ext === "xlsx") {
            $this->expModel->kosongkan();
            if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
            else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
            $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
            $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
            foreach ($sheet as $index=>$item) {
                if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
             
                if ($item[0] == "") {
                    break;       
                 }
                 if ($item[7]!="" && $item[8]!="") {
                    //  Memanggil fungsi dari Base.php untuk menghitung intermitten
                    $this->base = new Base();
                    $inter = $this->base->hitung_intermitten($item[7], $item[8]); 
                    $jml_bln = $this->base->hitung_bulan($item[7], $item[8]);
                 }
                 else {
                    $inter = "";
                    $jml_bln = 0;
                 }
                 
                    $data =
                       [  
                            'id'=>$item[0],          //      kolom A
                            'kode_proyek'=>$item[1],
                            'instansi'=>$item[2],    //      kolom B
                            'pekerjaan'=>$item[3],   //      kolom C
                            'tahun'=>$item[4],      //      kolom D
                            'lokasi'=>$item[5],      //      kolom E
                            'alamat'=>$item[6],     //      kolom F
                            'nokontrak'=>$item[7],  //      kolom G
                            'mulai'=>$item[8],      //      kolom H
                            'selesai'=>$item[9],    //      kolom I
                            'nilai'=>$item[10],      //      kolom J
                            'referensi'=>$item[11],  //      kolom K
                            'jml_bln'=>$jml_bln,    //      kolom L
                            'inter'=>$inter,     //      kolom M
                            'refpdf'=>$item[14]     //      kolom N
                        ];
                    
                     $this->expModel->insert($data);  // mulai baris 1 dan seterusnya
                     
            }
            session()->setFlashdata('import','Data berhasil di-impor'); 
        }
        else {
            session()->setFlashdata('error','Bukan format file excel'); 
        }
        return redirect()->to('/pengalaman/');
    }
}
?>