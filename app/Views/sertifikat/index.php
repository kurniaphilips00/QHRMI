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
                            <a href="<?= route_to('sertifikat.tambah') ?>" class=btn btn-primary style="width:120px; background-color:#90e1f5; margin-right: 1em;">
                                <i class="fa-solid fa-circle-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <br>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('del')) :  ?>
                            <div class="alert alert-success" role="alert">
                                <?= session('del');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('gagal-update-sertifikat')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-update-sertifikat');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('sukses-update-srt')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-update-srt');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">Kode</th>
                                    <th style="text-align:center; width:20%">Tenaga Ahli</th>
                                    <th style="text-align:center; width:10%">Nomor Sertifikat</th>
                                    <th style="text-align:center; width:30%">Sertifikat</th>
                                    <th style="text-align:center; width:15%">Tgl. Kadaluarsa</th>
                                    <th style="text-align:center; width:15%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($sertifikat) {
                                    $no = 1;
                                    //protected $base;
                                    foreach ($sertifikat as $v) {
                                        $id = isset($v['id_sert']) ? $v['id_sert'] : '';
                                        $kode_sert = isset($v['kode_sert']) ? $v['kode_sert'] : '';
                                        $nomor_sert = isset($v['nomor_sert']) ? $v['nomor_sert'] : '';
                                        $sert = isset($v['sertifikat']) ? $v['sertifikat'] : '';
                                        $nama_ta = isset($v['nama_ta']) ? $v['nama_ta'] : '';
                                        $tgl_kadaluarsa = isset($v['tgl_kadaluarsa']) ? $v['tgl_kadaluarsa'] : '';
                                        if ($tgl_kadaluarsa != '0000-00-00' && $tgl_kadaluarsa != '') {
                                            $tgl = strtotime($tgl_kadaluarsa);
                                            $tanggal = date("d F Y", $tgl);
                                        }
                                        else {
                                            $tanggal = '';
                                        }
                                ?>
                                        <tr>
                                            <td style="width:5%"><?= $kode_sert ?></td>
                                            <td style="width:20%"><?= $nama_ta ?></td>
                                            <td style="width:10%"><?= $nomor_sert ?></td>
                                            <td style="width:30%"><?= $sert; ?></td>
                                            <td style="width:15%"><?= $tanggal; ?></td>
                                            <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                                            <td style="width:15%; text-align:center">
                                                <a href="sertifikat/baca/<?= $id; ?>">
                                                    <i class="fa-solid fa-magnifying-glass" title="baca"></i>
                                                    |<a href="/sertifikat/edit/<?= $id; ?>">
                                                        <i class="fa-solid fa-pencil" title="edit"></i>|
                                                        <a href="/sertifikat/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
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

<script>
    function cari_pengalaman() {
        // alert('Hail');
        const v = document.getElementById('names').value;
        if (v != '') {
            let names = document.getElementById('names');
            names.onclick = function(event) {
                var target = event.target;
                var nama = event.target.value;
                window.location.href = "/fNama/" + nama;
            };
        }
    }

    function ShowExperts($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/ExpertsList/" + $id
    }

    function IsiNama() {
        const sel = document.getElementById("ta_ID");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("Nama_Personil").value = teks;
    }

    function IsiID() {

        let ta = document.getElementById('ta_ID').value;
        const sel = document.getElementById("ta_ID");
        sel.options[sel.selectedIndex].text = ta;
    }
</script>


<?= $this->endsection(); ?>