<?php
namespace App\Models;

use CodeIgniter\Model;

class rhModel extends Model
{
    protected $table            = 'tb_ta';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id','nama','posisi','perusahaan','tgl','kota','usia','no_npwp','no_telp','no_hp','ijazahS1','s1_univ','s1_thn',
    'ijazahS2','s2_univ','s2_thn','ijazahS3','s3_univ','s3_thn','no_ktp', 'sipp','sipp_ed','str','str_ed','kta','kta_ed','asosiasi','alamat','email',
    'kategori','pasfoto', 'fktp','fnpwp','fsipp','fstr','fkta', 'ref','status'];

    public function getCV($id=false) {
        if ($id==false) {
            return $this->orderBy('nama', 'ASC')->findAll();
        }
        return $this->where(['id'=>$id])->first();
    } 

    public function tampilkan($katakunci = null, $start = 0, $length = 0) {
        $tabel = $this->table('tb_ta');
        if ($katakunci) {
            $arr = explode(" ", $katakunci);
            for ($i=0; $i < count($arr); $i++) { 
                $tabel = $tabel->orlike('nama', $arr[$i]);
                $tabel = $tabel->orlike('alamat', $arr[$i]);
                
            }
        }
        if ($start != 0 or $length != 0) {
            $tabel = $tabel->limit($length, $start);
        }
        return $tabel->orderBy('nama', 'ASC')->get()->getResult();
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
        return $this->orderBy('sipp_ed', 'ASC')->findAll();
    } 
    public function getFilterPosisi($p=false) {
       
        if ($p==false) {
            return $this->orderBy('nama', 'ASC')->findAll();
        }
        return $this->where(['posisi'=>$p])->findAll();
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
}
?>