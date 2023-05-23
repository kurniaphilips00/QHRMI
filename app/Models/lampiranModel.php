<?php
namespace App\Models;
use CodeIgniter\Model;

class lampiranModel extends Model
{
    protected $table            = 'tb_lampiran';   
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['namafile', 'ukuran', 'lampiran', 'path', 'kode_ta', 'nama_ta'];
    
    public function getLampiran($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();       
   }
   public function getFilterByName($nama) {
        $query = $this->db->query("SELECT * FROM tb_lampiran WHERE nama_ta = '$nama' ORDER BY nama_ta ASC");
        return $query->getResultArray();    //  Hasil berupa array
    }
}
?>