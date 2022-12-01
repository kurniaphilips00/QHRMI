<?php

namespace App\Controllers\Admin;
use App\Models\rhModel;
use App\Models\bhsModel;
use App\Controllers\BaseController;


class BahasaController extends BaseController
{
    public function __construct()
    {
        
        $ta = $this->rhModel = new rhModel();    
        $bhs = $this->bhsModel = new bhsModel();   
    }
    public function index() {
        $ta = $this->rhModel->getCV();  
        $bhs = $this->bhsModel->getJoin();
        $data = [            
            'ta' => $ta, 
            'bhs' => $bhs
        ];
        //dd($data);
        return view ('admin/bahasa/index', $data);
    }
    public function tambah_bahasa() {
        //dd($_POST);
        $data = [
                'kode_ta' =>esc($this->request->getPost('kode_ta')),
                
                'bahasa' =>esc($this->request->getPost('bahasa')),
                'nilai' =>esc($this->request->getPost('nilai')) 
        ];
        $this->bhsModel->insert($data);
        return redirect()->back()->with('sukses','Data bahasa berhasil ditambah');
    }
    public function update_bahasa($id) {
        // dd($_POST);
        $data = [
            'bahasa'=>esc($this->request->getPost('bahasa')),
            'nilai'=>esc($this->request->getPost('nilai')) 
                ];
               // dd($data);
        $this->bhsModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data bahasa berhasil diubah');
    }
  
    public function  delete_bahasa($id) {
        //dd($id);
        $this->bhsModel->delete($id);
        session()->setFlashdata('success','Data bahasa berhasil dihapus');
        return redirect()->to('bahasa');
    }
}