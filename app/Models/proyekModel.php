<?php
namespace App\Models;

use CodeIgniter\Model;

class proyekModel extends Model
{
    protected $table = 'tb_proyek';   
    protected $allowedFields = 
    ['id','kode_proyek','instansi','pekerjaan', 
    'ruang_lingkup','lokasi','alamat',
    'nokontrak','mulai','selesai','nilai', 'tahun',
    'referensi','refpdf','jml_bln','inter'];
    public function getProyek($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    } 
    public function getProyekOrderByKode() {
        return $this->orderBy('kode_proyek', 'ASC')->findAll();
    } 
    public function kosongkan() {
        return $this->db->query('TRUNCATE tb_proyek');
    }
    public function getProyekOrderByID() {
        return $this->db->table('tb_proyek')
        ->select('id, pekerjaan, tahun, instansi' )
        ->orderBy('id', 'ASC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
        ->get()->getResultArray();
    }
    public function getProyekOrderByProyek() {
        return $this->db->table('tb_proyek')
        ->select('id, pekerjaan')
        ->orderBy('pekerjaan', 'ASC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
        ->get()->getResultArray();
    }
    public function getProyekFilteredByName($n=false) {
        return $this->db->table('CV')
        ->where(['nama_TA'=>$n])
        //->orderBy('tahun', 'DESC') 
        ->get()->getResultArray();
    }
    function save_multiple($items = array())
    {
        $this->db->table('tb_proyek')->insertBatch($items);
        return $this->db->affectedRows();
    }
}
?>