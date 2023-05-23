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
                            <a href="<?= route_to('posisi.tambah') ?>" 
                                class=btn btn-primary style="width:120px; background-color:#90e1f5; margin-right: 1em;">
                                <i class="fa-solid fa-circle-plus"></i>Tambah</a>
                        </div>

                        <form action="posisi/importExcel" method="post" enctype="multipart/form-data" style="display: inline;">
                                    <div class="btn-group" role="group" >
                                        <label for="files" class="btn">Pilih file excel</label>
                                        <input id="files"  type="file" accept=".xls, .xlsx, .ods" name='excel'>
                                    </div>
                                    <button title="<?= $judul ?>" 
                                    onclick="return confirm('Tabel pengalaman akan dikosongkan, yakin ingin impor ?')"
                                    type="submit" 
                                    class="btn btn-primary" style="width:90px;height: 30px; background-color:#90e1f5; color:black">
                                            <i class="fa-sharp fa-solid fa-upload"></i>Import</button>
                                    
                                            <a href="posisi/exportExcel" class="btn btn-primary" 
                                    style="width:80px; height:30px; background-color:#90e1f5; margin-right: 20px; color:black" 
                                    title="Export to Excel">Export<i class="fa-solid fa-file-arrow-down"></i></a>
                            </form>

                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('sukses-update-posisi')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-update-posisi');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:10%">Kode</th>
                                    <th style="text-align:center; width:20%">Posisi</th>
                                    <th style="text-align:center; width:50%">Uraian Tugas</th>
                                    <th style="text-align:center; width:20%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($posisi) {
                                    $no = 1;
                                    foreach ($posisi  as $v) {
                                        $id = isset($v['id']) ? $v['id'] : '';
                                        $kode = isset($v['kode_posisi']) ? $v['kode_posisi'] : '';
                                        $posisi = isset($v['posisi']) ? $v['posisi'] : '';
                                        $uraiantugas = isset($v['uraiantugas']) ? $v['uraiantugas'] : '';
                                        $uraiantugas = str_replace("&lt;ol&gt;","",$uraiantugas);
                                        $uraiantugas = str_replace("&lt;li&gt;","",$uraiantugas);
                                        $uraiantugas = str_replace("&lt;/li&gt;","",$uraiantugas);
                                        $uraiantugas = str_replace("&lt;/ol&gt;","",$uraiantugas);
                                       
                                ?>
                                        <tr>
                                            <td style="width:10%"><?= $kode ?></td>
                                            <td style="width:20%"><?= $posisi; ?></td>
                                            <td style="width:50%; text-align: justify;"><?= $uraiantugas; ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:20%; text-align:center">
                                                <a href="/posisi/baca/<?= $id; ?>">
                                                <i class="fa-solid fa-glasses"  title="baca"></i>
                                                <a href="/posisi/edit/<?= $v['id']; ?>">
                                                    <i class="fa-solid fa-pencil" title="edit"></i>
                                                <a href="/posisi/hapus/<?= $v['id']; ?>" 
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

<!-- Start ckEditor 4 -->
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<?= $this->endsection(); ?>