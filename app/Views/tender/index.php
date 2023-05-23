<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                    
                        <form class="row"  method="post">
                                <a href="<?= route_to('tender.tambah') ?>" 
                                class="btn btn-primary mx-2" 
                                style="width:90; margin-left:10px; background-color:#90e1f5; color:black">
                                    <i class="fas fa-plus-circle"></i>Tambah</a>
                        </form>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (session('sukses-tambah')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah');  //  Add success 
                                ?>
                            </div>
                        <?php endif; ?>
                    

                        <?php if (session('sukses-hapus')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-hapus');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('sukses-edit')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-edit');  //  Edi success 
                                ?>
                            </div>
                        <?php endif; ?>

                        

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">Kode</th>
                                    <th style="text-align:center; width:25%">Tender</th>
                                    <th style="text-align:center; width:20%">Instansi</th>
                                    <th style="text-align:center; width:20%">Metode Pengadaan</th>
                                    <th style="text-align:center; width:10%">Link LPSE</th>
                                    <th style="text-align:center; width:10%">Link Jadwal LPSE</th>
                                    <th style="text-align:center; width:20%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($tender) {
                                    $no = 0;
                                    foreach ($tender as $v) {
                                        $id = isset($v['id']) ? $v['id'] : '';
                                        $Kode = isset($v['Kode']) ? $v['Kode'] : '';
                                        $Nama = isset($v['Nama']) ? $v['Nama'] : '';
                                        $Instansi = isset($v['Instansi']) ? $v['Instansi'] : '';
                                        $MetodePengadaan = isset($v['MetodePengadaan']) ? $v['MetodePengadaan'] : '';
                                        $LPSE = isset($v['LPSE']) ? $v['LPSE'] : '';
                                        $JadwalLPSE = isset($v['JadwalLPSE']) ? $v['JadwalLPSE'] : '';
                                ?>
                                        <tr>
                                            <td style="width:5%"><?= $Kode; ?></td>
                                            <td style="width:25%"><?= $Nama; ?></td>
                                            <td style="width:20%"><?= $Instansi; ?></td>
                                            <td style="width:20%"><?= $MetodePengadaan; ?></td>
                                            <td style="width:10%"><a target="_blank" href="<?= $LPSE ?>"><?= $LPSE ?></a></td>
                                            <td style="width:10%"><a target="_blank" href="<?= $JadwalLPSE ?>"><?= $JadwalLPSE; ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:20%; text-align:center">
                                                <a href="/tender/baca/<?= $id ?>">
                                                    <i class="fa-solid fa-magnifying-glass" title="baca"></i>|
                                                    <a href="/tender/edit/<?= $id; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i>|
                                                        <a href="/tender/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tender ?')">
                                                            <i class="fa-solid fa-trash-can" title="hapus"></i>
                                                        
                                            </td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->

                                        </tr>

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

<?= $this->endsection(); ?>