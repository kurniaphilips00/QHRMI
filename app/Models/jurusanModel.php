<?php
namespace App\Models;
use CodeIgniter\Model;

class jurusanModel extends Model
{
    protected $table            = 'tb_jurusan';   
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['jurusan'];
    public function getJurusan() {
       return $this->findAll();
   }
}
?>