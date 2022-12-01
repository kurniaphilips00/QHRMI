<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data User</h1>
                
                        <div class="card mb-4">
                          <!--  <div class="card-header">
                                <i class="fas fa-table me-1"></i>                                                             
                                <a href="/tambah-email" class="btn btn-success p-2"><i class="fas fa-plus-circle"></i>Tambah Data Sertifikat</a>
                            </div>-->

                               <!-- Button trigger modal -->
                          <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#add" style="width:120px">
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
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 35%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 20%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th scope="col" style = "width:5%; text-align:center">No.</th>
                                            <th scope="col" style = "width:10%; text-align:center">User</th>     
                                            <th scope="col" style = "width:10%; text-align:center">Email</th>
                                            <th scope="col" style = "width:35%; text-align:center">Alamat</th>
                                            <th scope="col" style = "width:10%; text-align:center">Telp</th>
                                            <th scope="col" style = "width:20%; text-align:center">Edit</th>                                
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ( $usr as $v) : ?>
                                                <tr>
                                                   
                                                    <td style = "widht:5%"><?= $i; ?></td>
                                                    <td style = "width:10%"><?= $v->username; ?></td>     
                                                    <td style = "width:10%"><?= $v->email; ?></td>       
                                                    <td style = "width:35%"><?= $v->address; ?></td>     
                                                    <td style = "width:10%"><?= $v->phone; ?></td>                                                                                                                                    
                                                    <td style = "width:20%; text-align:center">     

                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v->id;?>" 
                                                    class="btn btn-sm btn-success" id="#baca" title="baca">
                                                    <i class="fa-solid fa-magnifying-glass"></i></button>|<button type="button" data-bs-toggle="modal" data-bs-target="#update<?= $v->id; ?>" 
                                                    class="btn btn-sm btn-success" id="#update" title="update">
                                                    <i class="fa-solid fa-pencil"></i></button>|<button type="button" 
                                                    class="btn btn-sm btn-success" title="hapus">
                                                    <a href="/delete-usr/<?= $v->id;?>" onclick="return confirm('Yakin ingin menghapus')">
                                                    <i class="fa-solid fa-trash-can" style="color:white"></i></button></i>

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
    <div class="modal fade" id="add" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Proyek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php if (session('sukses')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('sukses');  // berhasil ditambah?>
                            </div>
                        <?php endif; ?>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-email')  -->                                        
                        <form action="<?= base_url('tambah-usr') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                    <div class="input-group">
                                        <span class="input-group-text">Instansi</span>
                                        <input type="text" class="form-control" name="username" id="username">
                                        <!--    <input type="text" aria-label="Last name" class="form-control"> -->
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Pekerjaan</span>
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Ruang Lingkup</span>
                                        <input type="text" class="form-control" name="address" id="address">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Lokasi</span>
                                        <input type="text" class="form-control" name="phone" id="phone">
                                    </div>  
                                   
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
    <?php foreach ( $usr as $v ) : ?>
        <div class="modal fade" id="baca<?= $v->id; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Baca Proyek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-usr')  -->                                        
                        <form action="<?= base_url('#') ?>" method="post">
                        <?=csrf_field() ?>

                            <div class="row g-3">
                                <div class = "mb-3 row">
                                                
                                    <div class="input-group">
                                        <span class="input-group-text">Instansi</span>
                                        <input type="text" class="form-control" name="username" id="username" value="<?= $v->username; ?>" readonly>
                                        <!--    <input type="text" aria-label="Last name" class="form-control"> -->
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Pekerjaan</span>
                                        <input type="text" class="form-control" name="email" id="email" value="<?= $v->email; ?>" readonly>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Ruang Lingkup</span>
                                        <input type="text" class="form-control" name="address" id="address" value="<?= $v->address; ?>" readonly>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Lokasi</span>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?= $v->phone; ?>" readonly>
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
<?php foreach ( $usr as $v) : ?>
        <div class="modal fade" id="update<?= $v->id; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Proyek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-email')  -->                                        
                        <form action="<?= base_url('update-usr'.$v->id) ?>" method="post">
                        <?=csrf_field() ?>
                        
                            <div class="row">
                                <div class = "mb-3 row">
                                                
                                        <div class="input-group">
                                            <span class="input-group-text">Instansi</span>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $v->username; ?>">
                                            <!--    <input type="text" aria-label="Last name" class="form-control"> -->
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Pekerjaan</span>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $v->email; ?>">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Ruang Lingkup</span>
                                            <input type="text" class="form-control" name="address" id="address" value="<?= $v->address; ?>">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Lokasi</span>
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?= $v->phone; ?>">
                                        </div>  
                                       
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
    <?php endforeach; ?>
<!-- End Modal Update-->  

<?= $this->endSection(); ?>