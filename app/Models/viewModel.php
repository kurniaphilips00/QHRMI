<?php
namespace App\Models;

use CodeIgniter\Model;

class viewModel extends Model
{
    protected $table            = 'v_taExperiences';
    protected $primaryKey       = 'id_exp';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id_exp','id','nama','kegiatan','lokasi','pengguna','referensi','statuse','tahun','uraian','mulai','selesai'];

    public function getView() {
        $query = $this->db->query("SELECT DISTINCT id,nama,tahun,kegiatan,id_exp FROM v_taExperiences");
        $result = $query->getResultArray();
        return $result;
       
    }
  
    public function getFilterNama($id=false) {
      
        return $this->where(['id'=>$id])->findAll();
    }
}
?>

