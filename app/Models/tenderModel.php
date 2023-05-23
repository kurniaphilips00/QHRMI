<?php
namespace App\Models;
use CodeIgniter\Model;

class tenderModel extends Model
{
    protected $table            = 'tb_tender';   
    protected $primaryKey       = 'id';
    //protected $returnType       = 'object';
    protected $allowedFields    = [
        
        'Kode','Nama','Instansi','Kode_RUP','Paket_RUP', 'SumberDana_RUP', 'Tgl_Pembuatan', 'Tahap', 
         'SatKer', 'JenisPengadaan', 'MetodePengadaan', 'TahunAnggaran', 'NilaiPagu', 'NilaiHPS', 
        'JenisKontrak', 'Lokasi', 'BobotTeknis', 'BobotBiaya','LPSE','JadwalLPSE'];
    
    public function getTender($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where(['id'=>$id])->first();
    }
}
?>