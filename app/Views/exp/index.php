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
                            <a href="/pengalaman/tambah" class=btn btn-primary style="width:90px; background-color:#037bfc; margin-right: 5px;color:white"
                            title="Menambah data pengalaman">
                                <i class="fa-solid fa-circle-plus"></i> Tambah</a>
                            <a href="/pengalaman/tambahTA" class=btn btn-primary style="width:120px; background-color:#90e1f5; margin-right: 1em;"
                            title="Menambah tenaga ahli untuk satu pengalaman">
                                <i class="fa-solid fa-circle-plus"></i> Tambah TA</a>

                                <?php $judul = "Pastikan file Excel berisi field-field dengan urutan :
                                  'id'         //      kolom A
                                  'instansi'   //      kolom B
                                  'pekerjaan'  //      kolom C
                                  'tahun'      //      kolom D
                                  'lokasi'     //      kolom E
                                  'alamat'     //      kolom F
                                  'nokontrak'  //      kolom G
                                  'mulai'      //      kolom H
                                  'selesai'    //      kolom I
                                  'nilai'      //      kolom J
                                  'referensi'  //      kolom K
                                  'jml_bln'    //      kolom L
                                  'inter'      //      kolom M
                                  'refpdf'     //      kolom N" ?>
                                    
                            <form action="/pengalaman/importExcel" method="post" enctype="multipart/form-data" style="display: inline;">
                                    <div class="btn-group" role="group" >
                                        <label for="files" class="btn">Pilih file excel</label>
                                        <input id="files"  type="file" accept=".xls, .xlsx, .ods" name='excel'>
                                    </div>
                                    <button title="<?= $judul ?>" 
                                    onclick="return confirm('Tabel pengalaman akan dikosongkan, yakin ingin impor ?')"
                                    type="submit" 
                                    class="btn btn-primary" style="width:90px;height: 30px; background-color:#90e1f5; color:black">
                                            <i class="fa-sharp fa-solid fa-upload"></i>Import</button>
                                    
                                            <a href="/pengalaman/exportExcel" class="btn btn-primary" 
                                    style="width:80px; height:30px; background-color:#90e1f5; margin-right: 20px; color:black" 
                                    title="Export to Excel">Export<i class="fa-solid fa-file-arrow-down"></i></a>
                            </form>
                            <a href="/pengalaman/cetakpdf" style="width:40px; font-size: 30px; color:black; padding-top:0; 
                            padding-bottom:0; background-color:none" 
                            title="Export to pdf"><i class="fa-solid fa-file-pdf"></i></a>
                            
                        </div>
                        <br>
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
                     
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                   <th style="text-align:center; width:5%">Kode</th>
                                 
                                    <th style="text-align:center; width:25%">Instansi</th>
                                    <th style="text-align:center; width:25%">Pekerjaan</th>
                                    <th style="text-align:center; width:10%">Mulai</th>
                                    <th style="text-align:center; width:10%">Selesai</th>
                                    <th style="text-align:center; width:5%">Tahun</th>
                                    <th style="text-align:center; width:5%">Intermitten</th>
                                    <th style="text-align:center; width:15%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($exp) {
                                    $no = 1;
                                    foreach ($exp as $v) {

                                        $id = isset($v['id']) ? $v['id'] : '';
                                        $kode = isset($v['kode_proyek']) ? $v['kode_proyek'] : '';
                                       
                                        $tahun = isset($v['tahun']) ? $v['tahun'] : '';
                                        $instansi = isset($v['instansi']) ? $v['instansi'] : '';
                                        $pekerjaan = isset($v['pekerjaan']) ? $v['pekerjaan'] : '';
                                       
                                        $inter = isset($v['inter']) ? $v['inter'] : '';

                                        $mulai = isset($v['mulai']) ? $v['mulai'] : '';
                                        //dd($mulai);
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
                                            <td style="width:5%"><?= $kode; ?></td>
                                        
                                            <td style="width:25%"><?= $instansi ?></td>
                                            <td style="width:25%"><?= $pekerjaan ?></td>
                                            <td style="width:10%"><?=$tgl_mulai?></td>
                                            <td style="width:10%"><?=$tgl_selesai?></td>
                                            <td style="width:5%"><?=$tahun?></td>
                                            <td style="width:5%"><?=$inter?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:15%; text-align:center">
                                                <a href="/pengalaman/baca/<?= $id; ?>">
                                                <i class="fa-solid fa-glasses"  title="baca"></i>
                                                    |
                                                    <a href="/pengalaman/edit/<?= $id; ?>">
                                                        <i class="fa-solid fa-pencil" title="edit"></i>
                                                        |
                                                        <a href="/pengalaman/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus pengalaman')">
                                                            <i class="fa-solid fa-trash-can" title="hapus"></i>
                                            </td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->

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
    function start() { //    Mengatur tampilan format tanggal mulai

        const tgl = new Date(document.getElementById('awal01').value);
        let thn = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        alert(bulan);
        let tanggal = tgl.getDate();
        //   alert(tanggal);
        let formattedTMySQL = thn + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN

        document.getElementById('awal00').value = formattedTMySQL; //  Menampilkan tanggal lahir dengan format MySQL

    }

    function hitungintermitten() {

        let awal = document.getElementById('tgl_awal').value;
        if (awal != "") {
            const tglawal = new Date(document.getElementById('tgl_awal').value);
            const tglakhir = new Date(document.getElementById('tgl_akhir').value);
            let time_difference = tglakhir.getTime() - tglawal.getTime();
            let Years_difference = 0;
            let SisaBulan = 0;
            let SisaHari = 0;
            var inter = "( ";
            //calculate days difference by dividing total milliseconds in a day  
            let days_difference = time_difference / (1000 * 60 * 60 * 24);
            let Months_difference = Math.floor(days_difference / 30);
            console.log(Months_difference.toString());
            if (Months_difference > 12) {
                Years_difference = Math.floor(Months_difference / 12);
                SisaBulan = Months_difference % 12;
                SisaHari = days_difference - ((Years_difference * 360) + (SisaBulan * 30));
                inter += Years_difference + " tahun ";
                inter += SisaBulan + " bulan ";
                inter += SisaHari + " hari ";
            } else if (Months_difference > 0) {
                SisaHari = days_difference % 30;
                inter += Months_difference + " bulan ";
                inter += SisaHari + " hari ";
            } else {
                inter += days_difference + " hari ";
            }
            inter += " )";
            let tahuntglakhir = tglakhir.getFullYear();
            let bulantglakhir = tglakhir.getMonth() + 1; // Months start at 0
            let haritglakhir = tglakhir.getDate();
            let tglSelesai = tahuntglakhir + '-' + bulantglakhir + '-' + haritglakhir;
            document.getElementById('ak').value = tglSelesai;
            document.getElementById('intermitten').value = inter;
            document.getElementById('jmlbln').value = Months_difference;

        }

    }

    function cari_pengalaman() {
        // alert('Hai');
        const v = document.getElementById('names').value;
        if (v != '') {
            let names = document.getElementById('names');
            names.onclick = function(event) {
                var target = event.target;
                var nama = event.target.value;
                //  alert(nama);
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