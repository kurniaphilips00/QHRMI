<?php
namespace App\Models;

use CodeIgniter\Model;

class jurusanModel extends Model
{
    protected $table            = 'tb_jurusan';   
    protected $primaryKey       = 'id';
    protected $allowedFields    = [ 'kode_jurusan', 'jurusan' ];
 
    public function getJurusan($kode=false) {
        
        if ($kode==false) {
            return $this->findAll();
        }
        return $this->where(['kode_jurusan'=>$kode])->first();
    }
}
?>