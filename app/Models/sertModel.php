<?php
namespace App\Models;

use CodeIgniter\Model;

class sertModel extends Model
{
    protected $table            = 'tb_sertifikat';   
    protected $primaryKey       = 'id_sert';
   // protected $returnType       = 'object';
    protected $allowedFields    = ['kode_sert','nomor_sert','sertifikat','kode_ta','nama_ta','tgl_kadaluarsa'];
 
   public function getSertifikat($id=false) {
    //dd($id);
    if ($id==false) {
         return $this->findAll();
    }
    return $this->where(['id_sert'=>$id])->first();
    }

public function getLaporanCV($id=false) {
    return $this->where(['kode_ta'=>$id])->findAll();
}

//  Untuk menyambung ke tabel tenaga ahli
   public function getJoin() {   
    //  Untuk menampilkan nama tenaga ahli yang diambil dari tabel tenaga ahli    
        $this->table('tb_sertifikat')->join('tb_ta', 'tb_sertifikat.kode_ta = tb_ta.id');
        return $this->findAll();
    }
    public function getFilterByName($nama) {
        $query = $this->db->query("SELECT * FROM tb_exp WHERE nama_ta = '$nama' ORDER BY nama_ta ASC");
        return $query->getResultObject();    //  Hasil berupa array
    }
}
?>