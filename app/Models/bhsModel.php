<?php
namespace App\Models;

use CodeIgniter\Model;

class bhsModel extends Model
{
    protected $table            = 'tb_bahasa';   
    protected $primaryKey       = 'id_bahasa';
    protected $allowedFields    = [
        'kode_bhs','nilai_bhs_indo','nilai_bhs_inggris','nilai_bhs_setempat','kode_ta','nama_ta'
    ];
 
    public function getBahasa($kode=false) {
        
        if ($kode==false) {
            return $this->findAll();
        }
        return $this->where(['kode_bhs'=>$kode])->first();
    }

    public function getLaporanCV($kodeTA=false) {
        $ResponseData="";
         $this->where(['kode_ta'=>$kodeTA])->findAll();
               
            $query = $this->get();
            if($query->getResultArray()){
                
                $ResponseData=$query->getResultArray();
            }
            
            return $ResponseData;
/*
        if ($kodeTA==false) {
            return $this->findAll();
        }
       
        return $this->where(['kode_ta'=>$kodeTA])->findAll();*/
    }
    public function getJoin() {       
        $this->table('tb_bahasa')->join('tb_ta', 'tb_bahasa.kode_ta = tb_ta.id');
        return $this->findAll();
    }
    public function getFilterByName($nama) {
        $query = $this->db->query("SELECT * FROM tb_bahasa WHERE nama_ta = '$nama' ORDER BY nama ASC");
        return $query->getResultObject();    //  Hasil berupa array
    }

}
?>