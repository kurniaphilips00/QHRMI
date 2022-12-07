<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"> 

  </head>
  <body>
      <div class="container">
            <div class="text-center my-5">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                  Tambah Data
                </button>
            </div>
      </div>
  
      <div class="table-responsive">
        <table id="example">
            <thead>
                <tr>
                    <th scope="col" style = "text-align:center; width:20%">No.</th>
                    <th scope="col" style = "text-align:center; width:30%">Nama</th>
                    <th scope="col" style = "text-align:center; width:30%">Foto</th> 
                    <th scope="col" style = "text-align:center; width:20%">Edit</th>                                
                </tr>
            </thead>
            <tbody id="get-data"> <!-- ke action.js -->
                  <?php $i = 1; ?>
                  <?php foreach ( $cv as $v) : ?>
                          <tr>
                              <td style = "width:20%"><?= $v['id']; ?></td>
                              <td style = "width:30%"><?= $v['nama']; ?></td>
                              <td style = "width:10%">
                                  <img src="/uploads/<?=$v['pasfoto']?>" width=100px>
                              </td> 
                              <td style = "width:20%">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#update" 
                                    class="btn btn-sm btn-warning" onclick="edit(<?=$v['id']?>)" title="update">Update</button>|
                                    <button type="button" class="btn btn-sm btn-warning" 
                                    onclick="hapus(<?=$v['id']?>)" title="hapus">Hapus</button>
                              </td>
                          </tr>
                      <?php $i++; ?>
                  <?php endforeach; ?>
            </tbody>

        </table>
      </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                        <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= base_url('create') ?>" method="post" id='save' enctype="multipart/form-data">

                     <!--  Notifikasi berhasil -->
                     <div class="alert alert-success sukses" role="alert" style = "display:none"></div>

                       <!--  Notifikasi gagal -->
                       <div class="alert alert-danger gagal" role="alert" style = "display:none"></div>


                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama_id" class="form-control" placeholder="Masukkan nama" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="img">Foto</label>
                            <input type="file" name="img" id="file_id" class="form-control-file border" placeholder="Masukkan foto">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Update -->
    <div class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Tenaga Ahli</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

                        <!-- Modal body -->
                <div class="modal-body">
                    <form action="simpan" method="post" enctype = "multipart/form-data" id='add'>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="foto">Image:</label>
                            <input type="file" name="file" id="file" class="form-control-file border" placeholder="Masukkan foto">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="tombol-simpan" onclick="simpan()">Simpan</button>
                        </div>
                    </form>
                </div>


          </div>
          
        </div>
      </div>
    </div>
    <!-- End Modal Update -->

    <!-------------JQuery----------------------------------->
    <script
          src="https://code.jquery.com/jquery-3.6.1.js"
          integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
          crossorigin="anonymous">
    </script>

    <!-- Popper JS & Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>


    <script src="action.js"></script>
      
  </body>
</html>