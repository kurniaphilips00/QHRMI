<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                      
                            <div class="mb-3 row">
                                <label for="aktifitas" class="col-sm-2 col-form-label">Kode Proyek</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kegiatan" 
                                    value="<?= $proyekTA['kode_proyek'] ?>" readonly>

                                </div>
                            </div>
                            <!------Menampilkan pilihan nama tenaga ahli untuk mengisi id TA dan input teks nama di bawahnya   -->
                            
                            
                            <a href="/ta-exp/" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                           
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