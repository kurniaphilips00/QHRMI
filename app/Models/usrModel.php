<?php
namespace App\Models;

use CodeIgniter\Model;

class usrModel extends Model
{
    protected $table            = 'users';   
   // protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['username','email','password_hash','address','phone','active'];
 
    public function getUSR() {
      // return $this->select('username, email, password_hash, address, phone, gu.group_id kode_group')
      // ->join('auth_groups_users gu', 'users.id=gu.user_id');
       //->join('auth_groups gr', 'gr.id=gu.group_id')
       return $this->findAll();
   }

}

?>