<?php
namespace App\Models;

use CodeIgniter\Model;

class bhsModel extends Model
{
    protected $table            = 'tb_bahasa';   
    protected $primaryKey       = 'id_bahasa';
    protected $returnType       = 'object';
    protected $allowedFields    = ['bahasa','nilai','kode_ta'];
 
    public function getBahasa() {
       return $this->findAll();
   }

   public function getLaporan($id=false) {
    return $this->where(['kode_ta'=>$id])->findAll();
    }
   public function getJoin() {       
    $this->table('tb_bahasa')->join('tb_ta', 'tb_bahasa.kode_ta = tb_ta.id');
    return $this->findAll();
}

}
?>