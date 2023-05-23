<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Baca Data Tender</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        
                        <form method="get">
                            <?= csrf_field() ?>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode Tender</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly 
                                    value="<?= $tender['Kode'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Tender</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly 
                                    value="<?= $tender['Nama'] ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="Instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  
                                    value="<?= $tender['Instansi'] ?>" readonly>

                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Kode_RUP" class="col-sm-2 col-form-label">Kode RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                     value="<?= $tender['Kode_RUP'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Paket_RUP" class="col-sm-2 col-form-label">Paket RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    value="<?= $tender['Paket_RUP'] ?>" readonly>
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Sumber Dana RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    value="<?= $tender['SumberDana_RUP'] ?>" readonly>
                                </div>
                            </div>

                              
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tgl. Pembuatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" 
                                     value="<?= $tender['Tgl_Pembuatan'] ?>" readonly>
                                </div>
                              
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tahap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Tahap'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Satuan Kerja</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['SatKer'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['JenisPengadaan'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Metode Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['MetodePengadaan'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tahun Anggaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['TahunAnggaran'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai Pagu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['NilaiPagu'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai HPS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['NilaiHPS'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Kontrak</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  value="<?= $tender['JenisKontrak'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Lokasi'] ?>"
                                    readonly>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label  class="col-sm-2 col-form-label">Bobot Teknis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['BobotTeknis'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Bobot Biaya</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['BobotBiaya'] ?>"
                                    readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['LPSE'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jadwal LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['JadwalLPSE'] ?>" readonly>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="/tender" class="btn btn-primary m-2" 
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