<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Sertifikat Tenaga Ahli</h1>
                
                        <div class="card mb-4">
                          <!--  <div class="card-header">
                                <i class="fas fa-table me-1"></i>                                                             
                                <a href="/tambah-sertifikat" class="btn btn-success p-2"><i class="fas fa-plus-circle"></i>Tambah Data Sertifikat</a>
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
                                        
                                        <col span="1" style="width: 20%;">
                                        <col span="1" style="width: 50%;">
                                        <col span="1" style="width: 20%;">
                                                                    
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th scope="col" style = "width:5%; text-align:center">No.</th>
                                            <th scope="col" style = "width:20%; text-align:center">Tenaga Ahli</th> 
                                            <th scope="col" style = "width:50%; text-align:center">Sertifikat</th>                                                                                                                              
                                            <th scope="col" style = "width:20%; text-align:center">Edit</th>                                
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ( $sertifikat as $v) : ?>
                                            <tr>
                                                <td style = "widht:5%"><?= $i; ?></td>
                                                <td style = "width:20%"><?= $v->nama; ?></td> 
                                                <td style = "width:50%"><?= $v->sertifikat; ?></td>                                                                                                                                                                                                
                                                <td style = "width:20%; text-align:center">     
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v->id_sert;?>" 
                                                    class="btn btn-sm btn-warning" id="#baca" title="baca">
                                                    <i class="fa-solid fa-magnifying-glass"></i></button> |
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#update<?= $v->id_sert; ?>" 
                                                    class="btn btn-sm btn-warning" id="#update" title="update">
                                                    <i class="fa-solid fa-pencil"></i></button></i>|
                                                    <button type="button" 
                                                    class="btn btn-sm btn-warning" title="hapus">
                                                    <a href="/delete-sertifikat/<?= $v->id_sert;?>" onclick="return confirm('Yakin ingin menghapus data ?')">
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
                    </div>
                </main>

<!-- Modal Tambah-->
    <div class="modal fade" id="tambah" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Sertifikat Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <!--Notifikasi gagal tambah data  -->             
                <!--pasangannya di SertController.php fungsi simpan_exp()-->
                <?php if (session('gagal-menambah-sertifikat')) :  ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session('gagal-menambah-sertifikat');?>
                    </div>
                <?php endif; ?>
                <!--Notifikasi gagal tambah data  -->
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-sertifikat')  -->                                        
                        <form action="<?= base_url('tambah-sertifikat') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                       <!--   Menampilkan pilihan nama tenaga ahli dan nomor id     -->   
                                       <!--   memakai drop down menu      -->
                                        <div class = "mb-3">
                                            <label for="kode_ta">Masukkan ID Tenaga Ahli ( dengan nama... )</label>
                                            <select class="kode_ta" name="kode_ta" id="kode_ta">
                                                <?php foreach ($ta as $val) : ?> 
                                                    <option hidden value="<?= $val['id']?>">
                                                        <?= $val['id']?>
                                                    </option>        
                                                    <option value="<?= $val['id']?>">
                                                        <?= $val['nama']; ?>
                                                    </option>               
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                   
                                        <div class="mb-3">
                                            <label for="sertifikat">Masukkan Sertifikat</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="sertifikat" id="sertifikat" placeholder="Sertifikat">                              
                                            </div>
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
    <?php foreach ( $sertifikat as $v) : ?>
        <div class="modal fade" id="baca<?= $v->id_sert; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Baca Sertifikat Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-sertifikat')  -->                                        
                        <form action="<?= base_url('#') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                
                                     
                                        <div class = "mb-3 row">
                                            <label for="kode_ta" class="col-sm-2 col-form-label">ID Tenaga Ahli</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly  value="<?= $v->kode_ta; ?>">   
                                            </div>          
                                        </div>

                                        <div class = "mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly  value="<?= $v->nama; ?>"> 
                                            </div>             
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly value="<?= $v->sertifikat; ?>">    
                                            </div>                    
                                       </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
<?php foreach ( $sertifikat as $v) : ?>
        <div class="modal fade" id="update<?= $v->id_sert; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Sertifikat Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-sertifikat')  -->                                        
                        <form action="<?= base_url('update-sertifikat'.$v->id_sert) ?>" method="post">
                            <?=csrf_field() ?>
                                        <div class="mb-3 row">
                                            <label for="kode_ta" class="col-sm-2 col-form-label">ID Tenaga Ahli</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="kode_ta" value="<?= $v->kode_ta; ?>" readonly>
                                            </div>
                                        </div>    
                                     
                                        <div class="mb-3 row">
                                            <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sertifikat" id="sertifikat" value="<?= $v->sertifikat; ?>">
                                            </div>
                                        </div>  

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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