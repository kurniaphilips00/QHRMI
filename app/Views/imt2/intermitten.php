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
                    <form action="">
                        <table id="tabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th style="text-align:center; width:10%">Kode</th>
                                    <th style="text-align:center; width:30%">Nama</th>
                                    <th style="text-align:center; width:30%">Pekerjaan</th>
                                    <th style="text-align:center; width:10%">Tahun</th>
                                    <th style="text-align:center; width:10%">Intermitten(Bln)</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengalaman) {

                                    $tot = 0;
                                    $indeks = 0;
                                    foreach ($pengalaman as $v) {   // Looping luar
                                ?>
                                        <tr>
                                            <td style="width:10%"><?= $v[$indeks]['kode_TA'] ?></td>
                                            <td style="width:30%"><?= $v[$indeks]['nama'] ?></td>
                                            <td style="width:30%"></td>
                                            <td style="width:10%"></td>
                                            <td style="width:10%"></td>
                                       
                                            <?php

                                            // Looping dalam
                                            foreach ($v as $val) { 

                                            ?>
                                        <tr>
                                            <td style="width:10%;"></td>
                                            <td style="width:30%;"></td>
                                            <td style="width:30%;"><?= $val['pekerjaan'] ?></td>
                                            <td style="width:10%; text-align:center"><?= $val['tahun'] ?></td>
                                            <td style="width:10%; text-align:center"><?= $val['jml_bln'] ?></td>
                                            <td style="width:10%;"></td>
                                        </tr>
                                    <?php
                                                $tot += $val['jml_bln'];
                                            }

                                            $TotThn = floor($tot / 12);
                                            if ($TotThn > 0) {
                                                $sisabln = $tot % 12;
                                            }
                                            else {
                                                $sisabln = $tot;
                                            }
                                    ?>
                                   
                                    <tr>
                                        <td style="width:10%;"></td>
                                        <td style="width:30%;"></td>
                                        <td style="width:30%;"></td>
                                        <td style="width:30%"; text-align:left; 
                                        colspan="3">Total = <?= $tot ?> bulan = <?= $TotThn ?> tahun,<?= $sisabln ?> bulan</td>
                                        
                                    </tr>

                                <?php
                                        $tot = 0;
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
<?= $this->endsection(); ?>