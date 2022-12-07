<?php
namespace App\Models;

use CodeIgniter\Model;

class sertModel extends Model
{
    protected $table            = 'tb_sertifikat';   
    protected $primaryKey       = 'id_sert';
    protected $returnType       = 'object';
    protected $allowedFields    = ['sertifikat','kode_ta'];
 
   public function getSertifikat($id=false) {
    //dd($id);
    if ($id==false) {
         return $this->findAll();
    }
   //dd($this->where(['id_sert'=>$id])->first());
    return $this->where(['id_sert'=>$id])->first();
}

public function getLaporan($id=false) {

    return $this->where(['kode_ta'=>$id])->findAll();
}

   public function getJoin() {       
        $this->table('tb_sertifikat')->join('tb_ta', 'tb_sertifikat.kode_ta = tb_ta.id');
    // dd( $this->findAll());
        return $this->findAll();
    }
   
}
?>