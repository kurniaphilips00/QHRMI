<?= $this->extend('layout/template'); ?>
<?= $this->Section('isi'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Bahasa Tenaga Ahli</h1>
                
                        <div class="card mb-4">
                          <!--  <div class="card-header">
                                <i class="fas fa-table me-1"></i>                                                             
                                <a href="/tambah-bahasa" class="btn btn-success p-2"><i class="fas fa-plus-circle"></i>Tambah Data Sertifikat</a>
                            </div>-->

                               <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" 
                          data-bs-target="#baru" style="width:120px"><i class="fa-solid fa-circle-plus"></i>
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
                                        <col span="1" style="width: 30%;">
                                        <col span="1" style="width: 25%;">
                                        <col span="1" style="width: 20%;">
                                        <col span="1" style="width: 20%;">                           
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th scope="col" style = "width:5%; text-align:center">No.</th>
                                            <th scope="col" style = "width:30%; text-align:center">Tenaga Ahli</th>
                                            <th scope="col" style = "width:25%; text-align:center">Bahasa</th>
                                            <th scope="col" style = "width:20%; text-align:center">Nilai</th>                                                                                                                              
                                            <th scope="col" style = "width:20%; text-align:center">Edit</th>                                
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ( $bhs as $v) : ?>
                                                <tr>
                                                   
                                                    <td style = "widht:5%"><?= $i; ?></td>
                                                    <td style = "width:30%"><?= $v->nama; ?></td>  
                                                    <td style = "width:25%"><?= $v->bahasa; ?></td>         
                                                    <td style = "width:20%"><?= $v->nilai; ?></td>                                                                                                                                                                                              
                                                    <td style = "width:20%; text-align:center">     

                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v->id_bahasa;?>" 
                                                            class="btn btn-sm btn-warning" id="#baca" title="baca">
                                                            <i class="fa-solid fa-magnifying-glass"></i></button>|<button type="button" data-bs-toggle="modal" data-bs-target="#update<?= $v->id_bahasa; ?>" 
                                                            class="btn btn-sm btn-warning" id="#update" title="update">
                                                            <i class="fa-solid fa-pencil"></i></button></i>|<button type="button" 
                                                            class="btn btn-sm btn-warning" title="hapus">
                                                            <a href="/delete-bahasa/<?= $v->id_bahasa;?>" onclick="return confirm('Yakin ingin menghapus data bahasa')">
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
    <div class="modal fade" id="baru" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Bahasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-bahasa')  -->                                        
                        <form action="<?= base_url('tambah-bahasa') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                                
                                        <div class = "mb-3">
                                            <label for="kode_ta">Masukkan ID Tenaga Ahli ( dengan nama... )</label>
                                            <select class="form-control" name="kode_ta" id="kode_ta" >
                                                <?php foreach ($ta as $val) : ?> 
                                                    <option value="<?= $val['id']?>">
                                                        <?= $val['id']?>
                                                    </option>        
                                                    <option value="<?= $val['id']?>">
                                                        <?= $val['nama']?>
                                                    </option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="bahasa">Bahasa</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="bahasa" id="bahasa" placeholder="bahasa">                              
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nilai">Nilai</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nilai" id="nilai" placeholder="nilai">                              
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
    <?php foreach ( $bhs as $v) : ?>
        <div class="modal fade" id="baca<?= $v->id_bahasa; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Bahasa Tenaga Ahli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-bahasa')  -->                                        
                        <form action="<?= base_url('#') ?>" method="post">
                        <?=csrf_field() ?>
                    
                            <div class="row g-3">
                                <div class = "mb-3 row">
                                                
                                        <div class = "m-12 row">
                                            <label for="kode_ta">Kode ID Tenaga Ahli</label>
                                            <div class = "col-sm-3">
                                                <input type="text" class="form-control" readonly name="kode_ta" id="kode_ta" 
                                                value="<?= $v->kode_ta; ?>">                                  
                                            </div>                                        
                                        </div>

                                        <div class = "m-12 row">
                                            <label for="nama">Nama Tenaga Ahli</label>
                                            <div class = "col-sm-3">
                                                <input type="text" class="form-control" readonly name="nama" id="nama" 
                                                value="<?= $v->nama; ?>">                                  
                                            </div>                                        
                                        </div>


                                        <div class="m-12 row">
                                            <label for="bahasa" style="width:200">Bahasa</label>                                            
                                                <input type="text" class="form-control" readonly name="bahasa" id="bahasa" 
                                                value="<?= $v->bahasa; ?>">                                                                
                                       </div>

                                        <div class="m-12 row">
                                            <label for="nilai" style="width:200">Nilai</label>                                            
                                                <input type="text" class="form-control" readonly name="nilai" id="nilai" 
                                                value="<?= $v->nilai; ?>">                                                                
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
<?php foreach ( $bhs as $v) : ?>
        <div class="modal fade" id="update<?= $v->id_bahasa; ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Bahasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <!--base_url bisa juga memakai route_to('tambah-bahasa')  -->                                        
                        <form action="<?= base_url('update-bahasa'.$v->id_bahasa) ?>" method="post">
                        <?=csrf_field() ?>
                        
                                                
                                        <div class = "m-1 row">
                                            <label for="kode_ta">Kode ID</label>
                                            <input type="text" class="form-control" name="kode_ta" value="<?= $v->kode_ta; ?>" readonly>   
                                        </div>
                                       <div class = "m-1 row">
                                            <label for="nama">Nama Tenaga Ahli</label>
                                            <input type="text" class="form-control" width:700px name="nama" value="<?= $v->nama; ?>" readonly>                             
                                        </div>

                                        <div class="mb-3">
                                            <label for="bahasa">Bahasa</label>
                                            <input type="text" name="bahasa" id="bahasa" class="form-control" value="<?= $v->bahasa; ?>" required>       
                                        </div>

                                        <div class="mb-3">
                                            <label for="nilai">Nilai</label>
                                            <input type="text" name="nilai" id="nilai" class="form-control" value="<?= $v->nilai; ?>" required>       
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