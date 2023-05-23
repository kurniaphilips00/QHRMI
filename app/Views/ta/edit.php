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
                        <form action="<?= route_to('/ta/edit', $result['id']) ?>" method="post" enctype="multipart/form-data">
                            <!-- Ini alias dari update(simdat_TA=simpan update TA)-------------------->
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="pdfREFLama" value="<?= isset($result['ref']) ? $result['ref'] : ''; ?>">

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_ta" value="<?= $result['kode_ta'] ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Personil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="<?= $result['nama'] ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <br><label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" 
                                    name="perusahaan" value="<?= old('perusahaan', $result['perusahaan']) ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row"><br>
                                <label class="col-sm-2 col-form-label">Posisi yang diusulkan</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="pos" onchange="positions()">
                                        <option value="">Pilih posisi</option>
                                        <!--Ini field dari tabel posisi (tb_posisi) untuk mengisi tb_ta -->
                                        <?php foreach ($posisi as $val) : ?>
                                            <option value="<?= $val['posisitugas'] ?>"><?= $val['posisitugas'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="posisi" id="posisinya"
                                     
                                    value="<?= $result['posisi'] ?>" readonly><!--Ini field dari tabel tenaga ahli (tb_ta) yang akan diisi -->
                                </div>
                            </div>
                           
                            <div class="mb-3 row">
                                <br><label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="category" onchange="categories()">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $val) : ?> 
                                        <option value="<?= $val['kategori'] ?>"> <?= $val['kategori'] ?></option>
                                    <?php endforeach; ?>
                                    </select> 
                                    
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kategori" id="ctg" value="<?= $result['kategori'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br><label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" value="<?= old('alamat', $result['alamat']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br><label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kota" value="<?= old('kota', $result['kota']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <?php
                                $tgl = isset($result['tgl']) ? $result['tgl'] : '';
                                if ($tgl != '0000-00-00' && $tgl != null  && $tgl != '') {
                                    $tgl = new DateTime($result['tgl']);
                                    $tgl_lahir = $tgl->format('Y-m-d'); //  Menampilkan format Indo
                                    $sekarang = new DateTime();
                                    $diff = $sekarang->diff($tgl);
                                } else {
                                    $tgl_lahir = "";
                                }

                                ?>
                                <br>
                                <label for="tgl" class="col-sm-2 col-form-label">Tgl.lahir</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="tgl" value="<?= $tgl_lahir ?>" id="old_tgl_lahir" readonly />
                                </div>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="new_ttl" id="new_tgl_lahir" onchange="tampil()" />
                                </div>
                                <label for="usia" class="col-sm-1 col-form-label">Usia</label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control" name="usia" value="<?= $result['usia'] ?>" id="umur">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br>
                                <label for="no_ktp" class="col-sm-2 col-form-label">KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_ktp" value="<?= old('no_ktp', $result['no_ktp']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br>
                                <label for="no_npwp" class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_npwp" value="<?= old('no_npwp', $result['no_npwp']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br>
                                <label for="no_telp" class="col-sm-2 col-form-label">Telp.</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_telp" value="<?= old('no_telp', $result['no_telp']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br>
                                <label for="no_hp" class="col-sm-2 col-form-label">HP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_hp" value="<?= old('no_hp', $result['no_hp']) ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <br>
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="<?= old('email', $result['email']) ?>">
                                </div>
                            </div>
                            <br>
                            <label class="col-sm-2 col-form-label" style="width: 120px;">Pendidikan</label>
                            <br>
                            <div class="col-12 mb-1 row">
                                <br> <label class="col-sm-1 col-form-label" style="width: 20px;">S1</label>
                                <div class="col-sm-4">
                                    <input type="text" class="col-sm-8" name ="ijazahS1" id="ijasahS1" style="width: 300px;" value="<?= old('ijazahS1', $result['ijazahS1']) ?>">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s1_univ" value="<?= old('s1_univ', $result['s1_univ']) ?>">
                                </div>

                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                <input type="number" style="width: 120px" pattern="[0-9]" class="form-control" name="s1_thn"
                                    value="<?= old('s1_thn', $result['s1_thn']) ?>" style="width: 120px"
                                    min="1900" max="2023" step="1" maxlength="4" onchange="MinLengthS1Year()" id="S1Year">
                                </div>
                                </div>

                            <div class="mb-3 row" style="margin-left:30px; width: 300px;">
                                <select class="form-control" id="jurS1" onchange="jurusanStrata1()">
                                    <?php foreach ($jurusan as $val) : ?>
                                        <option value="">Pilih jurusan...</option>
                                        <option value="<?= $val['id'] ?>"> <?= $val['jurusan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-1 row">
                                <br><label class="col-sm-1 col-form-label" style="width: 20px;">S2</label>
                                <div class="col-sm-4">
                                    <input type="text" class="col-sm-8" name="ijazahS2" id="ijasahS2" style="width: 300px;" value="<?= old('ijazahS2', $result['ijazahS2']) ?>">
                                </div>

                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s2_univ" value="<?= old('s2_univ', $result['s2_univ']) ?>">
                                </div>
                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="number" pattern="[0-9]" class="form-control" name="s2_thn"
                                    value="<?= old('s2_thn', $result['s2_thn']) ?>" style="width: 120px"
                                    min="1900" max="2023" step="1" maxlength="4" onchange="MinLengthS2Year()" id="S2Year">
                                </div>
                            </div>

                            <div class="mb-3 row" style="margin-left:30px; width: 300px;">
                                <select class="form-control" id="jurS2" onchange="jurusanStrata2()">
                                    <?php foreach ($jurusan as $val) : ?>
                                        <option value="">Pilih jurusan...</option>
                                        <option value="<?= $val['id'] ?>"> <?= $val['jurusan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-1 row">
                                <br><label class="col-sm-1 col-form-label" style="width: 20px;">S3</label>
                                <div class="col-sm-4">
                                    <input type="text" class="col-sm-8" name="ijazahS3" id="ijasahS3" style="width: 300px;" value="<?= old('ijazahS3', $result['ijazahS3']) ?>">
                                </div>

                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s3_univ" value="<?= old('s3_univ', $result['s3_univ']) ?>">
                                </div>

                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    
                                    <input type="number" pattern="[0-9]" class="form-control" name="s3_thn"
                                     value="<?= old('s3_thn', $result['s3_thn']) ?>" style="width: 120px"
                                     min="1900" max="2023" step="1" maxlength="4" onchange="MinLengthS3Year()" id="S3Year">
                                </div>
                            </div>

                            <div class="mb-3 row" style="margin-left:30px; width: 300px;">
                                <select class="form-control" id="jurS3" onchange="jurusanStrata3()">
                                    <?php foreach ($jurusan as $val) : ?>
                                        <option value="">Pilih jurusan...</option>
                                        <option value="<?= $val['id'] ?>"> <?= $val['jurusan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="input-group mb-3">
                                <label class="input-group-text" style="width: 100px;" id="sipp">Nomor SIPP</label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="sipp" value="<?= old('sipp', $result['sipp']) ?>" />
                                <label class="input-group-text" id="sipp_ed">Tgl. kadaluarsa</label>
                                <input type="text" class="input-group-text" name="sipp_ed" id="sipp_ed_ID" value="<?= old('sipp_ed', $result['sipp_ed']) ?>" />
                                <input type="date" class="input-group-text" id="Tgl_SIPP" onchange="Ubah_SIPP_ED()" />

                            </div>

                            <div class="input-group mb-3">
                                <label class="input-group-text" style="width: 100px;" id="str">Nomor STR </label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="str" value="<?= old('str', $result['str']) ?>" />
                                <label class="input-group-text" id="str_ed">Tgl. kadaluarsa</label>
                                <input type="text" class="input-group-text" name="str_ed" id="str_ed_ID" value="<?= old('str_ed', $result['str_ed']) ?>" />
                                <input type="date" class="input-group-text" id="Tgl_STR" onchange="Ubah_STR_ED()" />
                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text" style="width: 100px;" id="kta">Nomor KTA </label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="kta" value="<?= old('kta', $result['kta']) ?>" />
                                <label class="input-group-text" id="kta_ed">Tgl. kadaluarsa</label>
                                <input type="text" class="input-group-text" name="kta_ed" id="kta_ed_ID" value="<?= old('kta_ed', $result['kta_ed']) ?>" />
                                <input type="date" class="input-group-text" id="Tgl_KTA" onchange="Ubah_KTA_ED()" />
                            </div>
                            <div class="mb-3">
                                <br><label class="col-sm-2" id="asosiasi">Asosiasi</label>
                                <input type="text" class="col-sm-4" value="<?= old('asosiasi', $result['asosiasi']) ?>" name="asosiasi" id="asosi">
                                <select class="form-select form-select-sm-3" id="association" onchange="assoc()">
                                    <option selected>Pilih Asosiasi</option>
                                    <option value="Asosiasi Psikologi Industri dan Organisasi (APIO)">Asosiasi Psikologi Industri dan Organisasi (APIO)</option>
                                    <option value="Himpunan Psikologi Indonesia (HIMPSI)">Himpunan Psikologi Indonesia (HIMPSI)</option>
                                    <option value="Asosiasi Psikologi Forensik(APSIFOR)">Asosiasi Psikologi Forensik(APSIFOR)</option>
                                    <option value="Ikatan Psikolog Klinis(IPK)">Ikatan Psikolog Klinis(IPK)</option>
                                    <option value="IIkatan Psikologi Pendidikan Indonesia(IPPI)">Ikatan Psikologi Pendidikan Indonesia(IPPI)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <br><label class="col-sm-2">Status kepegawaian </label>
                                <input type="text" class="col-sm-6" name="status" value="<?= old('status', $result['status']) ?>">
                            </div>
                            <br>
                            <br>
                            <div class="mb-3">
                                <?php
                                    $ref = isset($result['ref']) ? $result['ref'] : '';
                                ?>
                                <label class="col-sm-2">Referensi</label>
                                <input type="text" readonly class="col-sm-4" name="oldref" value="<?= $ref; ?>" />
                                <input type="file" class="col-sm-6" name="ref" id="ref">
                                <br>
                            </div>

                            <br>
                            <div class="modal-footer">
                                <a href="/ta" class="btn btn-primary m-2" style="height: 35px; width: 90px">
                                <i class="fa-solid fa-circle-left"></i></i>Kembali</a>
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
    function MinLengthS3Year() {
        const thnS3 = document.getElementById("S3Year").value;
        if (thnS3.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("S3Year").focus();
        }
        return false;
    }
    function MinLengthS2Year() {
        const thnS2 = document.getElementById("S2Year").value;
        if (thnS2.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("S2Year").focus();
        }
        return false;
    }
    function MinLengthS1Year() {
        const thnS1 = document.getElementById("S1Year").value;
        if (thnS1.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("S1Year").focus();
        }
        return false;
    }
    function assoc() {
        const sel = document.getElementById("association");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("asosi").value = teks;
    }
    function positions() {
       // alert('Hai');
       // id="posisinya" id="pos" onchange="positions()"
        let posi = document.getElementById('pos').value;
        document.getElementById('posisinya').value = posi;
    };
    function categories() {
        let posi = document.getElementById('category').value;
        document.getElementById('ctg').value = posi;
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

    function Ubah_CIPA_ED() {
        const tgl = new Date(document.getElementById('Tgl_CIPA').value);
        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let tanggal = tgl.getDate();
        let formattedMySQL = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('cipa_Kadal').value = formattedMySQL;
    }


    function jurusanStrata1() {
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