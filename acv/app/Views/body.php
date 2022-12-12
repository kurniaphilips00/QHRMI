
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($cv as $v) : ?>
                        <tr>
                            <?php
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
                                        if ($ED_for_SIPP->days <= 90) {
                                            $keterangan_SIPP = "< 90 hari";
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


                            //? //////////     STR ED    //////////////////////////////////////
                            // Cek Nilai Value dari $row['data1'];
                            $tglED_STR = isset($v['str_ed']) ? $v['str_ed'] : '';
                            $keterangan_STR = "";
                            if ($tglED_STR != '0000-00-00') {
                                if ($tglED_STR == '' || $tglED_STR == null) {
                                    $keterangan_STR = "kosong";
                                } else {
                                    $tglED_STR = new DateTime($tglED_STR);
                                    $skrg = date_create();
                                    if ($skrg > $tglED_STR) {
                                        $keterangan_STR = "kadaluarsa";
                                    } else {
                                        $ED_for_STR = date_diff($tglED_STR, $skrg);
                                        if ($ED_for_STR->days <= 90) {
                                            $keterangan_STR = "< 90 hari";
                                        } else {
                                            $keterangan_STR = $ED_for_STR->days;
                                        }
                                    }
                                    $tglED_STR = $tglED_STR->format('d-m-Y');
                                }
                            } else {
                                $keterangan_STR = "kosong";
                            }
                            //?   //////////    END OF STR ED    //////////////////////////////////////
                            $id = isset($v['id']) ? $v['id'] : '';
                            $nama = isset($v['nama']) ? $v['nama'] : '';
                            $sipp = isset($v['sipp']) ? $v['sipp'] : '';
                            $sipp_ed = isset($v['sipp_ed']) ? $v['sipp_ed'] : '';
                            $usia = isset($v['usia']) ? $v['usia'] : '';
                            ?>
                        <tr>
                            <td style="widht:5%"><?= $i; ?></td>

                            <td onclick="cetak(<?= $id ?>)" id="#name" style="width:25%"><?= $nama ?></td>
                            <td style="width:10%"><?= $sipp ?></td>
                            <!--        Mencetak tanggal SIPP   -------------------------------->
                            <td style="width:10%"><?= $tglED_SIPP; ?></td>

                            <!-- Mencetak keterangan sudah kadaluarsa atau sisa 3 bualn atau masih lama----->
                            <!--    JIKA SIPP KADALUARSA WARNA BACKGROUND MERAH  -->
                            <?php if ($keterangan_SIPP == "kadaluarsa") :  ?>
                                <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_SIPP ?></td>
                            <?php elseif ($keterangan_SIPP == "< 90 hari") : ?>
                                <td style="width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $keterangan_SIPP ?></td>
                            <?php else : ?>
                                <!--    JIKA BELUM KADALUARSA WARNA BACKGROUND PUTIH DAN LEBIH DARI 3 BULAN -->
                                <td style="width:10%; text-align:center;"><?= $keterangan_SIPP ?></td>
                            <?php endif; ?>


                            //?
                            <!-- Mencetak keterangan sudah kadaluarsa atau sisa 3 bulan atau lebih----->
                            //?
                            <!--    JIKA STR KADALUARSA WARNA BACKGROUND MERAH  -->
                            <?php if ($keterangan_STR == "kadaluarsa") :  ?>
                                <td style="width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $keterangan_STR ?></td>
                            <?php elseif ($keterangan_STR == "< 90 hari") : ?>
                                <td style="width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $keterangan_STR ?></td>
                            <?php else : ?>
                                //?
                                <!--    JIKA BELUM KADALUARSA WARNA BACKGROUND PUTIH  -->
                                <td style="width:10%; text-align:center;"><?= $keterangan_STR ?></td>
                            <?php endif; ?>

                            //?
                            <!--        Mencetak tanggal STR   >>>>>> diganti usia -------------------------------->
                            <td style="width:10%; text-align:center;"><?= $usia; ?></td>

                            <td style="width:15%; text-align:center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#baca<?= $id ?>">
                                    <i class="fa-solid fa-magnifying-glass" title="baca">
                                    </i>
                                    //?
                                    <!--    <?php //if (in_groups("administrator")) : 
                                            ?>-->
                                    |<a href="/update/<?= $id; ?>">
                                        <i class="fa-solid fa-pencil" title="edit"></i>|
                                        <a href="/delete/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                                            <i class="fa-solid fa-trash-can" title="hapus"></i>|<a target="_blank" href="/laporan1/<?= $id; ?>">
                                                <i class="fa-solid fa-print" title="print cv"></i>

                                                <!--    <?php //endif; 
                                                        ?> -->
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
