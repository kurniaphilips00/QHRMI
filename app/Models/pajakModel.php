<?php
namespace App\Models;
use CodeIgniter\Model;

class pajakModel extends Model
{
    protected $table            = 'tb_pajak';   
    protected $primaryKey       = 'id';
    //protected $returnType       = 'object';
    protected $allowedFields    = ['namafile', 'jenis', 'nomor', 'tglterbit'];
    
    public function getPajak($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
}
?>