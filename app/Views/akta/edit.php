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
                <form action="<?= route_to('edit-dokumen', $doc['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="row g-3">
                        <div class="mb-3 row">
                            <!------Mengisi nama tenaga ahli dari drop down di atas -->
                            <div class="mb-3 row">
                                <label>Nama file</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $doc['namafile'] ?>">
                                </div>
                            </div>
                            <!------Mengisi nama tenaga ahli dari drop down di atas -->

                            <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->
                           
                            <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->

                            <div class="mb-3 row">
                                <!-- <label class="col-sm-2 col-form-label">Keterangan</label>-->
                                <div class="col-sm-8">

                                    <label for="doc" style="width: 200px;">Pilih lampiran</label>
                                    <select name="dokumen" id="doc">
                                        <option value="">Pilih dokumen</option>
                                        <option value="SIUP">SIUP</option>
                                        <option value="NIB">NIB</option>
                                        <option value="Domisili">Domisili</option>
                                        <option value="SBU">SBU</option>
                                        <option value="SPT">SPT</option>
                                        <option value="Laporan Keuangan">Laporan Keuangan</option>
                                        <option value="NPWP Quantum">NPWP Quantum</option>
                                        <option value="NPWP Komisaris">NPWP Komisaris</option>
                                        <option value="NPWP Komisaris Utama">NPWP Komisaris Utama</option>
                                    </select>
                                </div>
                            </div>
                            <a href="/dokumen/" class="btn btn-primary px-2 mx-2" style="height: 40px; width: 100px"><i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                            <button type="submit" class="btn btn-success" style="height: 40px; width: 100px"><i class="fa-solid fa-floppy-disk"></i>Simpan</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <script>
        function FillTheName() {
            const sel = document.getElementById("ta_ID");
            const teks = sel.options[sel.selectedIndex].text;
            document.getElementById("Nama_Personil").value = teks;
        }
        function FillTheID() {

            let ta = document.getElementById('ta_ID').value;
            const sel = document.getElementById("ta_ID");
            sel.options[sel.selectedIndex].text = ta;
        }
        function previewGbr() {
            //  alert('Halo');
            const pict = document.querySelector('#gambar');
            const prev = document.querySelector('.gbr');
            const fileGbr = new FileReader();
            fileGbr.readAsDataURL(pict.files[0]);
            fileGbr.onload = function(e) {
                prev.src = e.target.result;
            }
        }
    </script>


    <?= $this->endSection(); ?>