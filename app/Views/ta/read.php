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
                                <label class="col-sm-2 col-form-label">Kode Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $result['kode_ta'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Personil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $result['nama'] ?>" readonly>
                                </div>
                            </div>
                            <!--Posisi Penugasan dipakai untuk mengisi Posisi yang diusulkan-->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Posisi yang diusulkan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $result['posisi'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $result['perusahaan'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="<?= $result['kategori'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['alamat'] ?>">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['kota'] ?>">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <?php

    
     
    
                                $tgl = isset($result['tgl']) ? $result['tgl'] : '';
                                if ($tgl != '0000-00-00' && $tgl != null  && $tgl != '') {
                  
                                    $tgl = substr($result['tgl'], 8, 2);
                                    $bln = substr($result['tgl'], 5, 2);
                                    $thn = substr($result['tgl'], 0, 4);
                                    //  Ini memanggil fungsi dari custom_helper
    
                                    helper('custom_helper'); // Loading single helper
                                    //  Memanggil fungsi NamaBulan() untuk mencetak nama-nama bulan
                                    $bulan = NamaBulan($bln);
                                    //  Sambung menyambung menjadi satu
                                    $tgl_lahir = $tgl . " " . $bulan . " " . $thn; 
                                } else {
                                    $tgl_lahir = "";
                                }

                                ?>
                                <label class="col-sm-2 col-form-label">Tgl.lahir</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" value="<?= $tgl_lahir ?>" readonly />
                                </div>

                                <label class="col-sm-1 col-form-label">Usia</label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control" value="<?= $result['usia'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?= $result['no_ktp'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="<?= $result['no_npwp'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Telp.</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['no_telp'] ?>">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">HP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['no_hp'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="<?= $result['email'] ?>">
                                </div>
                            </div>


                            <label class="col-sm-2 col-form-label" style="width: 120px;">Pendidikan</label><br>

                            <div class="mb-1 row">
                                <br><label class="col-sm-1 col-form-label" style="width: 20px;">S1</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" readonly value="<?= $result['ijazahS1'] ?>">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" readonly value="<?= $result['s1_univ'] ?>">
                                </div>
                                <label class="col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" readonly value="<?= $result['s1_thn'] ?>">
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-sm-1 col-form-label" style="width: 20px;">S2</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" readonly value="<?= $result['ijazahS2'] ?>">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" readonly value="<?= $result['s2_univ'] ?>">
                                </div>
                                <label class="col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" readonly value="<?= $result['s2_thn'] ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-1 col-form-label" style="width: 20px;">S3</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" readonly value="<?= $result['ijazahS3'] ?>">
                                </div>
                                <label class="col-sm-2 col-form-label" style="width: 80px;">Universitas</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" readonly value="<?= $result['s3_univ'] ?>">
                                </div>
                                <label class="col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" readonly value="<?= $result['s3_thn'] ?>">
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <br><span class="input-group-text">Nomor SIPP</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['sipp'] ?>" />
                                <span class="input-group-text">Tgl. kadaluarsa</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['sipp_ed'] ?>" />
                            </div>

                            <div class="input-group mb-3">
                                <br><span class="input-group-text" id="str">Nomor STR</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['str'] ?>" />
                                <span class="input-group-text" id="str_ed">Tgl. kadaluarsa</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['str_ed'] ?>" />
                            </div>

                            <div class="input-group mb-3">
                                <br><span class="input-group-text">Nomor KTA</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['kta'] ?>" />
                                <span class="input-group-text">Tgl. kadaluarsa</span>
                                <input type="text" class="input-group-text" readonly value="<?= $result['kta_ed'] ?>" />
                            </div>

                            <div class="mb-3 row">
                                <br><div class="col-sm-2">Asosiasi</div>
                                <div class="col-sm-8">
                                    <input type="text" style="width: 500px;" readonly value="<?= $result['asosiasi'] ?>" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <br><div class="col-sm-2">Status kepegawaian </div>
                                <div class="col-sm-8">
                                    <input type="text" style="width: 500px;" readonly value="<?= $result['status'] ?>" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <?php
                                    $ref = isset($result['ref']) ? $result['ref'] : '';
                                ?>
                                <br><div class="col-sm-2">Referensi</div>
                                <div class="col-sm-8">
                                    <input type="text" style="width: 500px;" readonly value="<?= $ref ?>" />
                                </div>
                                <a href="<?=base_url('uploads/'.$ref)?>" target="_blank" 
                                style="font-style: italic;">Tampilkan Pdf</a>
                                
                            </div>
                            <a href="/ta" class="btn btn-primary m-2" style="height: 40px; width: 110px">
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


<?= $this->endsection(); ?>