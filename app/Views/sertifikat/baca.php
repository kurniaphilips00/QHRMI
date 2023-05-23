<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Baca Data</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (session('gagal-menambah-sertifikat')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-sertifikat');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('sukses-tambah-srt')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah-srt');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="get">
                            <?= csrf_field() ?>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                      readonly value="<?= $sertifikat['kode_sert']; ?>">
                                    
                                </div>
                            </div>

                             <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">ID Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                      
                                    placeholder="ID Tenaga Ahli" readonly value="<?= $sertifikat['kode_ta']; ?>">
                                    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    placeholder="Nama Tenaga Ahli" readonly value="<?= $sertifikat['nama_ta'] ?>">
                                    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nomor Sertifikat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $sertifikat['nomor_sert'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Sertifikat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $sertifikat['sertifikat'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tgl. kadaluarsa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $sertifikat['tgl_kadaluarsa'] ?>">                           </div>
                               
                            </div>

                            <div class="modal-footer">
                                <a href="/sertifikat" class="btn btn-primary m-2" 
                                    style="height: 35px; width: 90px">
                                    <i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->



<?= $this->endsection(); ?>