<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    table,
    th,
    td {
        border: 1px solid white;
        border-collapse: collapse;
    }
    th,
    td {
        background-color: #96D4D4;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mx-2">
                        <h2>
                            <center>Daftar Tenaga Ahli</center>
                        </h2>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="<?= base_url("/cv/intermitten") ?>" method="GET" target="_blank">
                            <table id="tabel">
                                <thead>
                                    <tr>
                                        <th><button type="submit" name="intmt" value="Intermitten diklik" style="width: 10; height: 20px; padding: 0px 0px 0px 0px; text-align: center; font-weight: bold;" class="tombol" title="Cetak intermitten"><i class="fa-solid fa-diagram-project"></i></button>
                                        </th>
                                        <th style="text-align:center; width:5%">Kode</th>
                                        <th style="text-align:center; width:50%">Nama</th>
                                        <th style="text-align:center; width:10%">KTP</th>
                                        <th style="text-align:center; width:20%">NPWP</th>
                                        <th style="text-align:center; width:5%">
                                            <i class="fa fa-print" aria-hidden="false" title="Cetak Riwayat Hidup"></i>
                                        </th>

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
                                                <td style="width:5%"><?= $kode ?></td>
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
<!-- /.content -->



<script>
    function inter() {
        alert('$kode');
        //window.location.href = "/laporanIntermitten/" + $kode
    }

    function cetakIntermitten($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/laporanIntermitten/" + $id
    }
</script>

<?= $this->endsection(); ?>