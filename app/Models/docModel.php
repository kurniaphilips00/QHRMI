<?php
namespace App\Models;
use CodeIgniter\Model;

class docModel extends Model
{
    protected $table            = 'tb_dokumen';   
    protected $primaryKey       = 'id';
    //protected $returnType       = 'object';
    protected $allowedFields    = ['namafile', 'dokumen', 'nomor', 'notaris', 'tanggal'];
    
    public function getDoc($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
}
?>