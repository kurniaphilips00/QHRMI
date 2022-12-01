<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pengalaman Tenaga Ahli</h1>
                
                        <div class="card mb-4">
                                <div class="mb-3 row">
                                    <a href="/tambah-pengalaman" class="btn btn-warning m-2" style="height: 40px; width: 110px">
                                    <i class="fa-solid fa-circle-plus"></i> Tambah</a>
                                    <div class="col-sm-5 px-5 mx-5">
                                        <select class="form-select" name="nama" id="names" onchange="filter_nama()">
                                            <?php foreach ($rh as $val) : ?>
                                                <option value="<?= $val['nama']?>"><?= $val['nama']?></option>                                                
                                            <?php endforeach; ?>                                 
                                        </select>
                                    </div>
                                </div>
                           <!--Notifikasi sukses tambah data pengalaman -->             
                                        <!--pasangannya di ExpController.php fungsi simpan_exp()-->
                                        <?php if (session('sukses-tambah-pengalaman')) :  ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= session('sukses-tambah-pengalaman');?>
                                            </div>
                                        <?php endif; ?>
                            <!--Notifikasi sukses tambah data pengalaman -->
                            
                            <!--Notifikasi  sukses-update-pengalaman  -->             
                                        <!--pasangannya di ExpController.php fungsi edit_exp()-->
                                        <?php if (session('sukses-update-pengalaman')) :  ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= session('sukses-update-pengalaman');?>
                                            </div>
                                        <?php endif; ?>
                            <!--Notifikasi sukses-update-pengalaman  -->

                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <colgroup>
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 30%;">
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 5%;">
                                            <col span="1" style="width: 15%;">                    
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th scope="col" style = "width:5%; text-align:center">No.</th>
                                                <th scope="col" style = "width:20%; text-align:center">Tenaga Ahli</th>  
                                                <th scope="col" style = "width:10%; text-align:center">Jabatan</th>  
                                                <th scope="col" style = "width:30%; text-align:center">Kegiatan</th>
                                                <th scope="col" style = "width:5%; text-align:center">Thn</th>    
                                                <th scope="col" style = "width:5%; text-align:center">Intermitten</th>        
                                                <th scope="col" style = "width:5%; text-align:center">Jml (bln)</th>       
                                                <th scope="col" style = "width:15%; text-align:center;">Edit</th>                                
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                                <?php $i = 1; $thn = 0; ?>
                                                <?php foreach ( $exp as $v) : ?>
                                                    <tr>
                                                        <td style = "widht:5%; text-align:center"><?= $i; ?></td>
                                                        <td onclick="cetakIntermitten(<?= $v['kode_ta'] ?>)" id = "intermitten" style = "width:20%;"><?= $v['nama_ta']; ?></td>  
                                                        <td style = "width:10%;"><?= $v['posisitugas']; ?></td> 
                                                        <td style = "width:30%;"><?= $v['kegiatan']; ?></td>   
                                                        <td style = "width:5%;"><?= $v['tahun']; ?></td>   
                                                        <td style = "width:5%;"><?= $v['inter']; ?></td>   
                                                        <td style = "width:5%;"><?= $v['jml_bln']; ?></td>                                                    
                                                        <td style = "width:15%; text-align:center;  font-size: 5px;">     

                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v['id_exp'];?>" 
                                                            class="btn btn-sm btn-warning" id="#baca" title="baca">
                                                            <i class="fa-solid fa-magnifying-glass"></i></button>|<button type="button" class="btn btn-sm btn-warning" title="update">
                                                            <a href="/edit-pengalaman/<?= $v['id_exp'];?>">
                                                            <i class="fa-solid fa-pencil"></i></button>|<button type="button" 
                                                            class="btn btn-sm btn-warning" title="hapus">
                                                            <a href="/delete-pengalaman/<?= $v['id_exp'];?>" onclick="return confirm('Yakin ingin menghapus')">
                                                            <i class="fa-solid fa-trash-can"></i></button></i>

                                                        </td>
                                                         <?php  $thn += $v['jml_bln']; ?>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div><!--"card-body"-->
                                <div class="card-footer" style = "text-align: right">
                                    Total pengalaman  
                                    <?= 
                                        $thn; 
                                        $JmlThn = floor($thn / 12);
                                        $sisabln = $thn % 12;
                                    ?> bulan = <?= $JmlThn ?> tahun <?= $sisabln ?> bulan
                                </div>
                        </div>
                    </div>
                </main>
