<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mx-2">
                        <?php
                        helper("custom_helper"); // Single helper loading
                        ?>
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <!--  Menampilkan SEMUA tenaga ahli(memakai helper) -->
                                        <h3><?= countData('tb_ta') ?></h3>
                                        <p>Tenaga Ahli</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-stalker"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <!--  Menampilkan jumlah tenaga ahli psikologi (memakai helper) -->
                                        <h3><?= countData('tb_psikolog') ?></h3>
                                        <p>Psikolog</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <!--  Menampilkan jumlah tenaga ahli SDM (memakai helper) -->
                                        <h3><?= countData('tb_sdm') ?></h3>
                                        <p>SDM</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <!--  Menampilkan jumlah tenaga ahli selain psikologi dan SDM (memakai helper) -->
                                        <h3><?= countData('view_lain') ?></h3>
                                        <p>Lainnya</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'
                    ],
                    datasets: [{
                        label: 'Total Omset',
                        data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
</section>
<!-- /.content -->


<?= $this->endsection(); ?>

<?= $this->section('script') ?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>-->
<script src="<?= base_url('chartjs/Chart.bundle.min.js') ?>"></script>
<script>
    var prj = document.getElementById('myChart');
    var datanya = [];
    var label = [];
    <?php foreach ($proyek as $key => $value) : ?>
        datanya.push(<?= $value['nilai'] ?>);

    <?php endforeach ?>
    var set = {
        datasets: [{
            data: datanya,
            backgroundColor: [
                'rgba(255,99,132,0.8)',
                'rgba(54,162,235,0.8)',
                'rgba(255,206,86,0.8)',
            ],

        }]
    }
    var mychart = new Chart(prj, {
        type: 'doughnat',
        data: set
    });
</script>
<?= $this->endSection() ?>