<?= $this->extend('layout/template') ?>
<?= $this->Section('isi') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>


            <!------------------Baris pertama dari tombol-tombol-------------------------------------------------------------->
            <div class="d-flex justify-content-start">
                <form class="row mx-2 px-2" action="#" method="post">
                    <a href="/tambah-CV" class=btn btn-primary style="width:100px; background-color:#90e1f5">
                        <i class="fas fa-plus-circle"></i>Tambah</a>
                </form>
                <div class="btn-group mx-1 px-1">
                    <button type="button" style="width:100px; background-color:#90e1f5; border: none;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter Usia"><i class="fa-solid fa-filter"></i>
                        Usia
                    </button>
                    <ul class="dropdown-menu" id="test" onclick="umur()">
                        <li><a class="dropdown-item" href="/fUsia/20">20-30</a></li>
                        <li><a class="dropdown-item" href="/fUsia/30">30-40</a></li>
                        <li><a class="dropdown-item" href="/fUsia/40">40-50</a></li>
                        <li><a class="dropdown-item" href="/fUsia/50">50-60</a></li>
                        <li><a class="dropdown-item" href="/fUsia/60">60-70</a></li>
                        <li><a class="dropdown-item" href="/fUsia/70">70-80</a></li>
                    </ul>
                </div>
                <div class="btn-group mx-1 px-1">
                    <button type="button" style="width:80px; background-color:#90e1f5; border: none;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S1"><i class="fa-solid fa-filter"></i>
                        S1
                    </button>
                    <ul class="dropdown-menu" id="EDU" onclick="pendidikan()">
                        <li><a class="dropdown-item" href="/fSarjana/Psikologi">Psikologi</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Teknik">Teknik</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Sains">Sains</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Manajemen">Manajemen</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Ekonomi">Ekonomi</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Administrasi">Administrasi</a></li>
                        <li><a class="dropdown-item" href="/fSarjana/Kedokteran">Kedokteran</a></li>
                    </ul>
                </div>
                <div class="btn-group mx-1 px-1">
                    <button type="button" style="width:80px; background-color:#90e1f5; border: none;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S2"><i class="fa-solid fa-filter"></i>
                        S2
                    </button>
                    <ul class="dropdown-menu" id="EDUS2" onclick="pendidikanS2()">
                        <li><a class="dropdown-item" href="/fMaster/Psikologi">Psikologi</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Teknik">Teknik</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Sains">Sains</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Manajemen">Manajemen</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Ekonomi">Ekonomi</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Administrasi">Administrasi</a></li>
                        <li><a class="dropdown-item" href="/fMaster/Kedokteran">Kedokteran</a></li>
                    </ul>
                </div>
                <div class="btn-group mx-1 px-1">
                    <button type="button" style="width:80px; background-color:#90e1f5; border: none;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S3"><i class="fa-solid fa-filter"></i>
                        S3
                    </button>
                    <ul class="dropdown-menu" id="EDUS3" onclick="doktor()">
                        <li><a class="dropdown-item" href="/Doctor/Psikologi">Psikologi</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Teknik">Teknik</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Sains">Sains</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Manajemen">Manajemen</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Ekonomi">Ekonomi</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Administrasi">Administrasi</a></li>
                        <li><a class="dropdown-item" href="/Doctor/Kedokteran">Kedokteran</a></li>
                    </ul>
                </div>
                <div class="col-sm-5 mx-3 px-3">
                    <select class="form-select" style="width:300px; background-color:#90e1f5;" title="Posisi" name="posi" id="positions" onclick="position()">
                        <?php foreach ($posisi as $val) : ?>
                            <option value="<?= $val->posisi ?>"><?= $val->posisi ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2 mx-2 px-2">
                    <a href="" class=btn btn-primary style="width:40px; background-color:#90e1f5; " data-bs-toggle="modal" data-bs-target="#importExcel" title="Import from Excel">
                        <i class="fa-solid fa-file-arrow-up"></i></a>
                    <a href="/exporExcel" class=btn btn-primary style="width:40px; background-color:#90e1f5; " title="Export to Excel">
                        <i class="fa-solid fa-file-arrow-down"></i></a>
                </div>
            </div><br>
            <!------------------Baris pertama dari tombol-tombol-------------------------------------------------------------->

            <!-----------------Baris kedua berisi tombol sort tanggal kadaluarsa---------------------------------------------->
            <div class="d-flex justify-content-end mx-5">
                <form class="row g-3" action="/urutSIPP_ED" method="post">
                    <button class="btn btn-primary" style="width:130px; background-color:#fc0b03" data-bs-toggle="modal" data-bs-target="importExcel" title="Urut Tanggal Kadaluarsa SIPP">
                        <i class="fa-sharp fa-solid fa-sort"></i></i>Kadaluarsa</button>
                </form>
            </div><br>
            <!-----------------Baris kedua berisi tombol sort tanggal kadaluarsa---------------------------------------------->

            <!------------------Notifikasi keberhasilan proses editing-------------------------------------------------------------->
            <!--/////////////import:Data berhasil di-impor//////////////////-->
            <?php if (session('import')) :  ?><div class="alert alert-success" role="alert"><?= session('import'); ?></div>
            <?php endif; ?>
            <!--/////////////import:Data berhasil di-impor//////////////////-->

            <!--/////////////error:Bukan format file excel//////////////////-->
            <?php if (session('error')) :  ?><div class="alert alert-success" role="alert"><?= session('error'); ?></div>
            <?php endif; ?>
            <!--/////////////error:Bukan format file excel//////////////////-->

            <!--Notifikasi berhasil hapus data CV -->
            <!--Kalau native : $_SESSION[]...., pasangannya di Dashboard.php fungsi delete($id) -->
            <?php if (session('hapus')) : ?><div class="alert alert-danger" role="alert"><?= session('hapus'); ?></div>
            <?php endif; ?>

            <!--pasangannya di Dashboard.php fungsi simpan_update()-->
            <?php if (session('berhasilUpdate')) : ?><div class="alert alert-success" role="alert"><?= session('berhasilUpdate'); ?></div>
            <?php endif; ?>
            <!------------------Notifikasi keberhasilan proses editing-------------------------------------------------------------->


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Tenaga Ahli
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center; width:5%">ID</th>
                                <th scope="col" style="text-align:center; width:25%">Nama</th>
                                <th scope="col" style="text-align:center; width:10%">SIPP</th>
                                <th scope="col" style="text-align:center; width:10%">Tgl. Kadaluarsa</th>
                                <th scope="col" style="text-align:center; width:10%">Keterangan (hari)</th>
                                <th scope="col" style="text-align:center; width:10%">STR</th>
                                <th scope="col" style="text-align:center; width:10%">Usia</th>
                                <th scope="col" style="text-align:center; width:15%">Edit</th>
                            </tr>
                        </thead>
                        <!--
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>-->
                        <tbody>

                            <?php if ($cv) {
                                $no = 0;
                                foreach ($cv as $v) {

                                    // Cek Value dari $v['sipp_ed'];
                                    $tglED_SIPP = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                                    $keterangan_SIPP = "";
                                    //////////     SIPP ED    //////////////////////////////////////

                                    if ($tglED_SIPP != '0000-00-00') {
                                        if ($tglED_SIPP == '' || $tglED_SIPP == null) {
                                            $keterangan_SIPP = "kosong";
                                        } else {
                                            $tglED_SIPP = new DateTime($tglED_SIPP);
                                            $skrg = date_create();
                                            if ($skrg > $tglED_SIPP) {
                                                //$ED_for_SIPP = date_diff($skrg, $tglED);
                                                $keterangan_SIPP = "kadaluarsa";
                                            } else {
                                                $ED_for_SIPP = date_diff($tglED_SIPP, $skrg);
                                                if ($ED_for_SIPP->days <= 90) {
                                                    $keterangan_SIPP = "< 90 hari";
                                                } else {
                                                    $keterangan_SIPP = $ED_for_SIPP->days;
                                                }
                                            }
                                            $tglED_SIPP = $tglED_SIPP->format('d-m-Y');
                                        }
                                    } else {
                                        $keterangan_SIPP = "kosong";
                                    }
                                    //////////    END OF SIPP ED    //////////////////////////////////////


                                    //////////     STR ED    //////////////////////////////////////
                                    // Cek Nilai Value dari $row['data1'];
                                    $tglED_STR = isset($v['str_ed']) ? $v['str_ed'] : '';
                                    $keterangan_STR = "";
                                    if ($tglED_STR != '0000-00-00') {
                                        if ($tglED_STR == '' || $tglED_STR == null) {
                                            $keterangan_STR = "kosong";
                                        } else {
                                            $tglED_STR = new DateTime($tglED_STR);
                                            $skrg = date_create();
                                            if ($skrg > $tglED_STR) {
                                                $keterangan_STR = "kadaluarsa";
                                            } else {
                                                $ED_for_STR = date_diff($tglED_STR, $skrg);
                                                if ($ED_for_STR->days <= 90) {
                                                    $keterangan_STR = "< 90 hari";
                                                } else {
                                                    $keterangan_STR = $ED_for_STR->days;
                                                }
                                            }
                                            $tglED_STR = $tglED_STR->format('d-m-Y');
                                        }
                                    } else {
                                        $keterangan_STR = "kosong";
                                    }
                                    //////////    END OF STR ED    //////////////////////////////////////
                                    $id = isset($v['id']) ? $v['id'] : '';
                                    $nama = isset($v['nama']) ? $v['nama'] : '';
                                    $sipp = isset($v['sipp']) ? $v['sipp'] : '';
                                    $sipp_ed = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                                    $usia = isset($v['usia']) ? $v['usia'] : '';

                            ?>
                                    <tr>
                                        <td style="widht:5%"><?= $id; ?></td>
                                        <td onclick="cetak(<?= $id ?>)" id="#name" style="width:25%"><?= $nama ?></td>
                                        <td style="width:10%"><?= $sipp ?></td>
                                        <td style="width:10%"><?= $tglED_SIPP; ?></td>
                                        <!-- Mencetak keterangan sudah kadaluarsa atau sisa 3 bulan atau masih lama, JIKA SIPP KADALUARSA WARNA BACKGROUND MERAH----->
                                        <?php if ($keterangan_SIPP == "kadaluarsa") :  ?>
                                            <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>
                                        <?php elseif ($keterangan_SIPP == "< 90 hari") : ?>
                                            <td style="width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $keterangan_SIPP ?></td>
                                        <?php else : ?>
                                            <!-- Mencetak keterangan sudah kadaluarsa atau sisa 3 bulan atau masih lama, JIKA SIPP KADALUARSA WARNA BACKGROUND MERAH----->
                                            <!-- Belum kadaluarsa  DAN LEBIH DARI 3 BULAN > BACKGROUND PUTIH ----------------------------------------------------------------->
                                            <td style="width:10%; text-align:center;"><?= $keterangan_SIPP ?></td>
                                        <?php endif; ?>
                                        <!-- Belum kadaluarsa  DAN LEBIH DARI 3 BULAN > BACKGROUND PUTIH ----------------------------------------------------------------->

                                        <!----------Seperti SIPP tapi untuk STR--------------------------------------------------------------------------------------------->
                                        <?php if ($keterangan_STR == "kadaluarsa") :  ?>
                                            <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_STR ?></td>
                                        <?php elseif ($keterangan_STR == "< 90 hari") : ?>
                                            <td style="width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $keterangan_STR ?></td>
                                        <?php else : ?>
                                            <!--    JIKA BELUM KADALUARSA WARNA BACKGROUND PUTIH  -->
                                            <td style="width:10%; text-align:center;"><?= $keterangan_STR ?></td>
                                        <?php endif; ?>
                                        <!----------Seperti SIPP tapi untuk STR--------------------------------------------------------------------------------------------->

                                        <!--------------------------------------------------usia --------------------------------------------------------------->
                                        <td style="width:10%; text-align:center;"><?= $usia; ?></td>
                                        <!--------------------------------------------------usia --------------------------------------------------------------->

                                        <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                        <td style="width:15%; text-align:center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#baca<?= $id ?>">
                                                <i class="fa-solid fa-magnifying-glass" title="baca"></i>
                                                |<a href="/update/<?= $id; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i>|
                                                    <a href="/delete/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                                                        <i class="fa-solid fa-trash-can" title="hapus"></i>|<a target="_blank" href="/laporan1/<?= $id; ?>">
                                                            <i class="fa-solid fa-print" title="print cv"></i>
                                        </td>
                                        <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->

                                    </tr>

                                <?php
                                }
                            } else { ?>

                                <tr>
                                    <td colspan="5">Tidak ada data......................................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</td>
                                </tr>
                            <?php


                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Baca-->
    <?php $i = 1; ?>
    <?php foreach ($cv as $v) : ?>
        <?php $id = isset($v['id']) ? $v['id'] : '';
        $nama = isset($v['nama']) ? $v['nama'] : '';
        $perusahaan = isset($v['perusahaan']) ? $v['perusahaan'] : '';
        $posisi = isset($v['posisi']) ? $v['posisi'] : '';
        $kategori = isset($v['kategori']) ? $v['kategori'] : '';
        $tgl = isset($v['tgl']) ? $v['tgl'] : '';
        $usia = isset($v['usia']) ? $v['usia'] : '';
        $alamat = isset($v['alamat']) ? $v['alamat'] : '';
        $kota = isset($v['kota']) ? $v['kota'] : '';
        $no_ktp = isset($v['no_ktp']) ? $v['no_ktp'] : '';
        $no_npwp = isset($v['no_npwp']) ? $v['no_npwp'] : '';
        $no_telp = isset($v['no_telp']) ? $v['no_telp'] : '';
        $no_hp = isset($v['no_hp']) ? $v['no_hp'] : '';
        $email = isset($v['email']) ? $v['email'] : '';
        $ijazahS1 = isset($v['ijazahS1']) ? $v['ijazahS1'] : '';
        $s1_univ = isset($v['s1_univ']) ? $v['s1_univ'] : '';
        $s1_thn = isset($v['s1_thn']) ? $v['s1_thn'] : '';
        $ijazahS2 = isset($v['ijazahS2']) ? $v['ijazahS2'] : '';
        $s2_univ = isset($v['s2_univ']) ? $v['s2_univ'] : '';
        $s2_thn = isset($v['s2_thn']) ? $v['s2_thn'] : '';
        $ijazahS3 = isset($v['ijazahS3']) ? $v['ijazahS3'] : '';
        $s3_univ = isset($v['s3_univ']) ? $v['s3_univ'] : '';
        $s3_thn = isset($v['s3_thn']) ? $v['s3_thn'] : '';
        $sipp = isset($v['sipp']) ? $v['sipp'] : '';
        $sipp_ed = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
        $kta = isset($v['kta']) ? $v['kta'] : '';
        $kta_ed = isset($v['kta_ed']) ? $v['kta_ed'] : '';
        $asosiasi = isset($v['asosiasi']) ? $v['asosiasi'] : '';
        $status = isset($v['status']) ? $v['status'] : '';

        $str = isset($v['str']) ? $v['str'] : '';
        $str_ed = isset($v['str_ed']) ? $v['str_ed'] : '';
        //////////////////  INISIALISASI IMAGE START  //////////////////////////////                
        $pasfoto = isset($v['pasfoto']) ? $v['pasfoto'] : '';
        $fktp = isset($v['fktp']) ? $v['fktp'] : '';
        $fnpwp = isset($v['fnpwp']) ? $v['fnpwp'] : '';
        $fsipp = isset($v['fsipp']) ? $v['fsipp'] : '';
        $fstr = isset($v['fstr']) ? $v['fstr'] : '';
        $fkta = isset($v['fkta']) ? $v['fkta'] : '';
        $ref = isset($v['ref']) ? $v['ref'] : '';
        ////////////////// INISIALISASI IMAGE END  //////////////////////////////                
        ?>
        <div class="modal fade" id="baca<?= $id ?>" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detil CV Tenaga Ahli (<?= $nama ?>)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= route_to('baca-CV', $id) ?>" method="get">
                            <div class="m-1 row">
                                <label for="perusahaan" class="col-sm-4 col-form-label">Nama perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="perusahaan" value="<?= $perusahaan; ?>">
                                </div>
                            </div>
                            <div class="m-1 row">
                                <label for="posisi" class="col-sm-4 col-form-label">Posisi</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="posisi" value="<?= $posisi; ?>">
                                </div>
                            </div>
                            <div class="m-1 row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama personil</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="nama" value="<?= $nama; ?>">
                                </div>
                            </div>
                            <div class="m-1 row">
                                <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="kategori" value="<?= $kategori; ?>">
                                </div>
                            </div>
                            <?php
                            if ($tgl != null && $tgl != '0000-00-00') {
                                $tgl = new DateTime($tgl);
                                $tgl_lahir = $tgl->format('d-m-Y');
                            } else {
                                $tgl_lahir = "";
                            }
                            ?>
                            <div class="m-1 row">
                                <label for="tgl" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control" id="tgl" value="<?= $tgl_lahir ?>">
                                </div>
                                <label for="usia" class="col-sm-2 col-form-label">Usia</label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control" id="usia" value="<?= $usia; ?>">
                                </div>
                            </div>
                            <div class="m-1 row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="alamat" value="<?= $alamat; ?>">
                                </div>
                            </div>
                            <div class="m-1 row">
                                <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="kota" value="<?= $kota; ?>">
                                </div>
                            </div>

                            <div class="m-1 row">
                                <label for="no_ktp" class="col-sm-4 col-form-label">KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="no_ktp" value="<?= $no_ktp; ?>">
                                </div>
                            </div>

                            <div class="m-1 row">
                                <label for="no_npwp" class="col-sm-4 col-form-label">NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="no_npwp" value="<?= $no_npwp; ?>">
                                </div>
                            </div>

                            <div class="m-1 row">
                                <label for="no_telp" class="col-sm-4 col-form-label">Telp</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="no_telp" value="<?= $no_telp; ?>">
                                </div>
                            </div>

                            <div class="m-1 row">
                                <label for="no_hp" class="col-sm-4 col-form-label">HP</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="no_hp" value="<?= $no_hp; ?>">
                                </div>
                            </div>

                            <div class="m-1 row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="email" value="<?= $email; ?>">
                                </div>
                            </div>

                            <label>Pendidikan</label><br><br>
                            <b>S1</b><br>
                            <div class="m-0 row">
                                <label for="ijazahS1" class="col-sm-4 col-form-label">Jurusan</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="tgl" value="<?= $ijazahS1; ?>">
                                </div>
                            </div>

                            <div class="m-0 row">
                                <label for="s1_univ" class="col-sm-4 col-form-label">Universitas</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s1_univ" value="<?= $s1_univ; ?>">
                                </div>
                            </div>

                            <div class="m-0 row">
                                <label for="s1_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s1_thn" value="<?= $s1_thn; ?>">
                                </div>
                            </div>

                            <br><b>S2</b><br>
                            <div class="m-0 row">
                                <label for="ijazahS2" class="col-sm-4 col-form-label">Jurusan</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="ijazahS2" value="<?= $ijazahS2; ?>">
                                </div>
                            </div>

                            <div class="m-0 row">
                                <label for="s2_univ" class="col-sm-4 col-form-label">Universitas</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s2_univ" value="<?= $s2_univ; ?>">
                                </div>
                            </div>

                            <div class="m-0 row">
                                <label for="s2_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s2_thn" value="<?= $s2_thn; ?>">
                                </div>
                            </div>

                            <br><b>S3</b><br>
                            <div class="m-0 row">
                                <label for="ijazahS3" class="col-sm-4 col-form-label">Jurusan</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="ijazahS3" value="<?= $ijazahS3; ?>">
                                </div>
                            </div>

                            <div class="m-0 row">
                                <label for="s3_univ" class="col-sm-4 col-form-label">Universitas</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s3_univ" value="<?= $s3_univ; ?>">
                                </div>
                            </div>
                            <div class="m-0 row">
                                <label for="s3_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="s3_thn" value="<?= $s3_thn; ?>">
                                </div>
                            </div>
                            <?php
                            if ($sipp_ed != null && $sipp_ed != '0000-00-00') {
                                $tgl_sipp_ed = new DateTime($sipp_ed);
                                $tgl_sipp_ed_Indo = $tgl_sipp_ed->format('d-m-Y');
                            } else {
                                $tgl_sipp_ed_Indo = "";
                            }
                            ?>
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="sipp">Nomor SIPP</span>
                                <input type="text" readonly class="form-control" name="sipp" value="<?= $sipp; ?>" />
                                <span class="input-group-text" id="sipp_ed">Tanggal kadaluarsa SIPP</span>
                                <input type="text" readonly class="form-control" name="sipp_ed" value="<?= $tgl_sipp_ed_Indo ?>" />
                            </div>
                            <?php
                            if ($str_ed != null && $str_ed != '0000-00-00') {
                                $tgl_str_ed = new DateTime($str_ed);
                                $tgl_str_ed_Indo = $tgl_str_ed->format('d-m-Y');
                            } else {
                                $tgl_str_ed_Indo = "";
                            }
                            ?>
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="str">Nomor STR</span>
                                <input type="text" readonly class="form-control" name="str" value="<?= $str; ?>" />
                                <span class="input-group-text" id="str_ed">Tanggal kadaluarsa STR</span>
                                <input type="text" readonly class="form-control" name="str_ed" value="<?= $tgl_str_ed_Indo ?>" />
                            </div>
                            <?php
                            if ($kta_ed != null && $kta_ed != '0000-00-00') {
                                $tgl_kta_ed = new DateTime($kta_ed);
                                $tgl_kta_ed_Indo = $tgl_kta_ed->format('d-m-Y');
                            } else {
                                $tgl_kta_ed_Indo = "";
                            }
                            ?>

                            <div class="input-group mb-1">
                                <span class="input-group-text" id="kta">Nomor KTA</span>
                                <input type="text" readonly class="form-control" name="kta" value="<?= $kta; ?>">
                                <span class="input-group-text" id="kta_ed">Tanggal kadaluarsa KTA</span>
                                <input type="text" readonly class="form-control" name="kta_ed" value="<?= $tgl_kta_ed_Indo; ?>" />
                            </div>

                            <div class="input-group mb-1">
                                <label for="asosiasi" class="input-group-text">Asosiasi KTA</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="asosiasi" value="<?= $asosiasi; ?>">
                                </div>
                            </div>

                            <div class="input-group mb-1">
                                <label for="status" class="input-group-text">Status</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="status" value="<?= $status; ?>">
                                </div>
                            </div>

                            <!--////////////////////////////////       IMAGE START  ////////////////////////////////////////////////////////////////////////////-->
                            <label for="foto" style="width:200px" readonly>Pas Foto</label>
                            <img src="<?= base_url('/img/' . $pasfoto) ?>" alt="" class="prevPasFoto" width=100px>

                            <br><br>

                            <label for="ktp" style="width:200px" readonly>KTP</label>
                            <img src="<?= base_url('/img/' . $fktp) ?>" alt="" class="prevKTP" width="100px">

                            <br><br>

                            <label for="npwp" style="width:200px" readonly>NPWP</label>
                            <img src="<?= base_url('/img/' . $fnpwp) ?>" alt="" class="prevNPWP" width="100px">

                            <br><br>

                            <label for="gbrSIPP" style="width:200px" readonly>SIPP</label>
                            <img src="<?= base_url('/img/' . $fsipp) ?>" alt="" class="prevSIPP" width="100px">

                            <br><br>

                            <label for="gbrSTR" style="width:200px" readonly>STR</label>
                            <img src="<?= base_url('/img/' . $fstr) ?>" alt="" class="prevSTR" width="100px">

                            <br><br>

                            <label for="gbrKTA" style="width:200px" readonly>KTA</label>
                            <img src="<?= base_url('/img/' . $fkta) ?>" alt="" class="prevKTA" width="100px">

                            <br><br>

                            <label for="ref" style="width:200px" readonly>Referensi</label>
                            <input type="text" readonly class="form-control" name="ref" value="<?= $ref; ?>" />
                            <!--////////////////////////////////       IMAGE END  ////////////////////////////////////////////////////////////////////////////-->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:100px;height: 43px;"><i class="fa-solid fa-circle-xmark"></i>Tutup</button>
                                <a href="/cetak-laporan/<?= $id; ?>" class="btn btn-success p-2"><i class="fa-solid fa-file-pdf"></i></i> Cetak CV</a>
                                <a href="/cetak-intermitten/<?= $id; ?>" class="btn btn-success p-2"><i class="fa-solid fa-file-pdf"></i></i> Cetak Daftar Pengalaman</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>
    <!-- End Modal Baca-->

    <!-- Modal importExcel-->
    <div class="modal fade" id="importExcel" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Impor file Excel </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/imporExcel" method="post" enctype="multipart/form-data">
                        <label for="excel" style="width:500px" id="ketr">Masukkan file excel</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="excel" id="excel" accept=".xls, .xlsx, .ods">><a href="/ta.xlsx">Template</a>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" style="width:100px;height: 43px; background-color:#90e1f5; color:black"><i class="fa-sharp fa-solid fa-upload"></i>Import</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:100px;height: 43px;"><i class="fa-solid fa-circle-xmark"></i>Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal importExcel  -->

    <script>
        function cetak($id) {
            let nama = document.getElementById('#name').innerText;
            window.location.href = "/laporan2/" + $id
        }

        function position() {
            var pos = document.getElementById('positions');
            pos.onclick = function(event) {
                var target = event.target;
                var posisi = event.target.value;
                window.location.href = "/fPosisi/" + posisi;
            };
        }

        function pendidikanS3() {

            let ed = document.getElementById('EDU_S3');
            ed.onclick = function(event) {
                let target = event.target;
                let pendidikan = event.target.innerHTML;
                window.location.href = "/fDoktor/" + pendidikan;
            };
        }

        function umur() {
            let ul = document.getElementById('test');
            ul.onclick = function(event) {
                let target = event.target;
                let umur = event.target.innerHTML;
                let u = umur.substr(0, 2);
                window.location.href = "/fUsia/" + u;
            };
        }

        function pendidikan() {
            let ed = document.getElementById('EDU');
            ed.onclick = function(event) {
                let target = event.target;
                let pendidikan = event.target.innerHTML;
                window.location.href = "/fSarjana/" + pendidikan;
            };
        }

        function pendidikanS2() {
            let ed = document.getElementById('EDUS2');
            ed.onclick = function(event) {
                let target = event.target;
                let pendidikan = event.target.innerHTML;
                //  alert(pendidikan);
                window.location.href = "/fMaster/" + pendidikan;
            };
        }

        function doktor() {
            let ed = document.getElementById('EDUS3');
            ed.onclick = function(event) {
                let target = event.target;
                let pendidikan = event.target.innerHTML;
                //  alert(pendidikan);
                window.location.href = "/Doctor/" + pendidikan;
            };
        }
    </script>

    <?= $this->endSection(); ?>
    <!-- $this->Section('isi')?>-->