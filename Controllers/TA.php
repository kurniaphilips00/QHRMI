<?php
namespace App\Controllers;
use App\Models\cvModel;

class TA extends BaseController
{
  
    public function __construct()
    {
        $cv = $this->cvModel = new cvModel();    
        //$posisi = $this->posisiModel = new posisiModel();     
    }
    public function index()
    {
        $cv = $this->cvModel->getCV();
        $data = [            
            'cv' => $cv
        ];
        return view('cv/index', $data);
    }
    public function simpan() {          //store
        $cv = $this->cvModel->getCV();

        $file = $this->request->getFile('img');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move("uploads/", $newName);
        }
       
        $data = [
            'nama' => $this->request->getVar('nama'),
            'pasfoto' => $newName,
        ];
      //  dd($data);
       
        $simpan = $this->cvModel->save($data);
        if ($simpan) {
            $hasil['sukses'] = true;
        }else {
            $hasil['sukses'] = false;
        }
        return json_encode($hasil);
    }

    public function edit($id)
    {
        $id1 = $this->cvModel->find($id);
        return json_encode($id1);
    }
    public function hapus($id)
    {
        $this->cvModel->delete($id);
        return redirect()->to('cv');
      
    }
    /*
    public function store()
    {
       // print_r($_POST);
       // print_r($_FILES);
        
        $cv = new cvModel();
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move("uploads/", $newName);
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'pasfoto' => $newName,
        ];

        $result = $cv->save($data);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function fetch() {
        $cv = new cvModel();
        $posts = $cv->findAll();
        //print_r($posts);
        
        $data = '';

        if ($posts) {
            foreach ($posts as $post) {
                // Ini untuk menampilkan data id dan pas foto
                    $data .= 
                  '<tr>
                    <td> <a href="#" id="' . $post['id'] . '" data-bs-toggle="modal" data-bs-target="#detail_post_modal" class="post_detail_btn">
                        <img src="uploads/' . $post['pasfoto'] . '" class="img-fluid card-img-top"></a> </td>
                        <td>' . $post['nama'] . '</td>';
                // Ini untuk menampilkan tombol update dan delete
                    $data .='
                    <a href="#" id="' . $post['id'] . ' data-bs-toggle = "modal" data-bs-target = "#edit_post_form"' . '" class="btn btn-success btn-sm post_edit_btn">Edit</a>
                    <a href="#" id="' . $post['id'] . '" class="btn btn-danger btn-sm post_delete_btn">Delete</a>
                  </tr>
              ';
            }
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">Tidak ada data di dalam database!</div>'
            ]);
        }
    }
    public function getData()
    {
        $cv = new cvModel();
        $results = $cv->orderBy('id', 'ASC')->findAll();
        $output = "";
            foreach ($results as $r) {
                $output .= "<tr>
                <td>{$r['id']}</td>
                <td>{$r['title']}</td>
                <td><img src='uploads/{$r['pro_image']}' alt='{$r['pro_image']}' style='width:70px;height:70px;'></td>
                <td><button class='btn btn-success' data-toggle='modal' data-id='{$r['id']}' id='edit-product' data-target='#update-product'>Edit</button></td>
                <td><button data-id='{$r['id']}' id='delete-product' class='btn btn-danger'>Delete</button></td>
            </tr>";
            }
        echo $output;
    }
  
    public function edit()
    {
        $id = $this->request->getVar('id');
        $cv = new cvModel();
        $V = $cv->find($id);
        $output = "
        <div class='form-group'>
            <label for='nama'>Nama</label>
            <input type='text' class='form-control' name='nama' value='{$V['nama']}' placeholder='Enter Title' id='edit_title'>
            <input type='text' class='form-control' placeholder='Enter Title' value='{$V['id']}' id='id' name='id'>
        </div>
        <div class='form-group'>
            <label for='file'>Image:</label>
            <input type='file' class='form-control-file border' name='new_image' id='new_image'>
            <img src='uploads/{$V['pasfoto']}' alt='{$V['pasfoto']}' style='width:70px;height:70px;'>
            <input type='text' value='{$V['pasfoto']}' class='form-control-file border' name='old_image' id='old_image'>
        </div>";

        echo $output;
    }

    public function update()
    {
        $cv=new cvModel();
        $id = $this->request->getVar('id');
         $V=$cv->find($id);
        $new_image = $this->request->getFile('new_image');
        $old_image = $this->request->getVar('old_image');
        $newImage="";
        if ($new_image != "") {
            $path = "uploads/" . $old_image;
            if (file_exists($path)) {
                unlink($path);
            }
            if($new_image->isValid() && ! $new_image->hasMoved()){  
                $newImage = $new_image->getRandomName();
                $new_image->move("uploads/", $newImage);
            }
        }else{  
            $newImage=$old_image;
        }

        $data=[  
            'id'=>$this->request->getVar('id'),
            'nama'=>$this->request->getVar('nama'),
            'pasfoto'=>$newImage,
        ];
        $result=$V->save($data);
        if($result) {
            echo 1;
        }else{  
            echo 0;
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('id');

        $cv = new cvModel();
        $get = $cv->find($id);
        $path = "uploads/" . $get['pasfoto'];
        if (file_exists($path)) {
            unlink($path);
        }
        $result = $cv->delete($id);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }*/
}
?>