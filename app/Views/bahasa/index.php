<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="<?= route_to('bahasa.tambah') ?>" 
                                class=btn btn-primary style="width:120px; background-color:#90e1f5; margin-right: 1em;">
                                <i class="fa-solid fa-circle-plus"></i>Tambah</a>
                        </div>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('sukses-update-bahasa')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-update-bahasa');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('delete-success')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('delete-success');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:30%">No.</th>
                                    <th style="text-align:center; width:30%">Tenaga Ahli</th>
                                    <th style="width:15%">Nilai Bahasa Indonesia</th>
                                    <th style="width:15%">Nilai bahasa Inggris</th>
                                    <th style="width:15%">Nilai bahasa setempat</th>
                                    <th style="width:20%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($bhs) {
                                    $no = 1;
                                    foreach ($bhs as $v) {
                                        $id = isset($v['id_bahasa']) ? $v['id_bahasa'] : '';
                                        $nama_ta = isset($v['nama_ta']) ? $v['nama_ta'] : '';
                                        $nilai_bhs_indo = isset($v['nilai_bhs_indo']) ? $v['nilai_bhs_indo'] : '';
                                        $nilai_bhs_inggris = isset($v['nilai_bhs_inggris']) ? $v['nilai_bhs_inggris'] : '';
                                        $nilai_bhs_setempat = isset($v['nilai_bhs_setempat']) ? $v['nilai_bhs_setempat'] : '';
                                ?>
                                        <tr>
                                            <td style="width:5%"><?= $no ?></td>
                                            <td style="width:30%"><?= $nama_ta ?></td>
                                            <td style="width:15%"><?= $nilai_bhs_indo; ?></td>
                                            <td style="width:15%"><?= $nilai_bhs_inggris; ?></td>
                                            <td style="width:15%"><?= $nilai_bhs_setempat; ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:15%; text-align:center">
                                                <a href="/bahasa/baca/<?= $id ?>">
                                                    <i class="fa-solid fa-magnifying-glass" title="baca"></i>
                                                    |<a href="/bahasa/edit/<?= $id; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i>|
                                                        <a href="/bahasa/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                                                            <i class="fa-solid fa-trash-can" title="hapus"></i>
                                            </td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                        </tr>
                                        <?php $no++; ?>
                                    <?php
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
    function cari_pengalaman() {
        // alert('Hail');
        const v = document.getElementById('names').value;
        if (v != '') {
            let names = document.getElementById('names');
            names.onclick = function(event) {
                var target = event.target;
                var nama = event.target.value;
                window.location.href = "/fNama/" + nama;
            };
        }

    }

    function ShowExperts($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/ExpertsList/" + $id
    }
</script>
<?= $this->endsection(); ?>