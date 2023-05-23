<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Baca Data Posisi</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (session('gagal-menambah-posisi')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-posisi');  //  Delete success 
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
                                <label class="col-sm-2 col-form-label">Posisi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $posisi['posisi'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Uraian Tugas</label>
                                <div class="col-sm-8">
                                    <textarea name="editor1" id="editor" cols="100" rows="11" readonly>
                                    <?= $posisi['uraiantugas'] ?></textarea>
                                </div>
                            </div>
                            

                            <div class="modal-footer">
                                <a href="/posisi" class="btn btn-primary m-2" 
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

<!-- Start ckEditor 4 -->
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<!--    End ckEditor 4 -->

<?= $this->endsection(); ?>