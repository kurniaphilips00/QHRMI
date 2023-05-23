<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center><h1>Daftar Tenaga Ahli</h1></center>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="text-align:center; width:5%">No.</th>
                <th style="text-align:center; width:40%">Nama</th>
                <th style="text-align:center; width:10%">SIPP</th>
                <th style="text-align:center; width:10%">Tgl. Kadaluarsa</th>
                <th style="text-align:center; width:10%">Keterangan (hari)</th>
                <th style="text-align:center; width:25%">Posisi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) {

                $no = 1;
                foreach ($result as $v) {

                    // Cek Value dari $v['sipp_ed'];
                    $tglED_SIPP = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                    $keterangan_SIPP = "";
                    //////////     SIPP ED    //////////////////////////////////////

                    if ($tglED_SIPP != '0000-00-00') {
                        if ($tglED_SIPP == '' || $tglED_SIPP == null) {
                            $keterangan_SIPP = "kosong";
                        } else {
                            $tglED_SIPP = new DateTime($tglED_SIPP);
                            $skrg = date_create();
                            if ($skrg > $tglED_SIPP) {
                                //$ED_for_SIPP = date_diff($skrg, $tglED);
                                $keterangan_SIPP = "kadaluarsa";
                            } else {
                                $ED_for_SIPP = date_diff($tglED_SIPP, $skrg);
                                //dd($ED_for_SIPP);
                                if ($ED_for_SIPP->days > 90) {
                                    $keterangan_SIPP = "> 90 hari";
                                } elseif ($ED_for_SIPP->days > 30 && $ED_for_SIPP->days <= 90) {
                                    $keterangan_SIPP = "< 90 hari(>30)";
                                } elseif ($ED_for_SIPP->days <= 30) {
                                    $keterangan_SIPP = "< 30 hari";
                                } else {
                                    $keterangan_SIPP = $ED_for_SIPP->days;
                                }
                            }
                            $tglED_SIPP = $tglED_SIPP->format('d-m-Y');
                        }
                    } else {
                        $keterangan_SIPP = "kosong";
                    }
                    //////////    END OF SIPP ED    //////////////////////////////////////

                    $id = isset($v['id']) ? $v['id'] : '';
                    $nama = isset($v['nama']) ? $v['nama'] : '';
                    $sipp = isset($v['sipp']) ? $v['sipp'] : '';
                    $sipp_ed = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                    $posisi = isset($v['posisi']) ? $v['posisi'] : '';
            ?>
                    <tr>
                        <!--    <td style="width:5%; text-align:center"></td> -->
                        <td id="#id" style="width:5%"><?= $no ?></td>
                        <td id="#name" style="width:40%"><?= $nama ?></td>
                        <td style="width:10%"><?= $sipp ?></td>
                        <td style="width:10%"><?= $tglED_SIPP; ?></td>
                        <!-- Mencetak keterangan sudah kadaluarsa, kurang 3 bulan atau 1 bulan, 
                                            masih berlaku lama (lebih dari 3 bulan)----->

                        <?php if ($keterangan_SIPP == "> 90 hari") :  ?>
                            <!--Background hijau tulisan putih > belum kadaluarsa-->
                            <td style="width:10%; text-align:center;background-color:#0d9e16;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>

                        <?php elseif ($keterangan_SIPP == "kadaluarsa") :  ?>
                            <!--Background merah tulisan putih > sudah kadaluarsa-->
                            <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>

                        <?php elseif ($keterangan_SIPP == "< 30 hari") : ?>
                            <!--Background kuning tulisan hitam > kurang 1(satu) bulan lagi kadaluarsa-->
                            <td style="width:10%; text-align:center;background-color:#f07205;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>
                        <?php elseif ($keterangan_SIPP == "< 90 hari(>30)") : ?>
                            <!--Background orange tulisan putih > kurang 3(tiga) bulan lagi kadaluarsa-->
                            <td style="width:10%; text-align:center;background-color:#f4fa87;color:black; font-weight:bold"><?= $keterangan_SIPP ?></td>
                        <?php else : ?>
                            <!-- kosong ----------------------------------------------------------------->
                            <td style="width:10%; text-align:center;"><?= $keterangan_SIPP ?></td>
                        <?php endif; ?>
                        <!--<td style="width:10%;text-align:center;"></td>-->
                        <td style="width:25%;text-align:left;"><?= $posisi ?></td>
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