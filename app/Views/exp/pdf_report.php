<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Daftar Pengalaman</h1>
    </center>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="text-align:center; width:5%">No.</th>
                <th style="text-align:center; width:25%">Instansi</th>
                <th style="text-align:center; width:25%">Pekerjaan</th>
                <th style="text-align:center; width:15%">Mulai</th>
                <th style="text-align:center; width:15%">Selesai</th>
                <th style="text-align:center; width:5%">Tahun</th>
                <th style="text-align:center; width:5%">Referensi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) {
                $no = 1;
                foreach ($result as $v) {

                    $id = isset($v['id']) ? $v['id'] : '';
                    $tahun = isset($v['tahun']) ? $v['tahun'] : '';
                    $instansi = isset($v['instansi']) ? $v['instansi'] : '';
                    $pekerjaan = isset($v['pekerjaan']) ? $v['pekerjaan'] : '';
                    $referensi = isset($v['referensi']) ? $v['referensi'] : '';
                    $mulai = isset($v['mulai']) ? $v['mulai'] : '';
                    $selesai = isset($v['selesai']) ? $v['selesai'] : '';
                    if ($mulai != null && $mulai != '0000-00-00') {
                        $tgl = new DateTime($mulai);
                        $tgl_mulai = $tgl->format('d-m-Y'); //  Menampilkan format Indo

                    } else {
                        $tgl_mulai = 'kosong';
                    }
                    if ($selesai != null &&  $selesai != '0000-00-00') {
                        $tgl = new DateTime($selesai);
                        $tgl_selesai = $tgl->format('d-m-Y'); //  Menampilkan format Indo
                    } else {
                        $tgl_selesai = 'kosong';
                    }

            ?>
                    <tr>
                        <td style="width:5%"><?= $no; ?></td>
                        <td style="width:25%"><?= $instansi ?></td>
                        <td style="width:25%"><?= $pekerjaan ?></td>
                        <td style="width:15%"><?= $tgl_mulai ?></td>
                        <td style="width:15%"><?= $tgl_selesai ?></td>
                        <td style="width:5%"><?= $tahun ?></td>
                        <td style="width:5%"><?= $referensi ?></td>
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
</body>

</html>