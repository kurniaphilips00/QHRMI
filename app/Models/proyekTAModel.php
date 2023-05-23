<?php
namespace App\Models;
use CodeIgniter\Model;

class proyekTAModel extends Model
{
    protected $table            = 'tb_proyek_ta';   
    //protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'kode_pengalaman','kode_proyek','kode_TA','kode_posisi'
        ];
    
    public function getTAProyek($kode=false) {
        if ($kode==false) {
            return $this->findAll();
        }
        return $this->where(['kode_pengalaman'=>$kode])->first();
    }
    public function getTAProyekByID($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
    public function getPengalaman($kode) {
        return $this->db->table('view_intermitten')
        ->where(['kode_TA'=>$kode])
        ->get()->getResultArray();
        }
    public function getPengalamanOrderByKode() {
        return $this->db->table('tb_proyek_ta')
        ->orderBy('kode_pengalaman', 'ASC') 
        ->get()->getResultArray();
    }
    public function kosongkan() {
        return $this->db->query('TRUNCATE tb_proyek_ta');
    }
 
    public function getFilterIDTA($id) {
        $ResponseData="";
        $this->like('id_TA', $id);         
        $this->orderBy("nama_pekerjaan", "ASC");
        $query = $this->get();
        if($query->getResultArray()){
            $ResponseData=$query->getResultArray();
        }
        return $ResponseData;
    }
    
    public function getFilterIDProyek($id) {
        $ResponseData="";
        $this->like('id_exp', $id);         
        $this->orderBy("nama_TA", "ASC");
        $query = $this->get();
        if($query->getResultArray()){
            $ResponseData=$query->getResultArray();
        }
        return $ResponseData;
    }
    
    public function getFilterNamaProyek($n) {
        $ResponseData="";
        $this->like('nama_pekerjaan', $n);         
        $this->orderBy("nama_TA", "ASC");
        $query = $this->get();
        if($query->getResultArray()){
            $ResponseData=$query->getResultArray();
        }
        return $ResponseData;
    }
    public function getFilterNamaTA($n) {
        $ResponseData="";
        $this->like('nama_TA', $n);         
        $this->orderBy("nama_pekerjaan", "ASC");
        $query = $this->get();
        if($query->getResultArray()){
            $ResponseData=$query->getResultArray();
        }
        return $ResponseData;
    }
    public function getFilterByProyek($proyek) {
        $ResponseData="";
        $this->like('id_exp', $proyek);         
        $this->orderBy("nama_TA", "ASC");
        $query = $this->get();
        if($query->getResultObject()){
            $ResponseData=$query->getResultObject();
        }
        return $ResponseData;
    }
    public function getViewPengalaman() {
        return $this->db->table('view_pengalaman')
        ->orderBy('kode_pengalaman', 'ASC') 
        ->get()->getResultArray();
    }
    public function getViewCV($kode) {
        return $this->db->table('view_cv')
        ->where(['kode_TA'=>$kode])
        ->orderBy('tahun', 'DESC') 
        ->get()->getResultArray();
    }
    public function getIntermitten($kode) {
        return $this->db->table('view_intermitten')
        ->where(['kode_TA'=>$kode])
        ->orderBy('tahun', 'DESC') 
        ->get()->getResultArray();
    }

    function tampilData($key = null, $start = 0, $length = 0) {
        $qry = $this->table('view_pengalaman');
        if ($key) {
            $arr = explode(" ", $key);
            for ($i = 0; $i < count($arr); $i++) {
                $qry = $qry->orlike('nama', $arr[$i]);
            }
        }
        if ($start != 0 or $length != 0) {
            $qry = $qry->limit($length, $start);
        }
        return $qry->orderBy('kode_TA','asc')->get()->getResult();
    }
   
}
?>