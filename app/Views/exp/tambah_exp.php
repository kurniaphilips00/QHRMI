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

                        <?php if (session('gagal-menambah-pengalaman')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-pengalaman');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('sukses-tambah-pengalaman')) :  ?>
                            <div class="alert alert-danger" role="alert" style="background-color:azure;">
                                <?= session('sukses-tambah-pengalaman');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        

                        <form action="<?= route_to('/pengalaman/tambah') ?>" method="post" enctype="multipart/form-data">

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_proyek" 
                                    value="<?= $kode; ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <!-- for=""  berpasangan dengan id="" berfungsi untuk validasi -->
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                
                                <div class="col-sm-2">
                                    <input type="number" pattern="[0-9]" min="2009" max="2023" step="1" 
                                    class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : null ?>" 
                                    name="tahun" id="thn" value="<?= old('tahun') ?>" placeholder="Tahun Kegiatan"
                                    onchange="MinLengthYear()">
                                    <?php if ($validation->hasError('tahun')) : ?>
                                        <div class="invalid-feedback", style="color:red">
                                            <?= $validation->getError('tahun') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
     
                            <div class="mb-3 row">
                                <!-- for=""  berpasangan dengan id="" berfungsi untuk validasi -->
                                <label for="job" class="col-sm-2 col-form-label">Kegiatan(pekerjaan)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('pekerjaan') ? 'is-invalid' : null ?>" 
                                    name="pekerjaan" id="job" value="<?= old('kegiatan') ?>" placeholder="Pekerjaan">
                                    <?php if ($validation->hasError('pekerjaan')) : ?>
                                        <div class="invalid-feedback", style="color:red">
                                            <?= $validation->getError('pekerjaan') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                 
                            <div class="mb-3 row">
                                <!-- for=""  berpasangan dengan id="" berfungsi untuk validasi -->
                                <label for="pengguna" class="col-sm-2 col-form-label">Pengguna(instansi)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="instansi" id="pengguna"
                                    value="<?= old('instansi') ?>" placeholder="Instansi">
                                
                                    <?php if ($validation->hasError('instansi')) : ?>
                                        <div class="invalid-feedback" , style="color:red">
                                            <?= $validation->getError('instansi') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Lokasi Kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lokasi" value="<?= old('lokasi') ?>">
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?= old('alamat') ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Mulai</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="tgl_awal" onchange="start()">
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" class="form-control" name="mulai" id="aw">
                                </div>
                                
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Selesai</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="tgl_akhir" onchange="hitung_intermitten()" />
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" class="form-control" name="selesai" id="ak">
                                </div>
                                
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Intermitten</label>
                                <div class="col-sm-6 mx-0">
                                    <input type="text" class="form-control mx-0" name="inter" id="intermitten" style="width:500">
                                </div>

                                <label class="col-sm-2 col-form-label">Jumlah Bulan</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" readonly name="jml_bln" id="jmlbln" value="<?= old('jml_bln') ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nomor kontrak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nokontrak" value="<?= old('nokontrak') ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai kontrak</label>

                                <label class="col-sm-1">Rp. </label>
                                <input type="number" pattern="[0-9]" step="10" name="nilai" 
                                value="<?= old('nilai') ?>">
                                
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Surat Referensi</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="referensi" value="<?= old('referensi') ?>">
                                </div>

                               
                                <div class="col-sm-6">
                                    <input type="file" class="input-group-text" name="refpdf" id="refpdf" accept="application/pdf">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <a href="/pengalaman" class="btn btn-primary m-2" style="height: 35px; width: 90px">
                                <i class="fa-solid fa-circle-left"></i></i>Kembali</a>
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
    function ShowExperts($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/ExpertsList/" + $id
    }

    function MinLengthYear() {
        const thn = document.getElementById("thn").value;
        if (thn.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("thn").focus();
        }
        return false;
    }

    function start() {
        const tglawal = new Date(document.getElementById('tgl_awal').value);
        let tahuntglawal = tglawal.getFullYear();
        let bulantglaw = tglawal.getMonth() + 1; // Months start at 0
        let haritglaw = tglawal.getDate();
        let tgl = tahuntglawal + '-' + bulantglaw + '-' + haritglaw;
        document.getElementById('aw').value = tgl;
    }

    function hitung_intermitten() {
        let awal = document.getElementById('tgl_awal').value;
        if (awal != "") {
            const tglawal = new Date(document.getElementById('tgl_awal').value);
            const tglakhir = new Date(document.getElementById('tgl_akhir').value);
            let time_difference = tglakhir.getTime() - tglawal.getTime();
            let Years_difference = 0;
            let SisaBulan = 0;
            let SisaHari = 0;
            var inter = "( ";
            //calculate days difference by dividing total milliseconds in a day  
            let days_difference = time_difference / (1000 * 60 * 60 * 24);
            let Months_difference = Math.floor(days_difference / 30);
            console.log(Months_difference.toString());
            if (Months_difference > 12) {
                Years_difference = Math.floor(Months_difference / 12);
                SisaBulan = Months_difference % 12;
                SisaHari = days_difference - ((Years_difference * 360) + (SisaBulan * 30));
                inter += Years_difference + " tahun ";
                inter += SisaBulan + " bulan ";
                inter += SisaHari + " hari ";
            } else if (Months_difference > 0) {
                SisaHari = days_difference % 30;
                inter += Months_difference + " bulan ";
                inter += SisaHari + " hari ";
            } else {
                inter += days_difference + " hari ";
            }
            inter += " )";
            let tahuntglakhir = tglakhir.getFullYear();
            let bulantglakhir = tglakhir.getMonth() + 1; // Months start at 0
            let haritglakhir = tglakhir.getDate();
            let tglSelesai = tahuntglakhir + '-' + bulantglakhir + '-' + haritglakhir;
            document.getElementById('ak').value = tglSelesai;
            document.getElementById('intermitten').value = inter;
            document.getElementById('jmlbln').value = Months_difference;
        }
    }

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



    function tambah() {
        var sel = document.getElementById("proj");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("aktifitas").value = teks;
        let vproject = document.getElementById("proj").value;
    }
</script>
<?= $this->endsection(); ?>