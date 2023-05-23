<?php
namespace App\Models;

use CodeIgniter\Model;

class rhModel extends Model
{
    protected $table            = 'tb_ta';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    
    protected $allowedFields    = ['id','kode_ta', 'nama','alamat','kota','tgl','usia','no_ktp','no_npwp',
    'no_telp','no_hp','email','posisi',
    'perusahaan','kategori','created_at','updated_at','ijazahS1','s1_univ','s1_thn',
    'ijazahS2','s2_univ','s2_thn','ijazahS3','s3_univ','s3_thn','sipp','sipp_ed','str','str_ed',
    'kta','kta_ed','asosiasi',
    'ref','status'];

    public function getCV($id=false) {
        if ($id==false) {
            return $this->orderBy('nama', 'ASC')->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
    public function getCVwithKode($kode=false) {
        if ($kode==false) {
            return $this->orderBy('kode_ta', 'ASC')->findAll();
        }
        return $this->where(['kode_ta'=> $kode])->first();
    } 
    public function kosongkan() {
        return $this->db->query('TRUNCATE tb_ta');
    }
    public function hitung() {
        return $this->db->query('SELECT COUNT(*) FROM tb_ta');
    }
    public function getTAOrderByID() {
            return $this->orderBy('id', 'ASC')->findAll();
    } 
    public function getTAOrderByKode() {
        return $this->orderBy('kode_ta', 'ASC')->findAll();
    } 
    public function getTAOrderByName() {
        return $this->orderBy('nama', 'ASC')->findAll();
    } 
    public function getTAGroupByPosisi() {
        return $this->groupBy('posisi', 'ASC')->findAll();
    } 
    public function getTAGroupByS1() {
        return $this->groupBy('ijazahS1', 'ASC')->findAll();
    } 
    
    public function search($katakunci) {
        $tabel = $this->table('tb_ta');
        $tabel->like('nama', $katakunci);
        return $tabel;
    }
   
    public function getFilterPendidikanS1($pendidikan){
        $ResponseData="";
        //::You could past third parameter
      
        //$this->like('title', 'match', 'both');   // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
                $this->like('ijazahS1', $pendidikan);
               
            //    $this->limit(10);
                $this->orderBy("ijazahS1", "ASC");
                //:::::
                $query = $this->get();
        
        //$RecordCounted=count($query->getResultArray());   //::: 
            
            if($query->getResultArray()){
                
                $ResponseData=$query->getResultArray();
            }
            
            return $ResponseData;
    }

    public function getFilterPendidikanS2($pendidikan){
        $ResponseData="";
        //::You could past third parameter
        //$this->like('title', 'match', 'before'); // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
        //$this->like('title', 'match', 'after');  // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        //$this->like('title', 'match', 'both');   // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
                $this->like('ijazahS2', $pendidikan);
               
            //    $this->limit(10);
                $this->orderBy("ijazahS2", "ASC");
                //:::::
                $query = $this->get();
        
        //$RecordCounted=count($query->getResultArray());   //::: 
            
            if($query->getResultArray()){
                
                $ResponseData=$query->getResultArray();
            }
            
            return $ResponseData;
    }

    public function getFilterPendidikanS3($pendidikan){
      //  dd($pendidikan);
        $ResponseData="";
        //::You could past third parameter
        //$this->like('title', 'match', 'before'); // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
        //$this->like('title', 'match', 'after');  // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        //$this->like('title', 'match', 'both');   // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
                $this->like('ijazahS3', $pendidikan);
               
            //    $this->limit(10);
                $this->orderBy('ijazahS3', 'ASC');
                //:::::
                $query = $this->get();
              //  dd($query);
        //$RecordCounted=count($query->getResultArray());   //::: 
            
            if($query->getResultArray()){
                
                $ResponseData=$query->getResultArray();
            }
            
            return $ResponseData;
    }

    public function getOrderBySIPP_ED() {
        
        $ResponseData="";
      
            $this->orderBy('sipp_ed', 'ASC');
            $query = $this->get();
            if($query->getResultArray()){
                $ResponseData=$query->getResultArray();
            }
            return $ResponseData;
    } 
    public function getFilterPosisi($p=false) {
       
        return $this->db->table('tb_ta')
        ->select('id, nama, sipp, sipp_ed, str_ed, usia')
        ->where('posisi =', $p)
        
        ->get()->getResultArray();
       // return $this->where(['posisi'=>$p])->findAll();
    } 
    public function getFilterUsia($u1, $u2) {
        return $this->db->table('tb_ta')
        ->select('id, nama, sipp, sipp_ed, str_ed, usia')
        ->where('usia >=', $u1)
        ->where('usia <=', $u2)
        ->get()->getResultArray();
    } 
    
    public function getCVSIPP($id=false) {
       
        if ($id==false) {
            return $this->orderBy('sipp_ed', 'DESC')->findAll();
        }
        return $this->where(['id'=>$id])->first();
    } 
    public function tambahCV($data) {
        
        return $this->db->table('tb_ta')->insert($data);
    } 

    public function getPengalaman($id=false) {
       
        if ($id==false) {
            return $this->orderBy('sipp_ed', 'DESC')->findAll();
        }
        return $this->where(['id'=>$id])->first();
    } 
    
    public function getLaporan($id=false) {
        return $this->db->table('tb_exp')
        ->select('kode_ta,nama_ta,kegiatan,lokasi,pengguna,pers,referensi,statuse,tahun,uraian,posisitugas,mulai,selesai,jml_bln,inter')
        ->where(['kode_ta'=>$id])
        ->orderBy('tahun', 'DESC')  // Tidak bisa ditampilkan di dompdf jika memakai $returnType = 'object';
        ->get()->getResultArray();
    }

    public function tampil($key = null, $start = 0, $length = 0) {
        $builder = $this->table('datatables_demo');
        if ($key) {
            $arr = explode(" ", $key);
            for ($i=0; $i < count($arr); $i++) {
                $builder = $builder->orlike('first_name', $arr[$i]);
                $builder = $builder->orlike('last_name', $arr[$i]);
                $builder = $builder->orlike('position', $arr[$i]);
            }
        }

        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }
        return $builder->orderBy('first_name', 'asc')->get()->getResult();
    }
    public function getDetails() {
        $details = array (
            'host'=>$this->db->hostname,
            'user'=>$this->db->username,
            'pass'=>$this->db->password,
            'db'=>$this->db->database,
        );
     //   d($details);
        return $details;
    }
    public function getColumns() {
        $columns = array (
            array(
                'db'=>'id',
                'dt'=>'0'
            ),
            array(
                'db'=>'kode_ta',
                'dt'=>'1'
            ),
            array(
                'db'=>'nama',
                'dt'=>'2'
            ),
            array(
                'db'=>'id',
                'dt'=>'3',
                'formatter'=>function($d, $row) {
                    return "Delete|Update";
                }
            ),
        );
        return $columns;
     
    }
}
?>