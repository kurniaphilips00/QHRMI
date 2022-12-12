<?= $this->extend('layout/template'); ?>
<?= $this->Section('isi'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Jurusan Tenaga Ahli</h1>
                
                        <div class="card mb-4">
                          <!--  <div class="card-header">
                                <i class="fas fa-table me-1"></i>                                                             
                                <a href="/tambah-jurusan" class="btn btn-success p-2"><i class="fas fa-plus-circle"></i>Tambah Data Jurusan</a>
                            </div>-->

                               <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" 
                          data-bs-target="#tambah" style="width:120px"><i class="fa-solid fa-circle-plus"></i>
                            Tambah
                          </button><br>
                         <!-- Button trigger modal -->
                         <?php if (session('success')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('success');  //  Delete success ?>
                            </div>
                        <?php endif; ?>
                         <?php if (session('sukses')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses');  //  Sukses ditambah ?>
                            </div>
                        <?php endif; ?>
                         <?php if (session('berhasil')) :  ?>
                            <div class="alert alert-success" role="alert">
                                <?= session('berhasil');    //  Berhasil di-update  ?>
                            </div>
                        <?php endif; ?>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <colgroup>
                                        <col span="1" style="width: 5%;">
                                        <col span="1" style="width: 50%;">
                                        <col span="1" style="width: 20%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th scope="col" style = "width:5%; text-align:center">No.</th>
                                            <th scope="col" style = "width:50%; text-align:center">Jurusan</th>                                                                                                                              
                                            <th scope="col" style = "width:20%; text-align:center">Edit</th>                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ( $jurusan as $v) : ?>
                                                <tr>
                                                    <td style = "widht:5%; text-align:center"><?= $i; ?></td>
                                                    <td style = "width:50%"><?= $v->jurusan; ?></td>                                                                                                                                                                                                
                                                    <td style = "width:20%; text-align:center">     
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v->id;?>" 
                                                        class="btn btn-sm btn-warning" id="#baca" title="baca">
                                                        <i class="fa-solid fa-magnifying-glass"></i></button> |
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#update<?= $v->id; ?>" 
                                                        class="btn btn-sm btn-warning" id="#update" title="update">
                                                        <i class="fa-solid fa-pencil"></i></button></i>|
                                                        <button type="button" 
                                                        class="btn btn-sm btn-warning" title="hapus">
                                                        <a href="/delete-jurusan/<?= $v->id;?>" onclick="return confirm('Yakin ingin menghapus')">
                                                        <i class="fa-solid fa-trash-can"></i></button></i>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

<!-- Modal Tambah-->
    <div class="modal fade" id="tambah" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Jurusan Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-jurusan')  -->                                        
                        <form action="<?= base_url('tambah-jurusan') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                                
                                <div class="input-group mb-1">
                                    <span class="input-group-text">Jurusan</span>
                                    <input type="text" class="form-control" name="jurusan" id="jurusan" required>
                                </div>
                                <!--
                                        <div class="mb-3">
                                            <label for="jurusan">Jurusan</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan">                              
                                            </div>
                                        </div>
                                            -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>

                                    </div>
                                </div>
                        
                            </div>
                        
                        </form>
                </div>
            </div>
    </div>
<!-- End Modal Tambah-->   

<!-- Modal Baca-->
    <?php foreach ( $jurusan as $v) : ?>
        <div class="modal fade" id="baca<?= $v->id; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Jurusan Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-jurusan')  -->                                        
                        <form action="" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                                
                                        <div class="m-12 row">
                                            <label for="jurusan" style="width:200">Jurusan</label>
                                                <input type="text" class="form-control" readonly name="jurusan" id="jurusan" 
                                                value="<?= $v->jurusan; ?>">         
                                       </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>

                                    </div>
                                </div>
                        
                            </div>
                        
                            
                        </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<!-- End Modal Baca-->  

<!-- Modal Update-->
<?php foreach ( $jurusan as $v) : ?>
        <div class="modal fade" id="update<?= $v->id; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Jurusan Tenaga Ahli</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-jurusan')  -->                                        
                        <form action="<?= base_url('update-jurusan'.$v->id) ?>" method="post">
                            <?=csrf_field() ?>
                            <div class = "mb-3 row">
                                <div class="input-group mb-1">
                                    <span class="input-group-text" id="nama">Jurusan</span>
                                    <input type="text" class="form-control" name="jurusan" id="jurusan" value="<?= $v->jurusan; ?>" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<!-- End Modal Update-->  

<?= $this->endSection(); ?>

