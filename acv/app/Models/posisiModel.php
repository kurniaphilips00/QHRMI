<?php
namespace App\Models;
use CodeIgniter\Model;

class posisiModel extends Model
{
    protected $table            = 'tb_posisi';   
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['posisi'];
    public function getPosisi() {
       return $this->findAll();
   }
}
?>