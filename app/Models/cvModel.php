<?php
namespace App\Models;

use CodeIgniter\Model;

class cvModel extends Model
{
    protected $table            = 'tb_ta';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama','posisi','perusahaan','ttl','no_npwp','no_telp','no_hp','ijazahS1','s1_univ','s1_thn',
    'ijazahS2','s2_univ','s2_thn','ijazahS3','s3_univ','s3_thn','no_ktp', 'sipp','sipp_ed','str','str_ed','kta','kta_ed','alamat','email',
    'kategori','kota','pasfoto', 'fktp','fnpwp','fsipp','fstr','fkta'];

    public function getPengalaman($id) {
        $query = $this->db->query("SELECT * FROM tb_exp WHERE kode_ta = '$id' ORDER BY tahun DESC");
        return $query->getResultArray();    //  Hasil berupa array
    //    return $query->getResult();     //  hasil berupa object
    }

    public function getSertifikat($id) {
         $query = $this->db->query("SELECT * FROM tb_sertifikat WHERE kode_ta = '$id'");
         return $query->getResultArray();    //  Hasil berupa array
     //    return $query->getResult();     //  hasil berupa object
     }

     public function getBahasa($id) {
        $query = $this->db->query("SELECT * FROM tb_bahasa WHERE kode_ta = '$id'");
        return $query->getResultArray();    //  Hasil berupa array
    //    return $query->getResult();     //  hasil berupa object
    }
    public function getCV($id=false) {
       
        if ($id==false) {
            return $this->orderBy('nama', 'ASC')->findAll();
        }
        return $this->where(['id'=>$id])->first();
    } 
    public function tambahCV($data) {
        
        return $this->db->table('tb_ta')->insert($data);
    } 
}
?>