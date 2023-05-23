<?php

namespace App\Controllers;
use App\Models\posisiModel;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PosisiController extends BaseController
{
    protected $posisiModel;
    public function __construct()
    {         
        $posisi = $this->posisiModel = new posisiModel();     
    }
    
    public function index()
    {
        $posisi = $this->posisiModel->getPosisi();
        $data = [            
            'posisi' => $posisi, 'judul' => 'Data Posisi',
        ];
        return view ('posisi/index', $data);
    }
    public function baca($id)
    {
        $posisi = $this->posisiModel->getPosisi($id);
        $data = [
            'judul' => 'Baca Data Posisi',
            'posisi' => $posisi];
        return view('posisi/baca', $data);
    }
    public function edit($id) {
        $posisi = $this->posisiModel->getPosisi($id);
        $data = [
            'judul' => 'Edit Data Posisi',
            'posisi' => $posisi
        ];
        return view('posisi/edit', $data);
    }
    public function update($id) {
        $this->posisiModel->save([  
            'id' => $id,
            'posisi'=>esc($this->request->getPost('posisi')),
            'uraiantugas' =>esc($this->request->getPost('editor1')) 
        ]);
        return redirect()->to(base_url('/posisi'))->with('sukses-update-posisi', 'Posisi berhasil diupdate');
    }
    public function tambah() {
        $posisi = $this->posisiModel->getPosisi();
        $data = [
            'judul' => 'Tambah Data Posisi',
            'posisi' => $posisi, 
            'validation' => \Config\Services::validation()
        ];
        return view('posisi/tambah', $data);
    }
    public function simpan() {
        //dd($this->request->getPost('editor1'));
        $rules = $this->validate([
            'posisi'      => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Posisi harus diisi.',
                ],
            ],
        ]);
        if (!$rules) {
            session()->setFlashdata('gagal-menambah-posisi','Tambah data posisi gagal !!!');
            return redirect()->back()->withInput();
        } 
        $this->posisiModel->save([  
                'posisi'=>esc($this->request->getPost('posisi')),   
                'uraiantugas'=>esc($this->request->getPost('editor1')), 
        ]);
        return redirect()->to(base_url('/posisi/tambah'))->with('sukses-tambah-posisi', 'Posisi berhasil disimpan');
    }
    public function delete($id) {
        $this->posisiModel->delete($id);
        session()->setFlashdata('del-success','Data posisi berhasil dihapus');
        return redirect()->to('/posisi');
    }
    public function importExcel() {
        $spreadsheet = new Spreadsheet();
        //  Ambil file dari name (input type="file".... name="excel".....) di dalam index.php
        $file = $this->request->getFile('excel');
        $ext = $file->getExtension();
        $this->posisiModel->kosongkan();
        if ($ext === "xls" || $ext === "xlsx") {
            $this->posisiModel->kosongkan();
            if ($ext === "xls") $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();    //  Jika ekstensinya xls
            else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //  Jika ekstensinya xlsx
            $spread = $reader->load($file);//   Muat ke reader, tampung ke variabel $spread
            $sheet = $spread->getActiveSheet()->toArray();//    Membaca sheet aktif dan menampung ke array
            foreach ($sheet as $index=>$item) {
                if ($index == 0) continue; // Baris ke 0 berisi header(judul), bukan data, jadi diabaikan
             
                if ($item[0] == "") {
                    break;       
                 }
               
                 
                    $data =
                       [  
                            'id'=>$item[0],          //      kolom A
                            'kode_posisi'=>$item[1],    //      kolom B
                            'posisi'=>$item[2],   //      kolom C
                           // 'uraiantugas'=>$item[3],      //      kolom D
                            
                            
                        ];
                    
                     $this->posisiModel->insert($data);  // mulai baris 1 dan seterusnya
                     
            }
            session()->setFlashdata('import','Data berhasil di-impor'); 
        }
        else {
            session()->setFlashdata('error','Bukan format file excel'); 
        }
        return redirect()->to('/pengalaman/');
    }
}
