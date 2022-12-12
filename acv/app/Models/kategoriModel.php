<?php
namespace App\Models;
use CodeIgniter\Model;

class kategoriModel extends Model
{
    protected $table            = 'tb_kategori';   
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['kategori'];
    public function getKategori() {
       return $this->findAll();
   }
}
?>