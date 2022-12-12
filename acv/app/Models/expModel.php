<?php
namespace App\Models;

use CodeIgniter\Model;

class expModel extends Model

{
    protected $table            = 'tb_exp';   
    protected $primaryKey       = 'id_exp';
 //   protected $returnType       = 'object'; > Tidak bisa ditampilkan di dompdf jika memakai ODER BY tahun
    protected $allowedFields    = ['kode_ta','nama_ta','kegiatan','lokasi','pengguna','pers','referensi','statuse','tahun','uraian','posisitugas',
                                    'mulai','selesai','jml_bln','inter'];

    public function getJoin() {       
        $this->table('tb_exp')->join('tb_ta', 'tb_exp.kode_ta = tb_ta.id');
       // dd( $this->findAll());
        return $this->findAll();
    }

    public function getExp($id=false) {
       // dd($id);
       if ($id==false) {
            return $this->findAll();
       }
      // dd($this->where(['id_exp'=>$id])->first());
       return $this->where(['id_exp'=>$id])->first();
   }

    public function getLaporan($id=false) {
        return $this->db->table('tb_exp')
        ->select('kode_ta,nama_ta,kegiatan,lokasi,pengguna,pers,referensi,statuse,tahun,uraian,posisitugas,mulai,selesai,jml_bln,inter')
        ->where(['kode_ta'=>$id])
        ->orderBy('tahun', 'DESC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
        ->get()->getResultArray();
    }

    public function getFilterByName($nama) {
            $query = $this->db->query("SELECT * FROM tb_exp WHERE nama_ta = '$nama' ORDER BY tahun DESC");
            return $query->getResultArray();    //  Hasil berupa array
    }

}
?>