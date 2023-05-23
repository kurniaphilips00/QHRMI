<?php
namespace App\Models;
use CodeIgniter\Model;

class ijinModel extends Model
{
    protected $table            = 'tb_ijin';   
    protected $primaryKey       = 'id';
    //protected $returnType       = 'object';
    protected $allowedFields    = ['namafile', 'jenis', 'nomor', 'instansi', 'kualifikasi', 'tglkadaluarsa'];
    
    public function getIjin($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
}
?>