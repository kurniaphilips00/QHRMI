<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">



                    <!--Notifikasi gagal tambah data CV -->
                    <!--Pasangannya di LampiranController.php fungsi simpan() > session()->setFlashdata();-->
                    <?php if (session('add-failed')) :  ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('add-failed'); ?>
                        </div>
                    <?php endif; ?>
                    <!--Notifikasi gagal tambah data CV -->

                    <?php if (session('AddSuccess')) :  ?>
                        <div class="alert alert-info" role="alert">
                            <?= session('AddSuccess');
                            ?>
                        </div>
                    <?php endif; ?>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?= route_to('lampiran/tambah') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>

                            <!------Menampilkan pilihan tenaga ahli untuk mengisi id TA  dan naman TA (input text di bawahnya)  -->
                            <div class="mb-1 row">
                                <label for="id" class="col-sm-2 col-form-label">Kode Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kode_ta" id="taCode" onclick="FillTheName()" onfocusout="FillTheCode()">
                                        <option value="">Pilih Tenaga Ahli</option>
                                        <?php foreach ($ta as $val) : ?>
                                            <option value="<?= $val['kode_ta'] ?>"><?= $val['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!------Menampilkan pilihan tenaga ahli untuk mengisi id TA  dan nama TA (input text di bawahnya)  -->
                            <br>

                            <div class="mb-3 row">
                                <label for="Nama_Personil" class="col-sm-2 col-form-label">Nama Personil</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('nama_ta') ? 'is-invalid' : null ?>" name="nama_ta" id="Nama_Personil" value="<?= old('nama_ta') ?>" placeholder="Nama Personil">
                                    <?php if ($validation->hasError('nama_ta')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('nama_ta') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->
                            <div class="mb-3 row">
                                <br>
                                <label for="gambar" class="col-sm-2 col-form-label">Pilih file gambar </label>
                                <div class="col-sm-4">
                                    <input type="file" style="display:none" class="form-control <?= $validation->hasError('namafile') ? 'is-invalid' : null ?>" 
                                    name="namafile" accept="image/*" id="gambar" onchange="return previewGbr(this);">

                                    <?php if ($validation->hasError('namafile')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('namafile') ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <img src="" alt="" class="gbr" style="width: 200px;"><br><br><br>
                            </div>
                            <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->

                            <div class="mb-3 row">
                                <label for="Nama_lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" readonly name="lampiran" id="Nama_lampiran" placeholder="Lampiran">
                                </div>
                                <select class="col-sm-4" name="posi" onchange="attachment()" id="lamp" style="height: 35px;">
                                    <option value="">Pilih lampiran</option>
                                    <option value="PasFoto">Pas Foto</option>
                                    <option value="KTP">KTP</option>
                                    <option value="NPWP">NPWP</option>
                                    <option value="SIPP">SIPP</option>
                                    <option value="STR">STR</option>
                                    <option value="KTA">KTA</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <a href="/lampiran/" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
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
    function FillTheName() {
        const sel = document.getElementById("taCode");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("Nama_Personil").value = teks;
    }

    function FillTheCode() {

        let ta = document.getElementById('taCode').value;
        const sel = document.getElementById("taCode");
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

    function attachment() {
        const sel = document.getElementById("lamp");
        const lampiran = sel.options[sel.selectedIndex].text;
        document.getElementById('Nama_lampiran').value = lampiran;
    }
</script>

<?= $this->endsection(); ?>