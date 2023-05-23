<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<style>
.tombol {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.tombol:hover {
  background-color: RoyalBlue;
}
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mx-2">
                        <!------------------Awal baris tombol-tombol editing-------------------------------------------------------------->
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <a href="<?= route_to('ta.tambah') ?>" class="btn btn-primary" style="width:90px; background-color:#037bfc; margin-right: 5px; ">
                                <i class="fas fa-plus-circle"></i>Tambah</a>

                            <form action="/imporExcel" method="post" enctype="multipart/form-data" 
                            style="display: inline;">
                                <div class="btn-group" role="group">
                                    <label for="files" class="btn">Pilih file excel</label>
                                    <input id="files" type="file" accept=".xls, .xlsx, .ods" name='excel'>
                                </div>
                               
                                <button onclick="return confirm('Tabel tenaga ahli akan dikosongkan, yakin ingin impor ?')" 
                                type="submit" class="btn" style="width:80px;height: 30px; background-color:#90e1f5; color:black">
                                    <i class="fa-sharp fa-solid fa-upload"></i>Import</button>

                                <a href="/exporExcel" class="btn btn-primary" style="width:75px; height:30px; background-color:#90e1f5; margin-right: 20px; color:black" title="Export to Excel">Export<i class="fa-solid fa-file-arrow-down"></i></a>
                            </form>
                            <a href="/ta/cetakpdf" style="width:40px; font-size: 30px; color:black; padding-top:0; 
                            padding-bottom:0; background-color:none" 
                            title="Export to pdf"><i class="fa-solid fa-file-pdf"></i></a>
                            
                            <button type="button" style="width:50px; background-color:#90e1f5; margin-right: 5px;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter Usia">
                                Usia
                            </button>
                            <ul class="dropdown-menu" id="test">
                                <li><a class="dropdown-item" href="/ta/usia/20">20-30</a></li>
                                <li><a class="dropdown-item" href="/ta/usia/30">30-40</a></li>
                                <li><a class="dropdown-item" href="/ta/usia/40">40-50</a></li>
                                <li><a class="dropdown-item" href="/ta/usia/50">50-60</a></li>
                                <li><a class="dropdown-item" href="/ta/usia/60">60-70</a></li>
                                <li><a class="dropdown-item" href="/ta/usia/70">70-80</a></li>
                            </ul>
                            <button type="button" style="width:50px; background-color:#90e1f5; margin-right: 5px;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S1">
                                S1
                            </button>
                            <ul class="dropdown-menu" id="EDU" onclick="pendidikan()">
                                <li><a class="dropdown-item" href="/ta/sarjana/Psikologi">Psikologi</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Teknik">Teknik</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Sains">Sains</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Manajemen">Manajemen</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Ekonomi">Ekonomi</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Administrasi">Administrasi</a></li>
                                <li><a class="dropdown-item" href="/ta/sarjana/Kedokteran">Kedokteran</a></li>
                            </ul>
                            <button type="button" style="width:50px; background-color:#90e1f5; margin-right: 5px;" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S2">
                                S2
                            </button>
                            <ul class="dropdown-menu" id="EDUS2" onclick="pendidikanS2()">
                                <li><a class="dropdown-item" href="/ta/master/Psikologi">Psikologi</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Teknik">Teknik</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Sains">Sains</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Manajemen">Manajemen</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Ekonomi">Ekonomi</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Administrasi">Administrasi</a></li>
                                <li><a class="dropdown-item" href="/ta/master/Kedokteran">Kedokteran</a></li>
                            </ul>
                            <button type="button" style="width:50px; background-color:#90e1f5; margin-right: 10px;" class="btn btn-light dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false" title="Filter S3">
                                S3
                            </button>
                            <ul class="dropdown-menu" id="EDUS3" onclick="doktor()" style=" margin-left: 1px;">
                                <li><a class="dropdown-item" href="/ta/doktor/Psikologi">Psikologi</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Teknik">Teknik</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Sains">Sains</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Manajemen">Manajemen</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Ekonomi">Ekonomi</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Administrasi">Administrasi</a></li>
                                <li><a class="dropdown-item" href="/ta/doktor/Kedokteran">Kedokteran</a></li>
                            </ul>
                        </div>
                        <!------------------Akhir baris tombol-tombol editing-------------------------------------------------------------->
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('sukses-tambah')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('sukses-hapus')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-hapus');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (session('sukses-hapus-semua')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-hapus-semua');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('gagal-hapus-semua')) :  ?>
                            <div class="alert alert-info" role="alert", style="color:red">
                                <?= session('gagal-hapus-semua');  //  Gagal hapus 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (session('sukses-edit')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-edit');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('add-failed')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('add-failed');  //  Gagal menambah 
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url("/ta/hapus_semua")?>" method="POST">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><button type="submit" name="dell_all" value="Hapus semua diklik"
                                        
                                        style="width: 20px; height: 20px; background:red; color: white; padding:0; text-align: center;"
                                        class="tombol" title="Hapus semua baris terpilih">x</button>
                                        </th>
                                        <th style="width:5%">No</th>    
                                        <th style="text-align:center; width:5%">Kode</th>
                                        <th style="text-align:center; width:35%">Nama</th>
                                        <th style="text-align:center; width:10%">SIPP</th>
                                        <th style="text-align:center; width:10%">Tgl. Kadaluarsa</th>
                                        <th style="text-align:center; width:10%">Keterangan (hari)</th>
                                        
                                        <th style="text-align:center; width:15%">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($cv) {
                                        $no = 1;
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
                                                        //dd($ED_for_SIPP);
                                                        if ($ED_for_SIPP->days > 90) {
                                                            $keterangan_SIPP = "> 90 hari";
                                                        } elseif ($ED_for_SIPP->days > 30 && $ED_for_SIPP->days <= 90) {
                                                            $keterangan_SIPP = "< 90 hari(>30)";
                                                        } elseif ($ED_for_SIPP->days <= 30) {
                                                            $keterangan_SIPP = "< 30 hari";
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

                                            $id = isset($v['id']) ? $v['id'] : '';
                                            $kode = isset($v['kode_ta']) ? $v['kode_ta'] : '';
                                            $nama = isset($v['nama']) ? $v['nama'] : '';
                                            $sipp = isset($v['sipp']) ? $v['sipp'] : '';
                                            $sipp_ed = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                                            $posisi = isset($v['posisi']) ? $v['posisi'] : '';
                                    ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" style="width: 20px; text-align:center;"
                                                    name="ckval[]" value="<?=$id?>">
                                                </td>
                                                <td style="width:5%;"><?= $no ?></td>
                                                <td style="width:5%"><?= $kode ?></td>
                                                <td id="#name" style="width:35%"><?= $nama ?></td>
                                                <td style="width:10%"><?= $sipp ?></td>
                                                <td style="width:10%"><?= $tglED_SIPP; ?></td>
                                                <!-- Mencetak keterangan sudah kadaluarsa, kurang 3 bulan atau 1 bulan, 
                                                masih berlaku lama (lebih dari 3 bulan)----->
                                                <?php if ($keterangan_SIPP == "> 90 hari") :  ?>
                                                    <!--Background hijau tulisan putih > belum kadaluarsa-->
                                                    <td style="width:10%; text-align:center;background-color:#0d9e16;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>

                                                <?php elseif ($keterangan_SIPP == "kadaluarsa") :  ?>
                                                    <!--Background merah tulisan putih > sudah kadaluarsa-->
                                                    <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>

                                                <?php elseif ($keterangan_SIPP == "< 30 hari") : ?>
                                                    <!--Background kuning tulisan hitam > kurang 1(satu) bulan lagi kadaluarsa-->
                                                    <td style="width:10%; text-align:center;background-color:#f07205;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>
                                                <?php elseif ($keterangan_SIPP == "< 90 hari(>30)") : ?>
                                                    <!--Background orange tulisan putih > kurang 3(tiga) bulan lagi kadaluarsa-->
                                                    <td style="width:10%; text-align:center;background-color:#f4fa87;color:black; font-weight:bold"><?= $keterangan_SIPP ?></td>
                                                <?php else : ?>
                                                    <!-- kosong ----------------------------------------------------------------->
                                                    <td style="width:10%; text-align:center;"><?= $keterangan_SIPP ?></td>
                                                <?php endif; ?>
                                               
                                                <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                                <td style="width:15%; text-align:center">
                                                    <a href="/ta/baca/<?= $kode; ?>">
                                                        <i class="fa-solid fa-glasses" title="baca"></i>
                                                        |<a href="/ta/edit/<?= $id; ?>">
                                                            <i class="fa-solid fa-pencil" title="edit"></i>|
                                                            <a href="/ta/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                                                                <i class="fa-solid fa-trash-can" title="hapus"></i>
                                                                
                                                </td>

                                            </tr>

                                        <?php
                                            $no++;
                                        }
                                    } else { ?>

                                        <tr>
                                            <td colspan="5">Tidak ada data(kosong)..........................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</td>
                                        </tr>
                                    <?php


                                    } ?>


                                </tbody>

                            </table>
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

    function pendidikan() {
        let ed = document.getElementById('EDU');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            window.location.href = "/sarjana/" + pendidikan;
        };
    }

    function pendidikanS2() {
        let ed = document.getElementById('EDUS2');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            //  alert(pendidikan);
            window.location.href = "/master/" + pendidikan;
        };
    }

    function doktor() {
        let ed = document.getElementById('EDUS3');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            //  alert(pendidikan);
            window.location.href = "/doktor/" + pendidikan;
        };
    }

    function filter_nama() {
        let name = document.getElementById('names');
        name.onclick = function(event) {
            var target = event.target;
            var nama = event.target.value;
            //  alert (nama);
            window.location.href = "/fNama/" + nama;
        };
    }
</script>

<?= $this->endsection(); ?>