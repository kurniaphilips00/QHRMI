<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="<?= route_to('kategori.tambah') ?>" 
                                class=btn btn-primary 
                                style="width:120px; background-color:#90e1f5; margin-right: 1em;">
                                <i class="fa-solid fa-circle-plus"></i>Tambah</a>
                        </div>
                    <br><br>
                    <?php if (session('del-success')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('del-success');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <br><br>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th style="text-align:center; width:10%">No.</th>
                                    <th style="text-align:center; width:50%">Kategori</th>

                                    <th style="text-align:center; width:20%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($kategori) {
                                    $no = 1;
                                    foreach ($kategori    as $v) {
                                        // $id = isset($v['id']) ? $v['id'] : '';
                                        // $kategori  = isset($v['kategori ']) ? $v['kategori'] : '';

                                ?>
                                        <tr>
                                            <td style="width:10%"><?= $no; ?></td>
                                            <td style="width:50%"><?= $v['kategori']; ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:20%; text-align:center">
                                                    <a href="/kategori/edit/<?= $v['id']; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i>
                                                    <a href="/kategori/hapus/<?= $v['id']; ?>" 
                                                    onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
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


<?= $this->endsection(); ?>