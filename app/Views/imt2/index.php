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
                        <?php if (session('sukses-edit')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-edit');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('add-failed')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('add-failed');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('gagal-semua-intermitten')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('gagal-semua-intermitten');
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url("/imt2/intermitten_detil") ?>" method="GET" target="_blank">
                            <table id="tabel" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><button type="submit" name="intmt" value="" style="width: 10; height: 20px; padding: 0px 0px 0px 0px; text-align: center; font-weight: bold;" class="tombol" title="Cetak intermitten"><i class="fa-solid fa-diagram-project"></i></button>
                                        </th>
                                        <th style="text-align:center; width:5%">No.</th>
                                        <th style="text-align:center; width:10%">Kode</th>
                                        <th style="text-align:center; width:50%">Nama</th>
                                        <th style="text-align:center; width:10%">KTP</th>
                                        <th style="text-align:center; width:20%">NPWP</th>
                                        <th style="text-align:center; width:5%">CV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($rh) {

                                        $no = 1;
                                        foreach ($rh as $v) {
                                            $id = isset($v['id']) ? $v['id'] : '';
                                            $kode = isset($v['kode_ta']) ? $v['kode_ta'] : '';
                                            $nama = isset($v['nama']) ? $v['nama'] : '';
                                            $no_ktp = isset($v['no_ktp']) ? $v['no_ktp'] : '';
                                            $no_npwp = isset($v['no_npwp']) ? $v['no_npwp'] : '';
                                    ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ckval[]" value="<?= $kode ?>">
                                                </td>
                                                <td style="width:5%"><?= $no ?></td>
                                                <td style="width:10%"><?= $kode ?></td>
                                                <td id="#name" style="width:50%"><?= $nama ?></td>
                                                <td style="width:10%;"><?= $no_ktp ?></td>
                                                <td style="width:20%;"><?= $no_npwp ?></td>
                                                <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                                <td style="width:5%; text-align:center">
                                                    <a target="_blank" href="/cv/cetak/<?= $kode; ?>">
                                                        <i class="fa-solid fa-print" title="Cetak Riwayat Hidup"></i>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- /.content -->
<?= $this->endsection(); ?>