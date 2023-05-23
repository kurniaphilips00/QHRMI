<?php
namespace App\Models;

use CodeIgniter\Model;

class expExpertsModel extends Model

{
    protected $table            = 'tb_proyek_ta';   
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id', 'kode_pengalaman','kode_proyek','kode_TA','kode_posisi'
        ];

    public function getExperts($id=false) {
       if ($id==false) {
            return $this->db->table('tb_proyek_ta')
            ->select('id, kode_pengalaman, kode_proyek, kode_TA, kode_posisi')
            ->orderBy('kode_pengalaman', 'ASC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
            ->get()->getResultArray();
       }
       return $this->where(['id'=>$id])->first();
   }
   public function getFilterByName($nama) {
    return $this->db->table('tb_proyek_ta')
    ->where(['nama_TA'=>$nama])
    ->get()->getResultArray();
    }

   

    public function getFilterByExp($e_id) {
        return $this->db->table('tb_proyek_ta')
        ->where(['id_exp'=>$e_id])
        ->get()->getResultArray();
        }

    public function getLaporan($id=false) {
       // dd($id);
       //     return $this->db->table('vLaporan')
       return $this->db->table('tb_proyek_ta')
       ->join('tb_proyek', 'tb_proyek_ta.id_exp = tb_proyek.id_exp')
         //   ->orderBy('tahun', 'DESC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
        ->where(['id_TA'=>$id])
        ->get()->getResultArray();
    }
    public function getViewPengalaman() {
        return $this->db->table('view_pengalaman')
        ->orderBy('kode_pengalaman', 'ASC') 
        ->get()->getResultArray();
    }
    public function getViewOfCV($id=false) {
        return $this->db->table('CV')
        ->where(['id_TA'=>$id])
        ->orderBy('tahun', 'DESC') 
        ->get()->getResultArray();
    }
//Filter dari tabel proyek (pengalaman/pekerjaan)
    public function getTenagaAhli($id=false) {
        return $this->db->table('CV')
        ->where(['id_exp'=>$id])
        ->orderBy('tahun', 'DESC') 
        ->get()->getResultArray();
    }
}
?>