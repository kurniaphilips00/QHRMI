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
                        <form action="<?= route_to('/ta-exp/tambah') ?>" method="post">

                            <div class="mb-3 row">
                                <label for="pekerjaan" class="col-sm-2 col-form-label">ID Pekerjaan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="idpekerjaan" id="pekerjaan" onclick="IsiPekerjaan()" onfocusout="IsiIDPekerjaan()">
                                        <option value=""> Pilih pekerjaan (kegiatan) </option>
                                        <?php foreach ($proyek as $val) : ?>
                                            <option value="<?= $val['id'] ?>"> 
                                            <?php echo $val['id'].' - '.$val['pekerjaan']; ?>
                                         
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="aktifitas" class="col-sm-2 col-form-label">Kegiatan(pekerjaan)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kegiatan" id="aktifitas" value="<?= old('kegiatan') ?>" placeholder="Nama Kegiatan" readonly>
                                </div>
                            </div>
                            <!------Menampilkan pilihan nama tenaga ahli untuk mengisi id TA dan input teks nama di bawahnya   -->
                            <div class="mb-1 row">
                                <label for="ta_ID" class="col-sm-2 col-form-label">ID Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kode_ta" id="ta_ID" onclick="IsiNama()" onfocusout="IsiID()">
                                        <option value=""> Pilih Tenaga Ahli </option>
                                        <?php foreach ($ta as $val) : ?>
                                            <!--   <option value="<?= $val['id'] ?>"><?= $val['id'] ?></option>     -->
                                            <option value="<?= $val['id'] ?>"><?= $val['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <!------Mengisi nama tenaga ahli dari drop down di atas -->
                            <div class="mb-3 row">
                                <label for="Nama_Personil" class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly name="nama_ta" id="Nama_Personil" placeholder="Nama Tenaga Ahli">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="perusahaan" value="<?= old('perusahaan') ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Posisi tugas</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="posisi">
                                        <?php foreach ($posisi as $val) : ?>
                                            <option value="<?= $val['posisi'] ?>"> <?= $val['posisi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Status Kepegawaian</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="statuskepegawaian" value="<?= old('statuskepegawaian') ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Uraian Tugas</label>
                                <div class="col-sm-8">
                                    <textarea name="editor1" value="<?= old('uraian') ?>" id="editor" cols="100" rows="10">
                                        </textarea>
                                </div>
                            </div>

                            <a href="/ta-exp/" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                            <button type="submit" class="btn btn-success" style="height: 40px; width: 110px">Simpan</button>


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
    function IsiNama() {
        const sel = document.getElementById("ta_ID");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("Nama_Personil").value = teks;
    }

    function IsiID() {
        let ta = document.getElementById('ta_ID').value;
        const sel = document.getElementById("ta_ID");
        sel.options[sel.selectedIndex].text = ta;
    }

    function ShowExperts($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/ExpertsList/" + $id
    }

    function IsiIDPekerjaan() {
        let idKegiatan = document.getElementById('pekerjaan').value;
        const sel = document.getElementById("pekerjaan");
        sel.options[sel.selectedIndex].text = idKegiatan;
    }

    function IsiPekerjaan() {
        const sel = document.getElementById("pekerjaan");
        const teks = sel.options[sel.selectedIndex].text;
        const hasil = teks.substring(4,);
        document.getElementById("aktifitas").value = hasil;
    }
</script>
<!-- Start ckEditor 4 -->
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<!--    End ckEditor 4 -->
<?= $this->endsection(); ?>