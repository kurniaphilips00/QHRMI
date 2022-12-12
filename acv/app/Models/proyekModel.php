<?php
namespace App\Models;

use CodeIgniter\Model;

class proyekModel extends Model
{
    protected $table            = 'tb_proyek';   
    protected $returnType       = 'object';
    protected $allowedFields    = ['instansi','pekerjaan', 'ruang_lingkup','lokasi','alamat',
    'nokontrak','mulai','selesai','nilai'];
    public function getProyek($id=false) {
        if ($id==false) {
            return $this->findAll();
        }
        return $this->where (id->$id)->first();
    } 
}
?>