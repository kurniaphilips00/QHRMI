<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Tambah Data</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        
                        <?php if (session('add-failed')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('add-failed'); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('/tender/tambah') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3 row">
                                <label for="Kode" class="col-sm-2 col-form-label">Kode Tender</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('Kode') ? 'is-invalid' : null ?>" 
                                    name="Kode" id="Kode" placeholder="Kode Tender">

                                    <?php if ($validation->hasError('Kode')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->geterror('Kode'); ?>                                        
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama Tender</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('Nama') ? 'is-invalid' : null ?>" 
                                    name="Nama" id="Nama" placeholder="Nama Tender">

                                    <?php if ($validation->hasError('Nama')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->geterror('Nama'); ?>                                        
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  
                                    name="Instansi" placeholder="Nama Instansi">

                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Kode_RUP" class="col-sm-2 col-form-label">Kode RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="Kode_RUP" id="Kode_RUP" placeholder="Kode RUP">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Paket_RUP" class="col-sm-2 col-form-label">Paket RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="Paket_RUP" id="Paket_RUP" placeholder="Paket RUP">
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label for="SumberDana_RUP" class="col-sm-2 col-form-label">Sumber Dana RUP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="SumberDana_RUP" id="SumberDana_RUP" placeholder="Sumber Dana RUP">
                                </div>
                            </div>

                              
                            <div class="mb-3 row">
                                <label for="Tgl_Pembuatan" class="col-sm-2 col-form-label">Tgl. Pembuatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" 
                                    name="Tgl_Pembuatan" id="Tgl_Pembuatan" placeholder="Tgl Pembuatan">
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" 
                                    id="tgl_buat" onchange="Isi_Tgl_Pembuatan()">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="Tahap" class="col-sm-2 col-form-label">Tahap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="Tahap" id="Tahap" placeholder="Tahap">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="SatKer" class="col-sm-2 col-form-label">Satuan Kerja</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="SatKer" id="SatKer" placeholder="Satuan Kerja">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="JenisPengadaan" class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="JenisPengadaan" id="JenisPengadaan" placeholder="Jenis Pengadaan">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="MetodePengadaan" class="col-sm-2 col-form-label">Metode Pengadaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="MetodePengadaan" id="MetodePengadaan" placeholder="Metode Pengadaan">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="TahunAnggaran" class="col-sm-2 col-form-label">Tahun Anggaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="TahunAnggaran" id="TahunAnggaran" placeholder="Tahun Anggaran">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="NilaiPagu" class="col-sm-2 col-form-label">Nilai Pagu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="NilaiPagu" id="NilaiPagu" placeholder="Nilai Pagu">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="NilaiHPS" class="col-sm-2 col-form-label">Nilai HPS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="NilaiHPS" id="NilaiHPS" placeholder="Nilai HPS">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="JenisKontrak" class="col-sm-2 col-form-label">Jenis Kontrak</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="JenisKontrak" id="JenisKontrak" placeholder="Jenis Kontrak">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="Lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="Lokasi" id="Lokasi" placeholder="Lokasi">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="BobotTeknis" class="col-sm-2 col-form-label">Bobot Teknis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="BobotTeknis" id="BobotTeknis" placeholder="Bobot Teknis">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="BobotBiaya" class="col-sm-2 col-form-label">Bobot Biaya</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="BobotBiaya" id="BobotBiaya" placeholder="Bobot Biaya">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="LPSE" placeholder="Link LPSE">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Jadwal LPSE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="JadwalLPSE" placeholder="Link Jadwal LPSE">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="/tender" class="btn btn-primary m-2" style="height: 35px; width: 90px">
                                <i class="fa-solid fa-circle-left"></i></i> Kembali</a>

                                
                                <button type="submit" class="btn btn-success">Simpan</button>
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
    function Isi_Tgl_Pembuatan() {
        const tglawal = new Date(document.getElementById('tgl_buat').value);
        let tahuntglawal = tglawal.getFullYear();
        let bulantglaw = tglawal.getMonth() + 1; // Months start at 0
        let haritglaw = tglawal.getDate();
        let tgl = tahuntglawal + '-' + bulantglaw + '-' + haritglaw;
        document.getElementById('Tgl_Pembuatan').value = tgl;
    }
</script>


<?= $this->endsection(); ?>