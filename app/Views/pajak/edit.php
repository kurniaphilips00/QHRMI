<?= $this->extend('layout/template'); ?>
<?= $this->Section('isi'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="row px-4">
            <div class="col-12"><br><br>
                <h2>Form Edit Dokumen Quantum</h2><br><br>
                <!--pasangannya di Dashboard.php fungsi simpan()-->
                                       
                <!--Notifikasi berhasil tambah data CV -->
                <?php if (session('tambah')) :  ?>
                    <div class="alert alert-success" role="alert">
                        <?= session('tambah'); ?>
                    </div>
                <?php endif; ?>

                <!--Notifikasi gagal tambah data CV -->
                <!--Pasangannya di LampiranController.php fungsi simpan_tambah_lampiran() > session()->setFlashdata('tambah','Tambah data gagal !!!');-->
                <?php if (session('add-failed')) :  ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session('add-failed'); ?>
                    </div>
                <?php endif; ?>
                <!--Notifikasi gagal tambah data CV -->
                <form action="<?= route_to('edit-pajak', $pajak['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row g-3">
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama File</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?=$pajak['namafile']?>" readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nomor</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nomor" value="<?=$pajak['nomor']?>" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!-- <label class="col-sm-2 col-form-label">Keterangan</label>-->
                            <div class="col-sm-8">
                                <label style="width: 180px;">Jenis</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?=$pajak['jenis']?>" readonly />
                                </div>
                                <select name="jenis" id="doc">
                                    <option value="">Pilih jenis pajak</option>
                                    <option value="NPWP">NPWP</option>
                                    <option value="Laporan Keuangan">Laporan Keuangan</option>
                                    <option value="SPT Tahunan">SPT Tahunan</option>
                                    <option value="PPH 25">PPH 25</option>
                                    <option value="PPH 21">PPH 21</option>
                                    <option value="PPN">PPN</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tanggal terbit</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="tglterbit" id="tgl_terbit">
                            </div>
                            <div class="col-sm-2"><input type="date" class="form-control" id="tgl_dok" onchange="klik()"></div>
                        </div>
                        <a href="/pajak/" class="btn btn-primary px-2 mx-2" style="height: 40px; width: 100px"><i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                        <button type="submit" class="btn btn-success" style="height: 40px; width: 100px"><i class="fa-solid fa-floppy-disk"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function klik() {
            const tglakta = new Date(document.getElementById('tgl_dok').value);
            let tahuntglawal = tglakta.getFullYear();
            let bulantglaw = tglakta.getMonth() + 1; // Months start at 0
            let haritglaw = tglakta.getDate();
            let tgl = tahuntglawal + '-' + bulantglaw + '-' + haritglaw;
            document.getElementById('tgl_terbit').value = tgl;
        }
    </script>

    <?= $this->endSection(); ?>