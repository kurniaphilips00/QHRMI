<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" style="width:120px; background-color:#90e1f5; color:black" 
                        class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#tambah">
                            Tambah
                        </button><br>
                    </div>

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
                                <th style="text-align:center; width:15%">Jenis</th>
                                <th style="text-align:center; width:10%">Nomor</th>
                                <th style="text-align:center; width:15%">Instansi</th>
                                <th style="text-align:center; width:15%">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($ijin) {
                                $no = 0;
                                foreach ($ijin as $v) {
                                    $id = isset($v['id']) ? $v['id'] : '';
                                    $namafile = isset($v['namafile']) ? $v['namafile'] : '';
                                    $nomor = isset($v['nomor']) ? $v['nomor'] : '';
                                    $jenis = isset($v['jenis']) ? $v['jenis'] : '';
                                    $instansi = isset($v['instansi']) ? $v['instansi'] : '';
                                    $kualifikasi = isset($v['kualifikasi']) ? $v['kualifikasi'] : '';
                                    $tglkadaluarsa = isset($v['tglkadaluarsa']) ? $v['tglkadaluarsa'] : '';
                            ?>
                                    <tr>
                                        <td style="width:20%">
                                        <a href="<?=base_url('uploads/'.$namafile)?>" target="_blank"><?= $v['namafile'] ?></a>
                                        </td>
                                        <td style="width:15%;"><?= $v['jenis'] ?></td>
                                        <td style="width:10%"><?= $v['nomor'] ?></td>
                                        <td style="width:15%"><?= $v['instansi'] ?></td>
                                        <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                        <td style="width:15%; text-align:center">
                                     <!--       <button type="button" class="btn btn-sm btn-warning" title="Tampilkan">
                                                <a href="<?= base_url('uploads/' . $namafile) ?>" target="_blank">
                                                <i class="fa-solid fa-magnifying-glass"></i></a>
                                            </button>|-->
                                            
                                            <button type="button" class="btn btn-sm btn-warning" title="baca"
                                            data-bs-toggle="modal" data-bs-target="#baca<?= $id; ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            |
                                            <button type="button" class="btn btn-sm btn-warning" title="edit">
                                             <a href="" data-bs-toggle="modal" data-bs-target="#update<?= $id; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i></button>
                                                    |
                                                    
                                                    <button type="button" class="btn btn-sm btn-warning" title="hapus">
                                                <a href="/delete-ijin/<?= $v['id']; ?>" onclick="return confirm('Yakin ingin menghapus')">
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
