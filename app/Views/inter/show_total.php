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
                        

                        <form action="<?= base_url("/inter/print_total")?>" method="GET">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><button type="submit" name="intmt" value="Intermitten diklik"
                                    style="width: 10; height: 20px; padding: 0px 0px 0px 0px; text-align: center; font-weight: bold;"
                                    class="tombol" title="Cetak intermitten"><i class="fa-solid fa-diagram-project"></i></button>
                                    </th>    
                                    
                                    <th style="text-align:center; width:50%">Nama</th>
                                    <th style="text-align:center; width:40%">Pengalaman(bln)</th>
                                   
                                    <th style="text-align:center; width:5%">CV</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($check) {
                                    $no = 1;
                                    foreach ($check as $v) {
                                        $pengalaman = $this->proyekTAModel->getIntermitten($v);
                                    //    $id = isset($v['id']) ? $v['id'] : '';
                                     //   $kode = isset($v['kode_ta']) ? $v['kode_ta'] : '';
                                        $nama = isset($v['nama']) ? $v['nama'] : '';
                                      //  helper('custom_helper'); // Loading single helper
                                        
                                        
                                ?>
                                        <tr>
                                         
                                            
                                            <td id="#name" style="width:50%"><?= $nama ?></td>
                                            <td style="width:40%;"><?= $tot ?></td>
                                           
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

    function position() {
        const v = document.getElementById('positions').value;
        if (v != '') {
            let pos = document.getElementById('positions');
            pos.onclick = function(event) {
                var target = event.target;
                var posisi = event.target.value;
                window.location.href = "/ta/posisi/" + posisi;
            };
        }
    }

    function pendidikan() {
        let ed = document.getElementById('EDU');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            window.location.href = "/sarjana/" + pendidikan;
        };
    }

    function pendidikanS2() {
        let ed = document.getElementById('EDUS2');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            //  alert(pendidikan);
            window.location.href = "/master/" + pendidikan;
        };
    }

    function doktor() {
        let ed = document.getElementById('EDUS3');
        ed.onclick = function(event) {
            let target = event.target;
            let pendidikan = event.target.innerHTML;
            //  alert(pendidikan);
            window.location.href = "/doktor/" + pendidikan;
        };
    }

    function filter_nama() {
        let name = document.getElementById('names');
        name.onclick = function(event) {
            var target = event.target;
            var nama = event.target.value;
            //  alert (nama);
            window.location.href = "/fNama/" + nama;
        };
    }
</script>

<?= $this->endsection(); ?>