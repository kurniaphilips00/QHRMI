<?= $this->extend('layout/dashboard-layout'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    

                    <a href="/akta/tambah" class="btn btn-primary" 
                                style="width:90px; background-color:#037bfc; margin-right: 10px;">
                                    <i class="fas fa-plus-circle"></i>Tambah</a>
                </div>
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
                    <?php if (session('sukses-edit')) :  ?>
                        <div class="alert alert-info" role="alert">
                            <?= session('sukses-edit');  //  Delete success 
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:20%">Nama File</th>
                                <th style="text-align:center; width:15%">Dokumen</th>
                                <th style="text-align:center; width:10%">Nomor</th>
                                <th style="text-align:center; width:15%">Notaris</th>
                                <th style="text-align:center; width:15%">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($doc) {
                                $no = 0;
                                foreach ($doc as $v) {
                                    $id = isset($v['id']) ? $v['id'] : '';
                                    
                            ?>
                                    <tr>
                                        <td style="width:15%;"><?= $v['namafile'] ?></td>
                                        <td style="width:15%;"><?= $v['dokumen'] ?></td>
                                        <td style="width:10%"><?= $v['nomor'] ?></td>
                                        <td style="width:15%"><?= $v['notaris'] ?></td>
                                        <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                        <td style="width:15%; text-align:center">
                                   
                                            
                                            <button type="button" class="btn btn-sm btn-warning" title="baca"
                                            data-bs-toggle="modal" data-bs-target="#baca<?= $id; ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            |
                                            <button type="button" class="btn btn-sm btn-warning" title="edit">
                                             <a href="" data-bs-toggle="modal" data-bs-target="#update<?= $id; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i></button>
                                                    |
                                                    
                                                    <button type="button" class="btn btn-sm btn-warning" title="hapus">
                                                <a href="/delete-akta/<?= $v['id']; ?>" onclick="return confirm('Yakin ingin menghapus')">
                                                    <i class="fa-solid fa-trash-can"></i></button>
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

<script>
    function tampil() { //Mengatur tampilan format tanggal lahir
        //Mengambil tanggal lahir baru dari input date 
        const tgl = new Date(document.getElementById('tgl').value);
        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let hari = tgl.getDate();
        let tglterbit = tahun + '-' + bulan + '-' + hari;
        document.getElementById('terbit').value = tglterbit;
    }
    function konver() { //Mengatur tampilan format tanggal lahir
        //Mengambil tanggal lahir baru dari input date 
        const tgl = new Date(document.getElementById('tglkonver').value);
        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let hari = tgl.getDate();
        let tanggal = tahun + '-' + bulan + '-' + hari;
        document.getElementById('tglakta').value = tanggal;
    }
</script>


<?= $this->endsection(); ?>
