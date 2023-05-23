<?= $this->extend('layout/dashboard-layout'); ?>

<?= $this->Section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header mx-2">
                        <!------------------Awal baris tombol-tombol editing-------------------------------------------------------------->
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">


                            <h2>Form Tambah Dokumen (Akta)</h2><br><br>
                            <!--pasangannya di Dashboard.php fungsi simpan()
                                                    <div class="suwal" data-swal="<?= session('tambah'); ?>"></div>-->
                            <!--Notifikasi berhasil tambah data CV -->
                            <?php if (session('AddSuccess')) :  ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session('AddSuccess'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <form action="/akta/tambah" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>


                                    <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <label for="gambar" class="col-sm-3">Pilih file pdf</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="namafile" id="gambar" accept="application/pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->
                                    <br>
                                    <div class="mb-3 row">
                                        <!-- <label class="col-sm-2 col-form-label">Keterangan</label>-->
                                        <div class="col-sm-12">
                                            <label for="dokumen" class="col-sm-3 col-form-label">Dokumen</label>
                                            <select name="dokumen" id="doc" class="col-sm-9">
                                                <option value="">Pilih dokumen</option>
                                                <option value="Akta Pendirian">Akta Pendirian</option>
                                                <option value="Akta Perubahan">Akta Perubahan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <label class="col-sm-3 col-form-label">Tanggal</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="tanggal" id="tgl_akta">
                                            </div>
                                            <div class="col-sm-4"><input type="date" class="form-control" id="tgl_berdiri" onchange="klik()"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <label class="col-sm-3 col-form-label">Nomor</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nomor" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <label class="col-sm-3 col-form-label">Notaris</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="notaris" />
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <a href="/akta/" class="btn btn-primary m-2" style="height: 35px; width: 90px">
                                        <i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</section>
<script>
    function klik() {
        const tglberdiri = new Date(document.getElementById('tgl_berdiri').value);
        let tahuntglawal = tglberdiri.getFullYear();
        let bulantglaw = tglberdiri.getMonth() + 1; // Months start at 0
        let haritglaw = tglberdiri.getDate();
        let tgl = tahuntglawal + '-' + bulantglaw + '-' + haritglaw;
        document.getElementById('tgl_akta').value = tgl;
    }
</script>
<?= $this->endSection(); ?>