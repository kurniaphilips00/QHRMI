<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<style>
    input:invalid {
        border: double;
        border: red solid 3px;
    }
</style>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Edit Lampiran</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="<?= route_to('/lampiran/edit/', $lampiran['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6" style="text-align:right">
                                    <img src="/uploads/<?= $lampiran['namafile'] ?>" style="width: 150px; text-align:right">
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <label for="Nama_Personil" class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $lampiran['nama_ta'] ?>">
                                </div>
                            </div>
                            <br>
                            <br>
                            <!------Menampilkan pilihan tenaga ahli untuk mengisi id TA  dan naman TA (input text di bawahnya)  -->
                            <div class="mb-3 row">
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
                      
                            <!------Mengisi nama tenaga ahli dari drop down di atas -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Masukkan Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="nama_ta" id="Nama_Personil" value="<?= old('nama_ta') ?>" placeholder="Nama Tenaga Ahli">
                                    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="lampiran" class="col-sm-2 col-form-label">Masukkan Lampiran</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="lampiran" id="lampiran" value="<?= $lampiran['lampiran'] ?>">
                                </div>


                                <select style="height: 35px; " class="col-sm-4" name="posi" onchange="attachment()" id="lamp">
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
                                <a href="/lampiran" class="btn btn-primary m-2" style="height: 35px; width: 90px">
                                    <i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                <button type="submit" class="btn btn-success">Update</button>
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
    function attachment() {
        const sel = document.getElementById("lamp");
        const lampiran = sel.options[sel.selectedIndex].text;
        document.getElementById('lampiran').value = lampiran;
    }
</script>

<?= $this->endsection(); ?>