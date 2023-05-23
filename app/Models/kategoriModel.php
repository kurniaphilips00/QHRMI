<?php
namespace App\Models;
use CodeIgniter\Model;

class kategoriModel extends Model
{
    protected $table            = 'tb_kategori';   
    protected $primaryKey       = 'id';
   
    protected $allowedFields    = ['id','kategori'];
    public function getKategori($id=false) {
        if ($id==false) {
            return $this->findAll();
       }
       return $this->where(['id'=>$id])->first();
   }
}
?>