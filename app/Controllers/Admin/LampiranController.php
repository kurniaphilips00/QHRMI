<?php

namespace App\Controllers\Admin;
use App\Models\rhModel;
use App\Models\lampiranModel;
use App\Controllers\BaseController;

class LampiranController extends BaseController
{
    public function __construct()
    {
        $ta = $this->rhModel = new rhModel();    
    }
    public function index()
    {                
        $lamp = $this->rhModel->getCV();
        $data = [            
            'lamp' => $lamp
        ];
        return view('admin/lampiran/index', $data);
    }
/*  
    Ini versi lampiran di Dashboard
    public function lampiran()        
        $ta = $this->rhModel->getCV();
        $data = [          
            'cv' => $ta,   
        ];
        return view ('admin/lampiran', $data);
    }
*/
    public function tambah_ktp() {
        $ta = $this->rhModel->getCV();
       $data = [ 
           'title' => 'Tambah Data',     
           'ta' => $ta,            
           'validation' => \Config\Services::validation()
       ];              
       return view('admin/lampiran/create', $data);
    }

    public function simpan_ktp($id)
    {      
        /*dd($this->request->getVar());  
          if (!$this-> validate([
            
              'perusahaan' => [
                  'rules' => 'required',
                  'errors' => ['{field} harus diisi']
              ]      
              ,
              'personil' => [
                  'rules' => 'required',
                  'errors' => ['{field} harus diisi']
              ]                           
          ])
          ) {
              $validation = \Config\Services::validation();
              return redirect()->to('/tambah-CV')->withInput()->with('validation', $validation);
          }        
         */
         
         $ktp = $this->request->getFile('ktp');
         if ($ktp->getError()===4) {
             $namagbrktp = 'placeholder.png';
         }
         else {
             $namagbrktp = $ktp->getName();
             $ktp -> move (WRITEPATH. '../public/img', $namagbrktp);
         }
        
         $this->rhModel->save([   //  update data ktp 
            'id' => $id,
            'fktp' => $namagbrktp          
          ]);
          
         session()->setFlashdata('tambah','Data lampiran berhasil ditambah');
         //   Kembali ke dashboard admin
         return redirect()->to('/lampiran');          
    }

    public function simpan_foto()
    {      
        /*dd($this->request->getVar());  
          if (!$this-> validate([
            
              'perusahaan' => [
                  'rules' => 'required',
                  'errors' => ['{field} harus diisi']
              ]      
              ,
              'personil' => [
                  'rules' => 'required',
                  'errors' => ['{field} harus diisi']
              ]                           
          ])
          ) {
              $validation = \Config\Services::validation();
              return redirect()->to('/tambah-CV')->withInput()->with('validation', $validation);
          }        
         */
       
         $foto = $this->request->getFile('pasfoto');
         dd($foto);
         $namagbrfoto = $foto->getName();
         $foto -> move (WRITEPATH. '../public/img', $namagbrfoto);      
         session()->setFlashdata('tambah','Data lampiran foto berhasil ditambah');
         //   Kembali ke dashboard admin
         return redirect()->to('/lampiran');          
    }
    public function update_lampiran($id) {
        $data = [
            'kode_ta'=>esc($this->request->getPost('id')),
            'lampiran'=>esc($this->request->getPost('lampiran')) 
                ];
               // dd($data);
        $this->lampiranModel->update($id,$data);
        return redirect()->back()->with('berhasil','Data lampiran berhasil diubah');
    }
    public function delete_lampiran($id) {
        $this->lampiranModel->delete($id);
        session()->setFlashdata('success','Data berhasil dihapus');
        return redirect()->to('lampiran');
    }
}