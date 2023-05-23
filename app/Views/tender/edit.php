<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Edit Data</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <?php if (session('add-failed')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('add-failed');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('tender/edit/'. $tender['id']) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode Tender</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $tender['Kode'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama Tender</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $tender['Nama'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Instansi'] ?>" name="Instansi">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Kode_RUP'] ?>" name="Kode_RUP">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Paket RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Paket_RUP'] ?>" name="Paket_RUP">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Sumber Dana RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['SumberDana_RUP'] ?>" name="SumberDana_RUP">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tgl. Pembuatan</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?= $tender['Tgl_Pembuatan'] ?>" name="Tgl_Pembuatan" 
                                    id="tglPembuatan">
                                </div>

                                <div class="col-sm-3"><input type="date" class="form-control" id="pembuatan" onchange="tanggal()"></div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tahap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['Tahap'] ?>" name="Tahap">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Satuan Kerja</label>
                                <div class="col-sm-10">
                                    <input type="text" name="SatKer" class="form-control" value="<?= $tender['SatKer'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="JenisPengadaan" class="form-control" value="<?= $tender['JenisPengadaan'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Metode Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['MetodePengadaan'] ?>" name="MetodePengadaan">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tahun Anggaran</label>
                                <div class="col-sm-10">
                                    <input type="text" name="TahunAnggaran" class="form-control" value="<?= $tender['TahunAnggaran'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai Pagu</label>
                                <div class="col-sm-10">
                                    <input type="text" name="NilaiPagu" class="form-control" value="<?= $tender['NilaiPagu'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai HPS</label>
                                <div class="col-sm-10">
                                    <input type="text" name="NilaiHPS" class="form-control" value="<?= $tender['NilaiHPS'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jenis Kontrak</label>
                                <div class="col-sm-10">
                                    <input type="text" name="JenisKontrak" class="form-control"  value="<?= $tender['JenisKontrak'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Lokasi" class="form-control" value="<?= $tender['Lokasi'] ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label  class="col-sm-2 col-form-label">Bobot Teknis</label>
                                <div class="col-sm-10">
                                    <input type="text" name="BobotTeknis" class="form-control" value="<?= $tender['BobotTeknis'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Bobot Biaya</label>
                                <div class="col-sm-10">
                                    <input type="text" name="BobotBiaya" class="form-control" value="<?= $tender['BobotBiaya'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['LPSE'] ?>" name="LPSE">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jadwal LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $tender['JadwalLPSE'] ?>" name="JadwalLPSE">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="/tender" class="btn btn-primary m-2" style="height: 40px; width: 110px">
                                <i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                <button type="submit" class="btn btn-success" style="height: 40px; width: 110px">Simpan</button>
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

<script>
    function tanggal() {
        // alert('Halo');

        const tgl = new Date(document.getElementById('pembuatan').value);
        //alert(tgl);
        let tahun = tgl.getFullYear();

        let bulan = tgl.getMonth() + 1; // Months start at 0
        let hari = tgl.getDate();
        let tglBuat = tahun + '-' + bulan + '-' + hari;

        document.getElementById('tglPembuatan').value = tglBuat;
    }
</script>

<?= $this->endsection(); ?>