<script>
    function cetakIntermitten($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/laporanIntermitten/" + $id
    }
</script>  
<script>
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

 <!-- Modal Baca-->
 <?php foreach ( $exp as $v) : ?>
    <div class="modal fade" id="baca<?= $v['id_exp']; ?>" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detil Pengalaman Tenaga Ahli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">           
                <form action="<?= base_url('#') ?>" method="post">

                        <div class="mb-1 row">
                            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="tahun" value="<?= $v['tahun'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Tenaga Ahli</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="nama" value="<?= $v['nama_ta'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="kegiatan" value="<?= $v['kegiatan'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Kegiatan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="lokasi" value="<?= $v['lokasi'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="pengguna" class="col-sm-3 col-form-label">Pengguna Jasa</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="pengguna" value="<?= $v['pengguna'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="pers" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="pers" value="<?= $v['pers'];?>">
                            </div>
                        </div>
                    
                        <div class = "mb-1 row">
                            <label for="uraian" class="col-sm-3 col-form-label">Uraian Tugas</label>
                            <div class = "col-sm-8">
                                <textarea name="uraian" readonly cols="100" rows="6" ALIGN=LEFT
                                    style="width: 700px;
                                    height: 100px; 
                                    text-align: left;
                                    padding-left:0;
                                    padding-top:0;
                                    padding-bottom:0.4em;
                                    padding-right: 0.4em;
                                    vertical-align: top"
                                    ><?= $v['uraian'];?>
                                    
                                </textarea>                                       
                            </div>
                        </div>
                        <?php
                                $mulai=isset($v['mulai']) ? $v['mulai'] : '';
                                $selesai=isset($v['selesai']) ? $v['selesai'] : '';
                                if ($mulai != null && $mulai != '0000-00-00') {
                                    $tgl = new DateTime($mulai);
                                    $tgl_mulai = $tgl->format('d-m-Y'); //  Menampilkan format Indo
                                }
                                else {
                                    $tgl_mulai = '00';
                                }    
                                if ($selesai !=null &&  $selesai != '0000-00-00') {
                                    $tgl = new DateTime($selesai);
                                    $tgl_selesai = $tgl->format('d-m-Y'); //  Menampilkan format Indo
                                    // dd($tgl_selesai);
                                }
                                else {
                                    $tgl_selesai = '00';
                                }    
                        ?>
                        <div class="mb-1 row">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Waktu Pelaksanaan</label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control-plaintext" value="<?= $tgl_mulai;?>">
                                </div>
                                <label class="col-sm-1 col-form-label">s/d</label>
                                <div class="col-sm-2">
                                    <input type="text" readonly class="form-control-plaintext" value="<?= $tgl_selesai;?>">
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label">Intermitten</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $v['inter'];?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Jumlah bulan</label>
                            <div class="col-sm-2">
                                <input type="text" readonly class="form-control-plaintext" value="<?= $v['jml_bln'];?>">
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="posisi" class="col-sm-3 col-form-label">Posisi Penugasan (Jabatan)</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="posisi" value="<?= $v['posisitugas'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="status" class="col-sm-3 col-form-label">Status Kepegawaian pada Perusahaan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="status" value="<?= $v['statuse'];?>">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="referensi" class="col-sm-3 col-form-label">Surat Referensi</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="referensi" value="<?= $v['referensi'];?>">
                            </div>
                        </div>              
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>                                        
                        </div>
                    </div>
                            
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal Baca--> 


<?= $this->endSection(); ?>