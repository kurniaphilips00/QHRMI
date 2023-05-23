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
                        <h2>Form Tambah Data</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('bukan-pdf')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('bukan-pdf');  
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('add-failed')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('add-failed');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('add-success')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('add-success');  
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('/ta/tambah') ?>" method="post" enctype="multipart/form-data" id="form">
                            <?= csrf_field(); ?>

                            <div class="mb-1 row">
                                <label class="col-sm-3 col-form-label">Kode </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="kode_ta" value="<?= $kode; ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Personil</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Nama Personil">
                                    <?php if ($validation->hasError('nama')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('nama') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="perusahaan" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="perusahaan" value="PT. Quantum HRM Internasional" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-3 col-form-label">Posisi yang diusulkan</label>

                                <div class="col-sm-8">
                                    <select class="form-control" id="pos" name="posisi" onchange="positions()">
                                        <option value="">Pilih posisi</option>
                                        <?php foreach ($posisi as $val) : ?>
                                            <option value="<?= $val['posisitugas'] ?>"> <?= $val['posisitugas'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">Kategori</label>

                                <div class="col-sm-8">
                                    <select class="form-control" onchange="categories()" id="category" name="kategori">
                                        <option value="">Pilih kategori</option>
                                        <?php foreach ($kategori as $val) : ?>
                                            <option value="<?= $val['kategori'] ?>"> <?= $val['kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="tgl" class="col-sm-3 col-form-label">Tgl. lahir</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="new_ttl" id="new_tgl_lahir" onchange="tampil()" />
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" class="form-control" name="tgl_lahir" id="MySQL_tgl" />
                                </div>

                                <label for="usia" class="col-sm-1 col-form-label">Usia</label>
                                <div class="col-sm-1">
                                    <input type="text" readonly class="form-control" name="usia" id="umur">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-3">Alamat</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?= old('alamat') ?>" placeholder="Alamat">
                                </div>
                                <label for="kota" class="col-sm-1" style="width:50px">Kota</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kota" id="kota" style="width:200px" value="<?= old('kota') ?>" placeholder="Kota">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">No. KTP</label>
                                <div class="col-sm-3">
                                    <input type="number" pattern="[0-9]" minlength="15" class="form-control" name="no_ktp" id="KTP" placeholder="KTP" onchange="MinKTPLength()">
                                </div>
                                <label class="col-sm-2" id="no_npwp">No. telp</label>
                                <div class="col-sm-3">
                                    <input type="number" pattern="[0-9]" minlength="10" class="form-control" name="no_telp" id="No_Telp" value="<?= old('no_telp') ?>" onchange="MinTelpLength()" placeholder="Telp">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3">No. HP</label>
                                <div class="col-sm-3">
                                    <input type="number" pattern="[0-9]" minlength="10" class="form-control" name="no_hp" id="No_HP" placeholder="HP" onchange="MinHPLength()">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3">No. NPWP</label>
                                <label class="col-sm-7">
                                    <input name="no_npwp1" type="tel" pattern="[0-9]{2}" placeholder="__" aria-label="2-digit nomor" size="1" />
                                    .<input name="no_npwp2" pattern="[0-9]{3}" placeholder="___" aria-label="3-digit nomor" size="2" />.<input name="no_npwp3" pattern="[0-9]{3}" placeholder="___" aria-label="3-digit nomor" size="3" />-<input name="no_npwp4" pattern="[0-9]{1}" placeholder="_" aria-label="1-digit nomor" size="1" />.<input name="no_npwp5" pattern="[0-9]{3}" placeholder="___" aria-label="3-digit nomor" size="3" />.<input name="no_npwp6" pattern="[0-9]{3}" placeholder="___" aria-label="3-digit nomor" size="3" />( contoh format : 12.456.789-1.234.123 )
                                </label>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3">E-mail</label>
                                <div class="col-sm-5">
                                    <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                    <!--
                                    <input type="text" class="form-control" name="email" value="<?= old('email') ?>" placeholder="eMail">
                                    -->
                                </div><br>
                                <br>
                            </div>
                            <div class="mb-3 row">

                                <label class="col-sm-2 col-form-label" style="width: 120px;">Pendidikan</label>
                            </div>
                            <br>
                            <div class="mb-1 row">
                                <label class="col-sm-1 col-form-label" style="width: 20px;">S1</label>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ijazahS1" id="ijasahS1" value="<?= old('ijazahS1') ?>" placeholder="Jurusan">
                                </div>

                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s1_univ" id="univS1" value="<?= old('s1_univ') ?>" placeholder="Universitas">
                                </div>

                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="number" pattern="[0-9]" style="width: 120px" ; min="1900" max="2023" step="1" maxlength="4" class="form-control" name="s1_thn" id="S1Year" value="<?= old('s1_thn') ?>" onchange="MinLengthS1Year()">
                                </div>
                            </div>
              
                            <div class="mb-1 mt-3 row">
                                <label class="col-sm-1 col-form-label" style="width: 20px;">S2</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ijazahS2" id="ijasahS2" value="<?= old('ijazahS2') ?>" placeholder="Jurusan">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s2_univ" id="univS2" value="<?= old('s2_univ') ?>" placeholder="Universitas">
                                </div>
                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="number" pattern="[0-9]" style="width: 120px" ; min="1900" max="2023" step="1" maxlength="4" class="form-control" name="s2_thn" id="S2Year" value="<?= old('s2_thn') ?>" onchange="MinLengthS2Year()">
                                </div>
                            </div>
             
                            <div class="mb-1 row">
                                <label class="col-sm-1 col-form-label" style="width: 20px;">S3</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ijazahS3" id="ijasahS3" value="<?= old('ijazahS3') ?>" placeholder="Jurusan">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="s3_univ" id="univS3" value="<?= old('s3_univ') ?>" placeholder="Universitas">
                                </div>

                                <label class="col-sm-1 col-form-label" style="width: 120px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="number" pattern="[0-9]" style="width: 120px" ; min="1900" max="2023" step="1" maxlength="4" class="form-control" name="s3_thn" id="S3Year" value="<?= old('s3_thn') ?>" onchange="MinLengthS3Year()">
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <br><label class="input-group-text" style="width: 100px;" id="sipp">Nomor SIPP</label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="sipp" value="<?= old('sipp') ?>" placeholder="SIPP">
                                <label class="input-group-text" id="sipp_ed">Tgl. kadaluarsa</label>
                                <input type="date" class="input-group-text" id="Tgl_SIPP" onchange="Ubah_SIPP_ED()" />
                                <input type="hidden" class="input-group-text" name="sipp_ed" id="sipp_ed_ID">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" style="width: 100px;" id="str">Nomor STR</label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="str" value="<?= old('str') ?>" placeholder="STR">
                                <label class="input-group-text" id="str_ed">Tgl. kadaluarsa</label>
                                <input type="date" class="input-group-text" id="Tgl_STR" onchange="Ubah_STR_ED()" />
                                <input type="hidden" class="input-group-text" name="str_ed" id="str_ed_ID">

                            </div>

                            <div class="input-group mb-1">
                                <label class="input-group-text" style="width: 100px;" id="kta">Nomor KTA</label>
                                <input type="text" class="input-group-text" style="margin-right: 20px;" name="kta" value="<?= old('str') ?>" placeholder="KTA">
                                <label class="input-group-text" id="kta_ed">Tgl. kadaluarsa</label>
                                <input type="date" class="input-group-text" id="Tgl_KTA" onchange="Ubah_KTA_ED()" />
                                <input type="hidden" class="input-group-text" name="kta_ed" id="kta_ed_ID">

                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" style="width: 100px;">Asosiasi</label>

                                <select class="form-select" name="asosiasi" id="association" onchange="assoc()">
                                    <option selected>Pilih Asosiasi</option>
                                    <option value="Asosiasi Psikologi Industri dan Organisasi (APIO)">Asosiasi Psikologi Industri dan Organisasi (APIO)</option>
                                    <option value="Himpunan Psikologi Indonesia (HIMPSI)">Himpunan Psikologi Indonesia (HIMPSI)</option>
                                    <option value="Asosiasi Psikologi Forensik(APSIFOR)">Asosiasi Psikologi Forensik(APSIFOR)</option>
                                    <option value="Ikatan Psikolog Klinis(IPK)">Ikatan Psikolog Klinis(IPK)</option>
                                    <option value="IIkatan Psikologi Pendidikan Indonesia(IPPI)">Ikatan Psikologi Pendidikan Indonesia(IPPI)</option>
                                </select>
                            </div>
                            <br>


                            <div class="mb-3 row">
                                <label class="col-sm-3" id="status" style="width: 295px;">Status kepegawaian</label>
                                <select class="form-select" name="status" style="width: 215px;">
                                    <option selected>Pilih Status</option>
                                    <option value="Tetap">Tetap</option>
                                    <option value="Tidak Tetap">Tidak Tetap</option>
                                </select>

                            </div>

                            <div class="mb-3 row">

                                <label for="ref" class="col-sm-3">Pilih file referensi(file PDF)</label>
                                <div class="col-sm-8">
                                    <input type="file" style="width: 500px;" class="form-control" name="ref" id="ref" 
                                    accept="application/pdf">
                                </div>
                            </div>
                             <div class="modal-footer">
                                <a href="/ta" class="btn btn-primary m-2" style="height: 35px; width: 90px">
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
    function previewSIPP() {
        const gbr = document.querySelector('#img_SIPP');
        const prev = document.querySelector('.gbr_SIPP');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(gbr.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }

    function previewSTR() {
        const gbr = document.querySelector('#img_STR');
        const prev = document.querySelector('.gbr_STR');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(gbr.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }

    function previewNPWP() {
        const gbr = document.querySelector('#img_NPWP');
        const prev = document.querySelector('.gbr_NPWP');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(gbr.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }

    function previewKTA() {
        const gbr = document.querySelector('#img_KTA');
        const prev = document.querySelector('.gbr_KTA');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(gbr.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }

    function previewKTP() {
        const pict = document.querySelector('#img_KTP');
        const prev = document.querySelector('.gbr_KTP');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(pict.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }

    function MinLengthS1Year() {
        const thnS1 = document.getElementById("S1Year").value;
        if (thnS1.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("S1Year").focus();
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

    function MinLengthS3Year() {
        const thnS3 = document.getElementById("S3Year").value;
        if (thnS3.length != 4) {
            confirm('Jumlah digit tidak sama dengan 4')
            document.getElementById("S3Year").focus();
        }
        return false;
    }

    function MinTelpLength() {
        const notelp = document.getElementById("No_Telp").value;
        if (notelp.length < 10) {
            confirm('Jumlah digit angka lebih kecil dari 10')
            document.getElementById("No_Telp").focus();
        }
        return false;
    }

    function MinHPLength() {
        const nohp = document.getElementById("No_HP").value;
        if (nohp.length < 10) {
            confirm('Jumlah digit angka lebih kecil dari 10')
            document.getElementById("No_HP").focus();
        }
        return false;
    }

    function MinKTPLength() {
        const noktp = document.getElementById("KTP").value;
        if (noktp.length < 15) {
            confirm('Jumlah digit angka lebih kecil dari 15')
            document.getElementById("KTP").focus();
        }
        return false;
    }

    function assoc() {
        const sel = document.getElementById("association");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("asosi").value = teks;
    }

    function positions() {
        let posi = document.getElementById('pos').value;
        document.getElementById('posisinya').value = posi;
    };

    function categories() {
        let posi = document.getElementById('category').value;
        document.getElementById('ctg').value = posi;
    };

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

    function tampil() { //Menghitung usia
        const tgl = new Date(document.getElementById('new_tgl_lahir').value);
        var diff_ms = Date.now() - tgl;
        var age_dt = new Date(diff_ms);
        document.getElementById('umur').value = Math.abs(age_dt.getUTCFullYear() - 1970);
        month = '' + (tgl.getMonth() + 1),
            day = '' + tgl.getDate(),
            year = tgl.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        document.getElementById('MySQL_tgl').value = [year, month, day].join('-');
    }

    function jurusanStrata1() {
        var sel = document.getElementById("jurS1");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS1").value = teks;
    }

    function jurusanStrata2() {
        // alert('Halo');
        var sel = document.getElementById("jurS2");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS2").value = teks;
    }

    function jurusanStrata3() {
        var sel = document.getElementById("jurS3");
        var teks = sel.options[sel.selectedIndex].text;
        document.getElementById("ijasahS3").value = teks;
    }
</script>

<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    /*An array containing all the country names in the world:*/
    var jur = ['Administrasi Keuangan (Perkantoran, Pajak, Hotel, Logistik, dll)',
        'Administrasi Pendidikan (Manajemen Pendidikan)',
        'Administrasi Rumah Sakit',
        'Agama (Filsafat) Hindu, Budha, dan Lain Yang Belum Tercantum',
        'AGAMA DAN FILSAFAT', 'Agama Islam', 'Agama Katolik', 'Agama Kristen dan Teologia',
        'Agribisnis', 'Akuntansi', 'Akupunktur', 'Analis Medis', 'Analisis Farmasi dan Kimia Medisinal',
        'Anestesi', 'Antropologi', 'Antropologi Tari', 'Arkeologi', 'Astronomi', 'Asuransi Niaga (Kerugian)',
        'Bedah (Umum, Plastik, Orthopaedi, Urologi, dll)', 'Bedah Mulut', 'Bidang Ekonomi Lain Yang Belum Tercantum',
        'Bidang Geofisika Lain yang Belum Tercantum', 'Bidang Ilmu Bahasa Lain Yang Belum Tercantum',
        'Bidang Ilmu Kedokteran Gigi Lain Yang Belum Tercantum', 'Bidang Ilmu Kedokteran Lain Yang Belum Tercantum',
        'Bidang Ilmu Kesenian Lain Yang Belum Tercantum', 'Bidang Ilmu Politik Lain Yang Belum Tercantum',
        'Bidang Ipa Lain Yang Belum Tercantum', 'Bidang Kedokteran Hewan Lain yang Belum Tercantum',
        'Bidang Kedokteran Spesialis Lain Yang Tercantum', 'Bidang Kehutanan Lain Yang Belum Tercantum',
        'Bidang Keperawatan & Kebidanan Lain Yang Belum Tercantum', 'Bidang Kesehatan Umum Lain Yang Belum Tercantum',
        'Bidang Keteknikan Industri Lain Yang Belum Tercantum',
        'Bidang Manajemen Yang Belum Tercantum',
        'Bidang Matematika Lain yang Belum Tercantum',
        'Bidang Media Lain Yang Belum Tercantum',
        'Bidang Pend. Teknologi dan Kejuruan Lain yang Belum Tercantum',
        'Bidang Pendidikan Bahasa (dan Satra) Lain Yang Belum Tercantum',
        'Bidang Pendidikan Ilmu Sosial Lain Yang Belum Tercantum',
        'Bidang Pendidikan Kesenian Lain Yang Belum Tercantum',
        'Bidang Pendidikan Lain Yang Belum Tercantum',
        'Bidang Perikanan Lain Yang Belum Tercantum',
        'Bidang Perkapalan Lain Yang Belum Tercantum',
        'Bidang Pertanian & Perkebunan Lain yang Belum Tercantum',
        'Bidang Peternakan Lain Yang Belum Tercantum',
        'Bidang Psikologi Lain Yang Belum Tercantum',
        'Bidang Sastra (dan Bahasa) Asing Lain Yang Belum Tercantum',
        'Bidang Seni Kriya Lain Yang Belum Tercantum',
        'Bidang Sosial Lain Yang Belum Tercantum',
        'Bidang Sosiologi Pertanian Lain Yang Belum Tercantum',
        'Bidang Spesialis Kedokteran Gigi Lain Yang Belum Tercantum',
        'Bidang Teknik Elektro dan Informatika Lain Yang Belum Tercantum',
        'Bidang Teknik Sipil Lain Yang Belum Tercantum',
        'Bidang Teknologi Dalam Ilmu Tanaman yang Belum Tercantum',
        'Bidang Teknologi Kebumian Lain Yang Belum Tercantum',
        'Bimbingan dan Konseling',
        'Biologi (dan Bioteknologi Umum)',
        'Biologi Farmasi',
        'Biologi Reproduksi',
        'Bioteknologi Dalam Industri',
        'Bioteknologi Perikanan',
        'Bioteknologi Pertanian dan Perkebunan',
        'Bioteknologi Peternakan',
        'Broadcasting (Penyiaran)',
        'Budidaya Kehutanan',
        'Budidaya Perairan',
        'Budidaya Perikanan',
        'Budidaya Pertanian dan Perkebunan',
        'Budidaya Ternak',
        'DESAIN',
        'Desain Interior',
        'Desain Komunikasi Visual',
        'Desain Produk',
        'Ekonomi Pembangunan',
        'Ekonomi Pertanian',
        'Ekonomi Syariah',
        'Entomologi (Kesehatan, Fitopatologi)',
        'Epidemiologi',
        'Ergonomi Fisiologi Kerja',
        'Etnomusikologi',
        'Farmakologi dan Farmasi Klinik',
        'Farmasetika dan Teknologi Farmasi',
        'Farmasi Lain Yang Belum Tercantum',
        'Farmasi Makanan dan Analisis Keamanan Pangan',
        'Farmasi Umum dan Apoteker',
        'Filsafat',
        'Filsafat Lain Yang Belum Tercantum',
        'Fisika',
        'Fisiologi (Keolahragaan)',
        'Fisioterapi',
        'Fotografi',
        'Geofisika',
        'Geografi',
        'Geologi',
        'Gizi Masyarakat dan Sumber Daya Keluarga',
        'Grafika (dan Penerbitan)',
        'Hortikultura',
        'Hubungan Internasional',
        'Humaniora',
        'Ilmu Administrasi (Niaga, Negara, Publik, Pembangunan, Dll)',
        'Ilmu Asuransi Jiwa dan Kesehatan',
        'ILMU BAHASA',
        'ILMU BAHASA ASING',
        'Ilmu Biologi Reproduksi',
        'Ilmu Biomedik',
        'ILMU EKONOMI',
        'ILMU FARMASI',
        'ILMU FILSAFAT',
        'Ilmu Gizi',
        'Ilmu Hama dan Penyakit Tanaman',
        'ILMU HEWANI',
        'Ilmu Hukum',
        'ILMU IPA',
        'ILMU KEDOKTERAN',
        'ILMU KEDOKTERAN (AKADEMIK)',
        'Ilmu Kedokteran Dasar',
        'Ilmu Kedokteran Dasar & Biomedis',
        'Ilmu Kedokteran Fisik dan Rehabilitasi',
        'Ilmu Kedokteran Gigi',
        'ILMU KEDOKTERAN GIGI (AKADEMIK)',
        'Ilmu Kedokteran Gigi Dasar',
        'Ilmu Kedokteran Gigi Komunitas',
        'Ilmu Kedokteran Gigi Komunitas',
        'ILMU KEDOKTERAN HEWAN',
        'Ilmu Kedokteran Keluarga',
        'Ilmu Kedokteran Klinik',
        'Ilmu Kedokteran Nuklir',
        'ILMU KEDOKTERAN SPESIALIS',
        'Ilmu Kedokteran Tropis',
        'Ilmu Kedokteran Umum',
        'ILMU KEHUTANAN',
        'Ilmu Keolahragaan',
        'Ilmu Keperawatan',
        'ILMU KEPERAWATAN DAN KEBIDANAN',
        'Ilmu Kepolisian',
        'ILMU KESEHATAN',
        'ILMU KESEHATAN UMUM',
        'Ilmu Kesejahteraan Sosial',
        'ILMU KESENIAN',
        'ILMU KETEKNIKAN INDUSTRI',
        'Ilmu Komputer',
        'Ilmu Komunikasi',
        'Ilmu Linguistik',
        'ILMU MANAJEMEN',
        'ILMU MEDIA',
        'Ilmu Olah Raga',
        'Ilmu Pangan',
        'Ilmu Pemerintahan',
        'ILMU PENDIDIKAN',
        'ILMU PENDIDIKAN BAHASA DAN SASTRA',
        'ILMU PENDIDIKAN KESENIAN',
        'ILMU PENDIDIKAN MATEMATIKA DAN ILMU PENGETAHUAN ALAM (MIPA)',
        'ILMU PENDIDIKAN OLAH RAGA DAN KESEHATAN',
        'ILMU PENDIDIKAN TEKNOLOGI DAN KEJURUAN',
        'ILMU PENGETAHUAN (ILMU) AGAMA',
        'ILMU PERIKANAN',
        'ILMU PERKAPALAN',
        'Ilmu Perpustakaan',
        'ILMU PERTANIAN DAN PERKEBUNAN',
        'Ilmu Peternakan',
        'Ilmu Politik',
        'ILMU PSIKOLOGI',
        'Ilmu Religi dan Budaya',
        'ILMU SENI KRIYA',
        'ILMU SENI PERTUNJUKAN',
        'ILMU SENI',
        'DESAIN DAN MEDIA',
        'ILMU SOSIAL',
        'Ilmu Sosial dan Politik',
        'ILMU SOSIAL HUMANIORA',
        'Ilmu Sosiatri',
        'ILMU SOSIOLOGI PERTANIAN',
        'ILMU SPESIALIS KEDOKTERAN GIGI DAN MULUT',
        'Ilmu Susastra Umum',
        'Ilmu Tanah',
        'ILMU TANAMAN',
        'ILMU TEKNIK',
        'Imunologi',
        'Jurnalistik',
        'Kajian Budaya',
        'Kajian Wilayah (Eropa, Asia, Jepang, Timur Tengah Dll)',
        'Kearsipan',
        'Kebidanan',
        'Kebidanan dan Penyakit Kandungan',
        'Kebijakan Kesehatan (dan Analis Kesehatan)',
        'Kebijakan Publik',
        'KEBUMIAN DAN ANGKASA',
        'Kedokteran Forensik',
        'Kedokteran Gigi',
        'Kedokteran Hewan',
        'Kedokteran Kerja',
        'Kedokteran Olahraga',
        'Kepariwisataan',
        'Kependudukan (Demografi, dan Ilmu Kependudukan Lain)',
        'Kesehatan Lingkungan',
        'Kesehatan Masyarakat',
        'Kesehatan Reproduksi',
        'Kesekretariatan',
        'Keselamatan dan Kesehatan Kerja (Kesehatan Kerja; Hiperkes)',
        'Ketahanan Nasional',
        'Kimia',
        'Komunikasi Penyiaran Islam',
        'Konservasi Gigi',
        'Konservasi Sumberdaya Hutan',
        'Kriminologi',
        'Kriya Kayu',
        'Kriya Keramik',
        'Kriya Kulit',
        'Kriya Logam (dan Logam Mulia/Perhiasan)',
        'Kriya Patung',
        'Kriya Tekstil',
        'Kurikulum dan Teknologi Pendidikan',
        'Manajemen',
        'Manajemen Hutan',
        'Manajemen Industri',
        'Manajemen Informatika',
        'Manajemen Syariah',
        'Manajemen Transportasi',
        'Matematika',
        'MATEMATIKA DAN ILMU PENGETAHUAN ALAM (MIPA)',
        'Mekanisasi Pertanian',
        'Meteorologi',
        'Mikrobiologi Klinik',
        'Neurologi',
        'Notariat',
        'Nutrisi dan Makanan Ikan',
        'Nutrisi dan Makanan Ternak',
        'Oceanograpi (Oceanologi)',
        'Ortodonsia',
        'Patologi Anatomi',
        'Patologi Klinik',
        'Pemanfaatan Sumberdaya Perikanan',
        'Pemasaran',
        'Pembangunan Peternakan',
        'Pemuliaan Tanaman',
        'Penciptaan Seni',
        'Pend. Kependudukan dan Lingkungan Hidup',
        'Pend. Teknologi dan Kejuruan',
        'Pendidikan Administrasi Perkantoran',
        'Pendidikan Akuntansi',
        'Pendidikan Anak Usia Dini',
        'Pendidikan Bahasa (dan Sastra) Arab',
        'Pendidikan Bahasa (dan Sastra) Cina (Mandarin)',
        'Pendidikan Bahasa (dan Sastra) Indonesia',
        'Pendidikan Bahasa (dan Sastra) Inggris',
        'Pendidikan Bahasa (dan Sastra) Jawa',
        'Pendidikan Bahasa (dan Sastra) Jerman',
        'Pendidikan Bahasa (dan Sastra) Perancis',
        'Pendidikan Bahasa Jepang',
        'Pendidikan Bahasa, Sastra Indonesia dan Daerah',
        'Pendidikan Biologi',
        'Pendidikan Ekonomi',
        'Pendidikan Ekonomi Koperasi',
        'Pendidikan Fisika',
        'Pendidikan Geografi',
        'Pendidikan Ilmu Pengetahuan Alam (Sains)',
        'PENDIDIKAN ILMU SOSIAL',
        'Pendidikan Jasmani dan Kesehatan',
        'Pendidikan Jasmani, Kesehatan dan Rekreasi',
        'Pendidikan Kepelatihan Olahraga',
        'Pendidikan Kesejahteraan Keluarga (Tataboga, Busana, Rias Dll)',
        'Pendidikan Keterampilan dan Kerajinan',
        'Pendidikan Kimia',
        'Pendidikan Koperasi',
        'Pendidikan Luar Biasa',
        'Pendidikan Luar Sekolah',
        'Pendidikan Matematika',
        'Pendidikan Mipa Lain Yang Belum Tercantum',
        'Pendidikan Olah Raga dan Kesehatan Lain Yang Belum Tercantum',
        'Pendidikan Olahraga dan Kesehatan',
        'Pendidikan Pancasila dan Kewarganegaraan',
        'Pendidikan Sejarah',
        'Pendidikan Seni Drama, Tari dan Musik',
        'Pendidikan Seni Kerajinan',
        'Pendidikan Seni Musik',
        'Pendidikan Seni Rupa',
        'Pendidikan Seni Tari',
        'Pendidikan Sosiologi (Ilmu Sosial)',
        'Pendidikan Sosiologi dan Antropologi',
        'Pendidikan Tata Niaga',
        'Pendidikan Teknik Bangunan',
        'Pendidikan Teknik Elektro',
        'Pendidikan Teknik Elektronika',
        'Pendidikan Teknik Informatika',
        'Pendidikan Teknik Mesin',
        'Pendidikan Teknik Otomotif',
        'Penerbangan/Aeronotika dan Astronotika',
        'Pengembangan Kurikulum',
        'Penginderaan Jauh',
        'Pengolahan Hasil Perikanan',
        'Pengukuran dan Evaluasi Pendidikan',
        'Penyakit Anak',
        'Penyakit Dalam',
        'Penyakit Jantung',
        'Penyakit Kulit dan Kelamin',
        'Penyakit Mata',
        'Penyakit Mulut',
        'Penyakit Paru',
        'Penyakit Syaraf',
        'Penyakit THT',
        'Penyuluh Pertanian',
        'Perbankan',
        'Perencanaan Wilayah dan Kota',
        'Periodonsia',
        'Perkebunan',
        'Perpajakan',
        'PGSD',
        'Pgtk dan (Paud)',
        'Produksi dan Teknologi Pakan Ternak',
        'Produksi Ternak',
        'Promosi Kesehatan',
        'Prostodonsia',
        'Psikiatri',
        'Psikologi Anak',
        'Psikologi Kerja (Industri)',
        'Psikologi Masyarakat',
        'Psikologi Pendidikan',
        'Psikologi Umum',
        'Radiologi',
        'Rancang Kota',
        'Rehabilitasi Medik',
        'Reproduksi (Biologi dan Kesehatan)',
        'RUMPUN ILMU LAINNYA',
        'Sain Veteriner',
        'Sastra (dan Bahasa) Arab',
        'Sastra (dan Bahasa) Belanda',
        'Sastra (dan Bahasa) China (Mandarin)',
        'Sastra (dan Bahasa) Daerah (Jawa, Sunda, Batak Dll)',
        'Sastra (dan Bahasa) Indonesia',
        'Sastra (dan Bahasa) Indonesia Atau Daerah Lainnya',
        'Sastra (dan Bahasa) Inggris',
        'Sastra (dan Bahasa) Jepang',
        'Sastra (dan Bahasa) Jerman',
        'Sastra (dan Bahasa) Korea',
        'Sastra (dan Bahasa) Melayu',
        'Sastra (dan Bahasa) Perancis',
        'Sejarah (Ilmu Sejarah)',
        'Seni Grafis',
        'Seni Intermedia',
        'Seni Karawitan',
        'Seni Musik',
        'Seni Patung',
        'Seni Pedalangan',
        'Seni Pertunjukkan Lainnya yang Belum Disebut',
        'Seni Rupa Murni (seni lukis)',
        'Seni Teater',
        'Senitari',
        'Sistem Informasi',
        'Sosial Ekonomi Pertanian',
        'Sosial Ekonomi Perternakan',
        'Sosiologi',
        'Sosiologi Agama',
        'Sosiologi Pedesaan',
        'Statistik',
        'Studi Pembangunan (Perencanaan Pembangunan, Wilayah, Kota)',
        'SUB RMPUN ILMU SASTRA (DAN BAHASA) INDONESIA DAN DAERAH',
        'Sumberdaya Perairan',
        'Teknik (Industri) Farmasi',
        'Teknik Arsitektur',
        'Teknik Biomedika',
        'Teknik Elektro',
        'TEKNIK ELEKTRO DAN INFORMATIKA',
        'Teknik Elektronika',
        'Teknik Enerji',
        'Teknik Fisika',
        'Teknik Geodesi',
        'Teknik Geofisika',
        'Teknik Geologi',
        'Teknik Geomatika',
        'Teknik Industri',
        'Teknik Informatika',
        'Teknik Kelautan dan Ilmu Kelautan',
        'Teknik Kendali (Atau Instrumentasi dan Kontrol)',
        'Teknik Kimia',
        'Teknik Komputer',
        'Teknik Lingkungan',
        'Teknik Material (Ilmu Bahan)',
        'Teknik Mekatronika',
        'Teknik Mesin (dan Ilmu Permesinan Lain)',
        'Teknik Nuklir (dan Atau Ilmu Nuklir Lain)',
        'Teknik Panas Bumi',
        'Teknik Pengairan',
        'Teknik Penyehatan Lingkungan',
        'Teknik Perangkat Lunak',
        'Teknik Perkapalan',
        'Teknik Permesinan Kapal',
        'Teknik Perminyakan (Perminyakan)',
        'Teknik Pertambangan (Rekayasa Pertambangan)',
        'Teknik Pertekstilan (Tekstil)',
        'Teknik Produksi (dan Atau Manufakturing)',
        'Teknik Refrigerasi',
        'Teknik Sipil',
        'TEKNIK SIPIL DAN PERENCANAAN TATA RUANG',
        'Teknik Sistem Perkapalan',
        'Teknik Telekomunikasi',
        'Teknik Tenaga Elektrik',
        'Teknologi Alat Berat',
        'TEKNOLOGI DALAM ILMU TANAMAN',
        'Teknologi Hasil Hutan',
        'Teknologi Hasil Pertanian',
        'Teknologi Hasil Ternak',
        'Teknologi Industri Pertanian (dan Agroteknologi)',
        'Teknologi Informasi',
        'TEKNOLOGI KEBUMIAN',
        'Teknologi Pangan dan Gizi',
        'Teknologi Pasca Panen',
        'Teknologi Penangkapan Ikan',
        'Teknologi Pendidikan',
        'Teknologi Perkebunan',
        'Teknologi Pertanian',
        'Televisi',
        'Transportasi'
    ]

    var akd = ['Akademi Akuntansi Lampung', 'Akademi Akuntansi YKPN',
        'Akademi Farmasi Jember', 'Akademi Farmasi Samarinda', 'Akademi Farmasi Surabaya',
        'Akademi Kebidanan Abdi Persada Banjarmasin',
        'Akademi Kebidanan Abdurahman',
        'Akademi Kebidanan Alifah Padang',
        'Akademi Kebidanan Anugerah Bintan',
        'Akademi Kebidanan Ar-Rum Salatiga',
        'Akademi Kebidanan As-Syifa Kisaran',
        'Akademi Kebidanan Bakti Utama Pati',
        'Akademi Kebidanan Dehasen Bengkulu',
        'Akademi Kebidanan Dharma Husada Kediri',
        'Akademi Kebidanan Graha Mandiri Cilacap',
        'Akademi Kebidanan Hafsyah Medan',
        'Akademi Kebidanan Harapan Keluarga',
        'Akademi Kebidanan Jember',
        'Akademi Kebidanan Kartini',
        'Akademi Kebidanan Muhammadiyah Cirebon',
        'Akademi Kebidanan Palapa Husada',
        'Akademi Kebidanan Panca Bhakti Pontianak',
        'Akademi Kebidanan Sumatera Barat',
        'Akademi Kebidanan Ummi Khasanah',
        'Akademi Kebidanan Yogyakarta',
        'Akademi Keperawatan Dian Husada',
        'Akademi Keperawatan Dirgahayu Samarinda',
        'Akademi Keperawatan Intan Martapura',
        'Akademi Keperawatan Notokusumo',
        'Akademi Keperawatan Pamenang',
        'Akademi Keperawatan Panti Kosala Surakarta',
        'Akademi Keperawatan Panti Waluya',
        'Akademi Keperawatan Sehat Binjai',
        'Akademi Kepolisian',
        'Akademi Komunikasi Bina Sarana Informatika Jakarta',
        'Akademi Manajemen Informatika dan Komputer BSI Bekasi',
        'Akademi Manajemen Informatika dan Komputer BSI Bogor',
        'Akademi Manajemen Informatika dan Komputer BSI Jakarta',
        'Akademi Manajemen Informatika dan Komputer Jakarta',
        'Akademi Maritim Indonesia Medan',
        'Akademi Maritim Nusantara Cilacap',
        'Akademi Maritim Yogyakarta',
        'Akademi Militer Magelang',
        'Akademi Pariwisata dan Perhotelan Darma Agung Medan',
        'Akademi Pariwisata Majapahit',
        'Akademi Pelayaran Niaga Indonesia Semarang',
        'Akademi Perekam Medik dan Informasi kesehatan Imel',
        'Akademi Perpajakan Tridarma Lampung',
        'Akademi Refraksi Optisi Binalita Sudama',
        'Akademi Statistika Muhammadiyah Semarang',
        'Akademi Teknik dan Keselamatan Penerbangan Medan',
        'Akademi Teknik Soroako',
        'IAIN Palopo',
        'IKIP Mataram',
        'Institut Agama Islam Al Muslim Aceh',
        'Institut Agama Islam Imam Ghozali Cilacap',
        'Institut Agama Islam Negeri Ambon',
        'Institut Agama Islam Negeri Batusangkar',
        'Institut Agama Islam Negeri Bengkulu',
        'Institut Agama Islam Negeri Bukittinggi',
        'Institut Agama Islam Negeri Jember',
        'Institut Agama Islam Negeri Metro',
        'Institut Agama Islam Negeri Padangsidempuan',
        'Institut Agama Islam Negeri Palangkaraya',
        'Institut Agama Islam Negeri Palu',
        'Institut Agama Islam Negeri Ponorogo',
        'Institut Agama Islam Negeri Samarinda',
        'Institut Agama Islam Negeri Sultan Amai Gorontalo',
        'Institut Agama Islam Negeri Surakarta',
        'Institut Agama Islam Negeri Syekh Nurjati Cirebon',
        'Institut Agama Islam Negeri Tulungagung',
        'Institut Bisnis dan Informatika STIKOM Surabaya',
        'Institut Ilmu Sosial dan Manajemen STIAMI Jakarta',
        'Institut Keguruan dan Ilmu Pendidikan Budi Utomo',
        'Institut Keguruan dan Ilmu Pendidikan PGRI Bali',
        'Institut Keguruan dan Ilmu Pendidikan PGRI Jember',
        'Institut Keguruan dan Ilmu Pendidikan PGRI Kalimantan',
        'Institut Keguruan dan Ilmu Pendidikan PGRI Pontianak',
        'Institut Keguruan dan Ilmu Pendidikan Saraswati',
        'Institut Kesehatan Deli Husada Deli Tua',
        'Institut Kesehatan Helvetia, Medan',
        'Institut Keuangan Perbankan dan Informatika Asia',
        'Institut Pemerintahan Dalam Negeri',
        'Institut Pertanian Bogor',
        'Institut Pertanian STIPER',
        'Institut Sains dan Teknologi AKPRINDO',
        'Institut Sains dan Teknologi Nasional',
        'Institut Seni Indonesia Denpasar',
        'Institut Seni Indonesia Padang Panjang',
        'Institut Seni Indonesia Surakarta',
        'Institut Seni Indonesia Yogyakarta',
        'Institut Studi Islam Darussalam Gontor',
        'Institut Teknologi Bandung',
        'Institut Teknologi Budi Utomo',
        'Institut Teknologi Indonesia',
        'Institut Teknologi Nasional Bandung',
        'Institut Teknologi Nasional Malang',
        'Institut Teknologi Padang',
        'Institut Teknologi Sepuluh Nopember',
        'Politeknik Aceh',
        'Politeknik ATMI',
        'Politeknik Caltex',
        'Politeknik Elektronika Negeri Surabaya',
        'Politeknik Ilmu Pelayaran Makassar',
        'Politeknik Kelautan dan Perikanan Bitung',
        'Politeknik Kemenkes Bengkulu',
        'Politeknik Kesehatan Bhakti Setya Indonesia',
        'Politeknik Kesehatan Jakarta',
        'Politeknik Kesehatan Kemenkes Bandung',
        'Politeknik Kesehatan Kemenkes Denpasar',
        'Politeknik Kesehatan Kemenkes Jakarta',
        'Politeknik Kesehatan Kemenkes Makassar',
        'Politeknik Kesehatan Kemenkes Malang',
        'Politeknik Kesehatan Kemenkes Manado',
        'Politeknik Kesehatan Kemenkes Surakarta',
        'Politeknik Kesehatan Kemenkes Tanjungkarang',
        'Politeknik Kesehatan Kemenkes Tasikmalaya',
        'Politeknik Kesehatan Kementerian Kesehatan Kupang',
        'Politeknik Kesehatan Kementerian Kesehatan Semarang',
        'Politeknik Kesehatan Kementerian Kesehatan Surabaya',
        'Politeknik Kesehatan TNI AU Ciumbuleuit',
        'Politeknik LP3i Medan',
        'Politeknik Manufaktur Astra',
        'Politeknik Maritim AMI Makassar',
        'Politeknik Negeri Ambon',
        'Politeknik Negeri Bali',
        'Politeknik Negeri Bandung',
        'Politeknik Negeri Batam',
        'Politeknik Negeri Jakarta',
        'Politeknik Negeri Jember',
        'Politeknik Negeri Lampung',
        'Politeknik Negeri Lhokseumawe',
        'Politeknik Negeri Malang',
        'Politeknik Negeri Medan',
        'Politeknik Negeri Padang',
        'Politeknik Negeri Pontianak',
        'Politeknik Negeri Samarinda',
        'Politeknik Negeri Semarang',
        'Politeknik Negeri Sriwijaya',
        'Politeknik Negeri Tanah Laut',
        'Politeknik Negeri Ujung Pandang',
        'Politeknik Perdamaian Halmahera',
        'Politeknik Perkapalan Negeri Surabaya',
        'Politeknik Pertanian Negeri Kupang',
        'Politeknik Pertanian Negeri Pangkajene dan Kepulauan Riau',
        'Politeknik Pertanian Negeri Payakumbuh',
        'Politeknik STMI Jakarta',
        'Politeknik Teknologi Kimia Industri',
        'Politeknik Ubaya',
        'Poltekkes Kemenkes Jakarta',
        'Poltekkes Kemenkes Kalimantan Timur',
        'Poltekkes Kemenkes Mataram',
        'Poltekkes Kemenkes Padang',
        'Poltekkes Kemenkes Pontianak',
        'Sekolah Tinggi Agama Buddha Negeri Sriwijaya',
        'Sekolah Tinggi Agama Buddha Syailendra',
        'Sekolah Tinggi Agama Hindu Dharma Nusantara Jakarta',
        'Sekolah Tinggi Agama Islam Al-Azhar Menganti Gresik',
        'Sekolah Tinggi Agama Islam AlHikmah Jakarta',
        'Sekolah Tinggi Agama Islam HM.Lukman Edy Pekanbaru',
        'Sekolah Tinggi Agama Islam Ibnu Sina Batam',
        'Sekolah Tinggi Agama Islam Ma`arif Magetan',
        'Sekolah Tinggi Agama Islam Muhammadiyah Klaten',
        'Sekolah Tinggi Agama Islam Negeri Kediri',
        'Sekolah Tinggi Agama Islam Negeri Pamekasan',
        'Sekolah Tinggi Agama Islam Negeri Pare-Pare',
        'Sekolah Tinggi Agama Islam Negeri Purwokerto',
        'Sekolah Tinggi Agama Islam Negeri Salatiga',
        'Sekolah Tinggi Agama Islam Negeri Watampone',
        'Sekolah Tinggi Agama Islam Pengembangan Ilmu AlQuran',
        'Sekolah Tinggi Agama Islam Rasyidiyah Khalidiyah',
        'Sekolah Tinggi Agama Islam Sangatta Kutai Timur',
        'Sekolah Tinggi Agama Kristen Protestan Negeri Ambon',
        'Sekolah Tinggi Analis Bakti Asih',
        'Sekolah Tinggi Bahasa Asing LIA Yogyakarta',
        'Sekolah Tinggi Desain Bali',
        'Sekolah Tinggi Ekonomi Islam SEBI',
        'Sekolah Tinggi Ekonomi Pandu Madania',
        'Sekolah Tinggi Energi dan Mineral Akamigas Cepu',
        'Sekolah Tinggi Farmasi Indonesia',
        'Sekolah Tinggi Filsafat Katolik Ledalero',
        'Sekolah Tinggi Filsafat Seminari Pineleng',
        'Sekolah Tinggi Filsafat Theologi Jakarta',
        'Sekolah Tinggi IImu Kesehatan Husada Jombang',
        'Sekolah Tinggi Ilmu Administrasi Banten',
        'Sekolah Tinggi Ilmu Administrasi LAN Jakarta',
        'Sekolah Tinggi Ilmu Administrasi Lembaga Administrasi',
        'Sekolah Tinggi Ilmu Administrasi Lembaga Administrasi',
        'Sekolah Tinggi Ilmu Administrasi Setih Setio',
        'Sekolah Tinggi Ilmu Agama Buddha Jinarakkhita',
        'Sekolah Tinggi Ilmu Bahasa Asing Invada',
        'Sekolah Tinggi Ilmu Ekonomi Adi Unggul Bhirawa',
        'Sekolah Tinggi Ilmu Ekonomi Ahmad Dahlan',
        'Sekolah Tinggi Ilmu Ekonomi APRIN',
        'Sekolah Tinggi Ilmu Ekonomi Bangkinang',
        'Sekolah Tinggi Ilmu Ekonomi Bhakti Pembangunan',
        'Sekolah Tinggi Ilmu Ekonomi Bina Karya',
        'Sekolah Tinggi Ilmu Ekonomi Ekuitas, Bandung',
        'Sekolah Tinggi Ilmu Ekonomi Indonesia Banjarmasin',
        'Sekolah Tinggi Ilmu Ekonomi Indonesia Banking School',
        'Sekolah Tinggi Ilmu Ekonomi Indonesia Surabaya',
        'Sekolah Tinggi Ilmu Ekonomi Insan Pembangunan',
        'Sekolah Tinggi Ilmu Ekonomi IPWI Jakarta',
        'Sekolah Tinggi Ilmu Ekonomi Kesatuan',
        'Sekolah Tinggi Ilmu Ekonomi Lamappoleonro',
        'Sekolah Tinggi Ilmu Ekonomi Mahardhika',
        'Sekolah Tinggi Ilmu Ekonomi Makassar Bongaya',
        'Sekolah Tinggi Ilmu Ekonomi Malangkucecwara',
        'Sekolah Tinggi Ilmu Ekonomi Mandala',
        'Sekolah Tinggi Ilmu Ekonomi Mikroskil',
        'Sekolah Tinggi Ilmu Ekonomi Muhammadiyah Jakarta',
        'Sekolah Tinggi Ilmu Ekonomi Muhammadiyah Tanjung',
        'Sekolah Tinggi Ilmu Ekonomi Musi',
        'Sekolah Tinggi Ilmu Ekonomi Nusa Megar Kencana',
        'Sekolah Tinggi Ilmu Ekonomi Pelita Indonesia',
        'Sekolah Tinggi Ilmu Ekonomi Pelita Nusantara',
        'Sekolah Tinggi Ilmu Ekonomi Perbanas Surabaya',
        'Sekolah Tinggi Ilmu Ekonomi Pontianak',
        'Sekolah Tinggi Ilmu Ekonomi Prabumulih',
        'Sekolah Tinggi Ilmu Ekonomi Prasetiya Mandiri Lampung',
        'Sekolah Tinggi Ilmu Ekonomi Professional Manajemen',
        'Sekolah Tinggi Ilmu Ekonomi Putra Bangsa',
        'Sekolah Tinggi Ilmu Ekonomi Sakti Alam Kerinci',
        'Sekolah Tinggi Ilmu Ekonomi Sumbar',
        'Sekolah Tinggi Ilmu Ekonomi Surakarta',
        'Sekolah Tinggi Ilmu Ekonomi Tamansiswa',
        'Sekolah Tinggi Ilmu Ekonomi Trisakti',
        'Sekolah Tinggi Ilmu Ekonomi Widya Wiwaha',
        'Sekolah Tinggi Ilmu Ekonomi Yadika Bangil',
        'Sekolah Tinggi Ilmu Ekonomi Yapan Surabaya',
        'Sekolah Tinggi Ilmu Ekonomi YKPN',
        'Sekolah Tinggi Ilmu Farmasi Riau',
        'Sekolah Tinggi Ilmu Farmasi Yayasan Pharmasi',
        'Sekolah Tinggi Ilmu Hukum Sumpah Pemuda',
        'Sekolah Tinggi Ilmu Hukum UMEL MANDIRI',
        'Sekolah Tinggi Ilmu Kesehatan Aisyiyah Surakarta',
        'Sekolah Tinggi Ilmu Kesehatan Aisyiyah Yogyakarta',
        'Sekolah Tinggi Ilmu Kesehatan Aufa Royhan',
        'Sekolah Tinggi Ilmu Kesehatan Bakti Tunas Husada',
        'Sekolah Tinggi Ilmu Kesehatan Bali',
        'Sekolah Tinggi Ilmu Kesehatan Bina Putra Banjarmasin',
        'Sekolah Tinggi Ilmu Kesehatan Bina Sehat PPNI Mojokerto',
        'Sekolah Tinggi Ilmu Kesehatan Buleleng',
        'Sekolah Tinggi Ilmu Kesehatan Dian Husada',
        'Sekolah Tinggi Ilmu Kesehatan Elisabeth Semarang',
        'Sekolah Tinggi Ilmu Kesehatan Fort De Kock',
        'Sekolah Tinggi Ilmu Kesehatan Hang Tuah',
        'Sekolah Tinggi Ilmu Kesehatan Harapan Bangsa Purwodadi',
        'Sekolah Tinggi Ilmu Kesehatan Imelda',
        'Sekolah Tinggi Ilmu Kesehatan Jenderal Achmad Yani',
        'Sekolah Tinggi Ilmu Kesehatan Karya Husada Kediri',
        'Sekolah Tinggi Ilmu Kesehatan Kuningan Garawangi',
        'Sekolah Tinggi Ilmu Kesehatan Kurnia Jaya Persada',
        'Sekolah Tinggi Ilmu Kesehatan Medika Cikarang',
        'Sekolah Tinggi Ilmu Kesehatan Medistra Lubuk Pakam',
        'Sekolah Tinggi Ilmu Kesehatan Mercubaktijaya',
        'Sekolah Tinggi Ilmu Kesehatan Mitra Bunda Persada',
        'Sekolah Tinggi Ilmu Kesehatan Mitra Husada Karangasem',
        'Sekolah Tinggi Ilmu Kesehatan Mitra Husada Medan',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Gombong',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Klaten',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Kudus',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Palembang',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Pekajan',
        'Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Samarinda',
        'Sekolah Tinggi Ilmu Kesehatan Nani Hasanuddin',
        'Sekolah Tinggi Ilmu Kesehatan Ngudia Husada Madura',
        'Sekolah Tinggi Ilmu Kesehatan Nusantara Oebobo',
        'Sekolah Tinggi Ilmu Kesehatan Pertamedika',
        'Sekolah Tinggi Ilmu Kesehatan PKU Muhammadiyah Surabaya',
        'Sekolah Tinggi Ilmu Kesehatan Prima Nusantara',
        'Sekolah Tinggi Ilmu Kesehatan RS Baptis Kediri',
        'Sekolah Tinggi Ilmu Kesehatan Rumah Sakit Haji',
        'Sekolah Tinggi Ilmu Kesehatan Santa Elisabeth Meda',
        'Sekolah Tinggi Ilmu Kesehatan Santo Borromeus',
        'Sekolah Tinggi Ilmu Kesehatan Sari Mulia',
        'Sekolah Tinggi Ilmu Kesehatan Suaka Insan',
        'Sekolah Tinggi Ilmu Kesehatan Sukabumi',
        'Sekolah Tinggi Ilmu Kesehatan Sumatera Utara',
        'Sekolah Tinggi Ilmu Kesehatan Surya Mitra Husada',
        'Sekolah Tinggi Ilmu Kesehatan Syedza Saintika',
        'Sekolah Tinggi Ilmu Kesehatan Wira Husada',
        'Sekolah Tinggi Ilmu Kesehatan Wira Medika Bali',
        'Sekolah Tinggi Ilmu Kesehatan Wiyata Husada Samarinda',
        'Sekolah Tinggi Ilmu Kesehatan YPAK Padang',
        'Sekolah Tinggi Ilmu Komputer Dinamika Bangsa',
        'Sekolah Tinggi Ilmu Komputer Pelita Indonesia',
        'Sekolah Tinggi Ilmu Komputer Yos Sudarso',
        'Sekolah Tinggi Ilmu Komunikasi dan Sekretari Tarakan',
        'Sekolah Tinggi Ilmu Majanemen Nitro Makassar',
        'Sekolah Tinggi Ilmu Manajemen Sukma',
        'Sekolah Tinggi Ilmu Manajemen YKPN',
        'Sekolah Tinggi Ilmu Pelayaran Jakarta',
        'Sekolah Tinggi Ilmu Pertanian Dharma Wacana',
        'Sekolah Tinggi Ilmu Sosial dan Ilmu Politik Muhammadiyah',
        'Sekolah Tinggi Ilmu Sosial dan Politik Mojokerto',
        'Sekolah Tinggi Ilmu Syariah Al-Wahidiyah Kediri',
        'Sekolah Tinggi Ilmu Tarbiyah Muhammadiyah Bojonegoro',
        'Sekolah Tinggi Intelijen Negara',
        'Sekolah Tinggi Keguruan dan Ilmu Pendidikan PGRI Pasundan',
        'Sekolah Tinggi Keguruan dan Ilmu Pendidikan Siliwangi',
        'Sekolah Tinggi Management Transportasi Trisakti',
        'Sekolah Tinggi Manajemen Asuransi Trisakti',
        'Sekolah Tinggi Manajemen dan Ilmu Komputer Bumigor',
        'Sekolah Tinggi Manajemen dan Ilmu Komputer PPKIA',
        'Sekolah Tinggi Manajemen dan Ilmu Komputer Raharja',
        'Sekolah Tinggi Manajemen Informatika dan Komputer',
        'Sekolah Tinggi Manajemen IPMI',
        'Sekolah Tinggi Manajemen PPM',
        'Sekolah Tinggi Maritim dan Transpor AMNI',
        'Sekolah Tinggi Multi Media "MMTC" Yogyakarta',
        'Sekolah Tinggi Pariwisata Ambarrukmo',
        'Sekolah Tinggi Pariwisata Bandung',
        'Sekolah Tinggi Pariwisata Nusa Dua Bali',
        'Sekolah Tinggi Pariwisata Pelita Harapan',
        'Sekolah Tinggi Pariwisata Sahid',
        'Sekolah Tinggi Pariwisata Sahid Surakarta',
        'Sekolah Tinggi Pariwisata Trisakti',
        'Sekolah Tinggi Pembangunan Masyarakat Desa APMD',
        'Sekolah Tinggi Penyuluhan Pertanian Bogor',
        'Sekolah Tinggi Penyuluhan Pertanian Magelang',
        'Sekolah Tinggi Penyuluhan Pertanian Malang',
        'Sekolah Tinggi Penyuluhan Pertanian Manokwari',
        'Sekolah Tinggi Penyuluhan Pertanian Medan',
        'Sekolah Tinggi Perikanan',
        'Sekolah Tinggi Perpajakan Indonesia',
        'Sekolah Tinggi Pertanahan Nasional Yogyakarta',
        'Sekolah Tinggi Peyuluhan Pertanian Gowa',
        'Sekolah Tinggi Teknik PLN',
        'Sekolah Tinggi Teknik Surabaya',
        'Sekolah Tinggi Teknologi Adisutjipto',
        'Sekolah Tinggi Teknologi Angkatan Laut',
        'Sekolah Tinggi Teknologi Kedirgantaraan',
        'Sekolah Tinggi Teknologi Kelautan Balik Diwa',
        'Sekolah Tinggi Teknologi Minyak dan Gas Bumi',
        'Sekolah Tinggi Teknologi Nasional Yogyakarta',
        'Sekolah Tinggi Teologi Arastamar Bengkulu',
        'Sekolah Tinggi Teologi Injili Indonesia Surabaya',
        'Sekolah Tinggi Teologi Kadesi Yogyakarta',
        'Sekolah Tinggi Teologi Saat Malang',
        'Sekolah Tingi Ilmu Administrasi LPPN',
        'STES Islamic Village Tangerang',
        'STIKES Bhakti Husada Bengkulu',
        'STIKES Dharma Landbouw, Padang',
        'STIKES Karya Husada Semarang',
        'STKIP Labuhan Batu',
        'Universitas 17 Agustus 1945 Banyuwangi',
        'Universitas 17 Agustus 1945 Cirebon',
        'Universitas 17 Agustus 1945 Semarang',
        'Universitas 17 Agustus 1945 Surabaya',
        'Universitas Abdurachman Saleh',
        'Universitas Abulyatama',
        'Universitas Ahmad Dahlan',
        'Universitas Airlangga',
        'Universitas Aisyiyah Yogyakarta',
        'Universitas Al Muslim',
        'Universitas Al-azhar Indonesia',
        'Universitas Alma Ata',
        'Universitas Amikom Yogyakarta',
        'Universitas Andalas',
        'Universitas Atma Jaya Yogyakarta',
        'Universitas Baiturrahmah',
        'Universitas Bakrie',
        'Universitas Balikpapan',
        'Universitas Bandar Lampung',
        'Universitas Batam',
        'Universitas Baturaja',
        'Universitas Bengkulu',
        'Universitas Bhayangkara',
        'Universitas Bhayangkara Jakarta Raya',
        'Universitas Bina Darma',
        'Universitas Bina Nusantara',
        'Universitas Borneo Tarakan',
        'Universitas Bosowa Makassar',
        'Universitas Brawijaya',
        'Universitas Bunda Mulia',
        'Universitas Bung Hatta',
        'Universitas Bung Karno',
        'Universitas Cenderawasih',
        'Universitas Ciputra',
        'Universitas Cokroaminoto Palopo',
        'Universitas Darma Persada',
        'Universitas Darul Ulum',
        'Universitas Dhyana Pura',
        'Universitas Dian Nuswantoro',
        'Universitas Diponegoro',
        'Universitas Dirgantara Marsekal Suryadarma',
        'Universitas Djuanda',
        'Universitas Dr Soetomo',
        'Universitas Dwijendra',
        'Universitas Esa Unggul',
        'Universitas Fajar',
        'Universitas Flores',
        'Universitas Gadjah Mada',
        'Universitas Gajayana',
        'Universitas Galuh',
        'Universitas Garut',
        'Universitas Gorontalo',
        'Universitas Gunadarma',
        'Universitas Halu Oleo',
        'Universitas Hamzanwadi',
        'Universitas Hang Tuah',
        'Universitas Hasanuddin',
        'Universitas Hindu Indonesia',
        'Universitas HKBP Nommensen',
        'Universitas Ibn Khaldun',
        'Universitas Ichsan Gorontalo',
        'Universitas Indonesia',
        'Universitas Islam Bandung',
        'Universitas Islam Batik',
        'Universitas Islam Indonesia',
        'Universitas Islam Kalimantan Muhammad Arsyad Al-Ba',
        'Universitas Islam Makassar',
        'Universitas Islam Malang',
        'Universitas Islam Nahdlatul Ulama Jepara',
        'Universitas Islam Negeri Alauddin',
        'Universitas Islam Negeri Antasari Banjarmasin',
        'Universitas Islam Negeri Ar-Raniry Banda Aceh',
        'Universitas Islam Negeri Imam Bonjol Padang',
        'Universitas Islam Negeri Mataram',
        'Universitas Islam Negeri Maulana Malik Ibrahim Malang',
        'Universitas Islam Negeri Raden Fatah',
        'Universitas Islam Negeri Raden Intan Lampung',
        'Universitas Islam Negeri Sultan Maulana Hasanuddin',
        'Universitas Islam Negeri Sultan Thaha Saifuddin Jambi',
        'Universitas Islam Negeri Sulthan Syarif Kasim Riau',
        'Universitas Islam Negeri Sumatera Utara Medan',
        'Universitas Islam Negeri Sunan Ampel',
        'Universitas Islam Negeri Sunan Gunung Djati Bandung',
        'Universitas Islam Negeri Sunan Kalijaga Yogyakarta',
        'Universitas Islam Negeri Syarif Hidayatullah',
        'Universitas Islam Negeri Walisongo',
        'Universitas Islam Riau',
        'Universitas Islam Sultan Agung Semarang',
        'Universitas Islam Sumatera Utara',
        'Universitas Jambi',
        'Universitas Janabadra',
        'Universitas Jayabaya',
        'Universitas Jember',
        'Universitas Jenderal Achmad Yani',
        'Universitas Jenderal Soedirman',
        'Universitas Kanjuruhan',
        'Universitas Katolik Darma Cendika',
        'Universitas Katolik De La Salle, Mapanget',
        'Universitas Katolik Indonesia Atma Jaya',
        'Universitas Katolik Parahyangan',
        'Universitas Katolik Soegijapranata',
        'Universitas Katolik Widya Mandala Surabaya',
        'Universitas Katolik Widya Mandira Kupang',
        'Universitas Khairun',
        'Universitas Klabat',
        'Universitas Komputer Indonesia',
        'Universitas Krisnadwipayana',
        'Universitas Kristen Artha Wacana',
        'Universitas Kristen Duta Wacana',
        'Universitas Kristen Immanuel',
        'Universitas Kristen Indonesia',
        'Universitas Kristen Indonesia Maluku',
        'Universitas Kristen Indonesia Paulus',
        'Universitas Kristen Indonesia Toraja',
        'Universitas Kristen Maranatha',
        'Universitas Kristen Petra',
        'Universitas Kristen Satya Wacana',
        'Universitas Kuningan',
        'Universitas Lambung Mangkurat',
        'Universitas Lampung',
        'Universitas Lancang Kuning',
        'Universitas Langlangbuana',
        'Universitas Ma Chung',
        'Universitas Mahasaraswati Denpasar',
        'Universitas Malahayati',
        'Universitas Malikussaleh',
        'Universitas Mataram',
        'Universitas Medan Area',
        'Universitas Mercu Buana',
        'Universitas Mercu Buana Yogyakarta',
        'Universitas Merdeka Madiun',
        'Universitas Merdeka Malang',
        'Universitas Methodist Indonesia',
        'Universitas Mochammad Sroedji',
        'Universitas Mohammad Husni Thamrin',
        'Universitas Mpu Tantular',
        'Universitas Muhammadiyah Bengkulu',
        'Universitas Muhammadiyah Gorontalo',
        'Universitas Muhammadiyah Gresik',
        'Universitas Muhammadiyah Jakarta',
        'Universitas Muhammadiyah Jember',
        'Universitas Muhammadiyah Kupang',
        'Universitas Muhammadiyah Lampung',
        'Universitas Muhammadiyah Magelang',
        'Universitas Muhammadiyah Makassar',
        'Universitas Muhammadiyah Malang',
        'Universitas Muhammadiyah Maluku Utara',
        'Universitas Muhammadiyah Mataram',
        'Universitas Muhammadiyah Metro',
        'Universitas Muhammadiyah Palangka Raya',
        'Universitas Muhammadiyah Palembang',
        'Universitas Muhammadiyah Pare-Pare',
        'Universitas Muhammadiyah Ponorogo',
        'Universitas Muhammadiyah Pontianak',
        'Universitas Muhammadiyah Prof Dr Hamka',
        'Universitas Muhammadiyah Purwokerto',
        'Universitas Muhammadiyah Purworejo',
        'Universitas Muhammadiyah Riau',
        'Universitas Muhammadiyah Semarang',
        'Universitas Muhammadiyah Sidoarjo',
        'Universitas Muhammadiyah Sukabumi',
        'Universitas Muhammadiyah Sumatera Barat',
        'Universitas Muhammadiyah Sumatera Utara',
        'Universitas Muhammadiyah Surabaya',
        'Universitas Muhammadiyah Surakarta',
        'Universitas Muhammadiyah Tangerang',
        'Universitas Muhammadiyah Tapanuli Selatan',
        'Universitas Muhammadiyah Yogyakarta',
        'Universitas Mulawarman',
        'Universitas Multimedia Nusantara',
        'Universitas Muria Kudus',
        'Universitas Musamus Merauke',
        'Universitas Muslim Indonesia',
        'Universitas Muslim Nusantara Al-Washliyah',
        'Universitas Nahdlatul Ulama Surabaya',
        'Universitas Narotama',
        'Universitas Nasional',
        'Universitas Negeri Gorontalo',
        'Universitas Negeri Jakarta',
        'Universitas Negeri Makassar',
        'Universitas Negeri Malang',
        'Universitas Negeri Manado',
        'Universitas Negeri Medan',
        'Universitas Negeri Padang',
        'Universitas Negeri Semarang',
        'Universitas Negeri Surabaya',
        'Universitas Negeri Yogyakarta',
        'Universitas Ngudi Waluyo',
        'Universitas Ngurah Rai',
        'Universitas Nurtanio',
        'Universitas Nusa Cendana',
        'Universitas Padjadjaran',
        'Universitas Pakuan',
        'Universitas Palangka Raya',
        'Universitas Panca Bhakti',
        'Universitas Pancasakti',
        'Universitas Pancasila',
        'Universitas Pandanaran',
        'Universitas Paramadina',
        'Universitas Pasundan',
        'Universitas Pattimura',
        'Universitas Pekalongan',
        'Universitas Pelita Harapan',
        'Universitas Pembangunan Nasional Veteran Jakarta',
        'Universitas Pembangunan Nasional Veteran Jawa Timur',
        'Universitas Pembangunan Nasional Veteran Yogyakarta',
        'Universitas Pembangunan Panca Budi',
        'Universitas Pendidikan Ganesha',
        'Universitas Pendidikan Indonesia',
        'Universitas Pendidikan Nasional',
        'Universitas Pertahanan',
        'Universitas Pesantren Tinggi Darul Ulum Jombang',
        'Universitas PGRI Adi Buana, Surabaya',
        'Universitas PGRI Madiun',
        'Universitas PGRI Palembang',
        'Universitas PGRI Semarang',
        'Universitas PGRI Yogyakarta',
        'Universitas Presiden',
        'Universitas Prima Indonesia',
        'Universitas Prof Dr Hazairin SH',
        'Universitas Prof. Dr. Moestopo (Beragama)',
        'Universitas Proklamasi 45 Yogyakarta',
        'Universitas Respati Yogyakarta',
        'Universitas Riau',
        'Universitas Riau Kepulauan',
        'Universitas Sahid',
        'Universitas Sains Al Quran',
        'Universitas Sam Ratulangi',
        'Universitas Sanata Dharma',
        'Universitas Sarjanawiyata Tamansiswa',
        'Universitas Satya Negara Indonesia',
        'Universitas Sebelas Maret',
        'Universitas Semarang',
        'Universitas Serang Raya',
        'Universitas Setia Budi Surakarta',
        'Universitas Simalungun',
        'Universitas Sintuwu Maroso',
        'Universitas Sisingamangaraja XII Tapanuli Utara',
        'Universitas Slamet Riyadi',
        'Universitas Sriwijaya',
        'Universitas STIKUBANK',
        'Universitas Sultan Ageng Tirtayasa',
        'Universitas Sumatera Utara',
        'Universitas Surabaya',
        'Universitas Syiah Kuala',
        'Universitas Tabanan',
        'Universitas Tadulako',
        'Universitas Tamansiswa Padang',
        'Universitas Tanjungpura',
        'Universitas Tarumanagara',
        'Universitas Telkom',
        'Universitas Trilogi',
        'Universitas Trisakti',
        'Universitas Trunojoyo',
        'Universitas Tulang Bawang',
        'Universitas Tulungagung',
        'Universitas Tunas Pembangunan',
        'Universitas Udayana',
        'Universitas Veteran Bangun Nusantara',
        'Universitas Wahid Hasyim',
        'Universitas Warmadewa',
        'Universitas Widya Dharma Klaten',
        'Universitas Widya Gama',
        'Universitas Widya Gama Mahakam Samarinda',
        'Universitas Widya Mataram',
        'Universitas Widyatama',
        'Universitas Wijaya Kusuma Purwokerto',
        'Universitas Wijaya Kusuma Surabaya',
        'Universitas Wisnuwardhana',
        'Universitas Yapis Papua',
        'Universitas Yarsi'

    ]
    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("ijasahS1"), jur);
    autocomplete(document.getElementById("ijasahS2"), jur);
    autocomplete(document.getElementById("ijasahS3"), jur);
    autocomplete(document.getElementById("univS1"), akd);
    autocomplete(document.getElementById("univS2"), akd);
    autocomplete(document.getElementById("univS3"), akd);
</script>

<?= $this->endsection(); ?>