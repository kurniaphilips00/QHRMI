<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">

                    <?php if (session('success-delete')) :  ?>
                        <div class="alert alert-info" role="alert">
                            <?= session('success-delete');  //  Delete success 
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="/ta-exp/tambah" class="btn btn-primary" style="width:100px; background-color:#90e1f5; margin-right: 1em; color:black" tittle="Tambah tenaga ahli">
                                <i class="fa-solid fa-circle-plus"></i> Tambah</a>
                        </div>

                        <form action="ta-exp/importExcel" method="post" enctype="multipart/form-data" style="display: inline;">
                            <div class="btn-group" role="group">
                                <label for="files" class="btn">Pilih file excel</label>
                                <input id="files" type="file" accept=".xls, .xlsx, .ods" name='excel'>
                            </div>
                            <button title="Import to Excel" onclick="return confirm('Tabel pengalaman akan dikosongkan, yakin ingin impor ?')" type="submit" class="btn btn-primary" style="width:80px;height: 30px; background-color:#90e1f5; color:black">
                                <i class="fa-sharp fa-solid fa-upload"></i>Import</button>

                            <a href="ta-exp/importExcel" class="btn btn-primary" style="width:75px; height:30px; background-color:#90e1f5; margin-right: 20px; color:black" title="Export to Excel">Export<i class="fa-solid fa-file-arrow-down"></i></a>
                        </form>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('sukses-update-ta')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-update-ta');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">Kode Pengalaman</th>
                                    <!--   <th style="text-align:center; width:5%">Kode Tenaga Ahli</th>-->
                                    <th style="text-align:center; width:20%">Tenaga Ahli</th>
                                    <!-- <th style="text-align:center; width:5%">Kode Proyek</th>-->
                                    <th style="text-align:center; width:20%">Nama Pekerjaan</th>
                                    <!--    <th style="text-align:center; width:5%">Kode Posisi</th>-->
                                    <th style="text-align:center; width:10%">Jabatan</th>
                                    <th style="text-align:center; width:15%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($proyekTA) {
                                    $no = 1;
                                    foreach ($proyekTA as $v) {

                                        $id = isset($v['id']) ? $v['id'] : '';
                                        // echo($id);
                                        $kode_pengalaman = isset($v['kode_pengalaman']) ? $v['kode_pengalaman'] : '';
                                        $kode_TA = isset($v['kode_TA']) ? $v['kode_TA'] : '';
                                ?>
                                        <tr>

                                            <td style="width:5%; text-align:center;"><?= $kode_pengalaman; ?></td>
                                            <!--     <td style="width:5%; text-align:center;"><?= $v['kode_TA'] ?></td>  -->
                                            <td style="width:20%" onclick="inter(<?= $v['kode_TA'] ?>)"><?= $v['nama'] ?></td>
                                            <!--<td style="width:10%"><?= $v['kode_proyek'] ?></td>-->
                                            <td style="width:20%"><?= $v['pekerjaan'] ?></td>
                                            <!--<td style="width:5%"><?= $v['kode_posisi'] ?></td>-->
                                            <td style="width:10%"><?= $v['posisitugas'] ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:15%; text-align:center">

                                                <a target="_blank" href="/ta-exp/intermitten/<?= $kode_TA ?>" onclick="return confirm('Cetak intermitten ?')"><b><i class="fa-solid fa-diagram-project" title="intermitten"></i></b></i>|
                                                    <a href="/ta-exp/edit/<?= $id; ?>">
                                                        <i class="fa-solid fa-pencil" title="edit"></i>|

                                                        <a href="/ta-exp/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus pengalaman ?')">
                                                            <i class="fa-solid fa-trash-can" title="hapus"></i>

                                            </td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->

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
    function inter() {

        window.location.href = "/laporanIntermitten/" + $kode
    }

    function cetakCV($id) {
        window.location.href = "/laporanCV/" + $id
    }

    function FilterTAOrderByName() {
        let name = document.getElementById('TAOrderByName');
        name.onclick = function(event) {
            var target = event.target;
            var nama = event.target.value;
            //  alert (nama);
            window.location.href = "/ta-exp/FilterTAByName/" + nama;
        };
    }

    function FilterTAOrderByID() {
        let id = document.getElementById('TAOrderByID');
        id.onclick = function(event) {
            var target = event.target;
            var noID = event.target.value;
            //  alert (noID);
            window.location.href = "/ta-exp/FilterTAByID/" + noID;
        };
    }

    function FilterProyekByName() {
        let name = document.getElementById('ProyekByName');
        name.onclick = function(event) {
            var target = event.target;
            var nama = event.target.value;
            window.location.href = "/ta-exp/FilterProyekByName/" + nama;
        };
    }

    function FilterProyekByID() {
        let id = document.getElementById('ProyekByID');
        id.onclick = function(event) {
            var target = event.target;
            var expID = event.target.value;
            //    alert (exp);
            window.location.href = "/ta-exp/FilterProyekByID/" + expID; //exp=id_exp
        };
    }
</script>


<?= $this->endsection(); ?>