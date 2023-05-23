<?php
namespace App\Models;
use CodeIgniter\Model;

class posisiModel extends Model
{
    protected $table            = 'tb_posisi';   
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode_posisi','posisitugas','uraiantugas'];
 
    public function getPosisi($id=false) {
    if ($id==false) {
         return $this->findAll();
    }
    return $this->where(['id'=>$id])->first();
    }
    
    public function getPosisiByKode($kode=false) {
        if ($kode==false) {
             return $this->findAll();
        }
        return $this->where(['kode_posisi'=>$kode])->first();
        }

    public function kosongkan() {
        return $this->db->query('TRUNCATE tb_posisi');
    }
    public function tampil($key = null, $start = 0, $length = 0) {
        $builder = $this->table('tb_posisi');
        if ($key) {
            $arr = explode(" ", $key);
            for ($i=0; $i < count($arr); $i++) {
                $builder = $builder->orlike('id', $arr[$i]);
                $builder = $builder->orlike('kode_posisi', $arr[$i]);
                $builder = $builder->orlike('posisitugas', $arr[$i]);
            }
        }

        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }
        return $builder->orderBy('posisitugas', 'asc')->get()->getResult();
    }
}
?>