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
                        <form method="get">
                            <!-- Ini alias dari update(simdat_TA=simpan update TA)-------------------->
                            <?= csrf_field(); ?>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $result['kode_proyek'] ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Instansi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $result['instansi'] ?>" readonly>
                                </div>
                            </div>
                            <!--Posisi Penugasan dipakai untuk mengisi Posisi yang diusulkan-->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $result['pekerjaan'] ?>">
                                </div>
                            </div>
                     
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $result['lokasi'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['alamat'] ?>">
                                </div>
                            </div>

                            
                                <?php
                                $mulai = isset($result['mulai']) ? $result['mulai'] : '';
                                $selesai = isset($result['selesai']) ? $result['selesai'] : '';
                                if ($mulai != '0000-00-00' && $mulai != null  && $mulai != '') {
                                    $mulai = new DateTime($result['mulai']);
                                    $mulai = $mulai->format('d-m-Y'); //  Menampilkan format Indo

                                }
                                if ($selesai != '0000-00-00' && $selesai != null  && $selesai != '') {
                                    $selesai = new DateTime($result['selesai']);
                                    $selesai = $selesai->format('d-m-Y'); //  Menampilkan format Indo
                                }
                                ?>
                             <div class="mb-1 row">   
                                    <label class="col-sm-2 col-form-label">Mulai</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?= $mulai ?>">
                                    </div>
                            </div>
                                
                            <div class="mb-1 row">
                                    <label class="col-sm-2 col-form-label">Selesai</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?= $selesai ?>">
                                    </div>
                                
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?= $result['tahun'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Jumlah bulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?= $result['jml_bln'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Intermitten</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['inter'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <br>
                                <label class="col-sm-2 col-form-label">Nilai </label>
                                <div class="col-sm-8">
                                    <input type="text" style="width: 500px;" readonly value="<?= $result['nilai'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Nomor Referensi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['referensi'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <?php
                                    $ref = isset($result['refpdf']) ? $result['refpdf'] : '';
                                ?>
                                <br>
                                <label class="col-sm-2 col-form-label">File Referensi</label>
                                <div class="col-sm-8">
                                    <input type="text" style="width: 500px;" readonly value="<?= $ref ?>" />
                                </div>

                                <a href="<?=base_url('uploads/'.$ref)?>" target="_blank" 
                                style="font-style: italic;">Tampilkan Pdf</a>

                            </div>
                            <a href="/pengalaman" class="btn btn-primary m-2" style="height: 40px; width: 110px">
                                <i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                            <!--<button type="reset" class="btn btn-dark">Close</button>-->
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
    function positions() {
        // alert('hai');
        let posi = document.getElementById('pos').value;
        document.getElementById('posisinya').value = posi;
    };

    function tampil() { //Mengatur tampilan format tanggal lahir
        //Mengambil tanggal lahir baru dari input date 
        const tgl = new Date(document.getElementById('new_tgl_lahir').value);
        const skrg = new Date();
        let tahun = tgl.getFullYear();
        let sekarang_tahun = skrg.getFullYear();
        let usia = sekarang_tahun - tahun; //  Menghitung usia
        let bulan = tgl.getMonth() + 1; // Months start at 0

        let tanggal = tgl.getDate();

        if (tanggal < 10) tanggal = '0' + tanggal;
        if (bulan < 10) bulan = '0' + bulan;
        let formattedToday = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('old_tgl_lahir').value = formattedToday; //  Menampilkan tanggal lahir dengan format MySQL
        document.getElementById('umur').value = usia; //  Mengisi data  usia 
    }

    function Ubah_SIPP_ED() {
        const tgl = new Date(document.getElementById('Tgl_SIPP').value);

        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let tanggal = tgl.getDate();

        let formattedMySQL = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('sipp_ed_ID').value = formattedMySQL;

    }

    function Ubah_STR_ED() {
        const tgl = new Date(document.getElementById('Tgl_STR').value);

        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let tanggal = tgl.getDate();

        let formattedMySQL = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('str_ed_ID').value = formattedMySQL;

    }

    function Ubah_KTA_ED() {
        const tgl = new Date(document.getElementById('Tgl_KTA').value);

        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let tanggal = tgl.getDate();

        let formattedMySQL = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('kta_ed_ID').value = formattedMySQL;

    }

    function jurusanS1() {
        var sel = document.getElementById("jurS1");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS1").value = teks;
    }

    function jurusanStrata2() {
        var sel = document.getElementById("jurS2");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS2").value = teks;
    }

    function jurusanStrata3() {
        var sel = document.getElementById("jurS3");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS3").value = teks;
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

<?= $this->endsection(); ?>