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
                    
                        
                        <form action="<?= route_to('/ta-exp/edit/') ?>" method="post">
                      
                        
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode Pengalaman</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kegiatan" 
                                    value="<?= $proyekTA['kode_pengalaman'] ?>" readonly>

                                </div>
                            </div>
                           
                            <div class="mb-3 row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Kode Tenaga Ahli</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly 
                                    value="<?= $proyekTA['kode_TA'] ?>">
                                </div>
                            </div>

                                <!------Menampilkan pilihan tenaga ahli untuk mengisi id TA  dan naman TA (input text di bawahnya)  -->
                                <div class="mb-3 row">
                                <label for="id" class="col-sm-2 col-form-label">Pilih Kode Tenaga Ahli</label>
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
                                <label class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="nama_ta" id="Nama_Personil" value="<?= old('nama_ta') ?>" placeholder="Nama Tenaga Ahli">
                                    
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Pilih Kode Posisi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="positions" onclick="IsiJabatan()">
                                        <option value="">Pilih posisi</option>
                                        <?php foreach ($posisi as $val) : ?>
                                            <option value="<?= $val['kode_posisi'] ?>"> <?= $val['posisitugas'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Posisi Tugas</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly name="posisi" id="jabatan" 
                                    value="<?= $proyekTA['kode_posisi'] ?>">
                                </div>
                            </div>


                            <div class="modal-footer">
                                <a href="/ta-exp/" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
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


    function IsiNama() {
        const sel = document.getElementById("ta_ID");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("Nama_Personil").value = teks;
    }
    function IsiJabatan() {
        const sel = document.getElementById("positions");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("jabatan").value = teks;
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
        document.getElementById("aktifitas").value = teks;
    }
</script>
<!-- Start ckEditor 4 -->
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<!--  End ckEditor 4 --> 
<?= $this->endsection(); ?>