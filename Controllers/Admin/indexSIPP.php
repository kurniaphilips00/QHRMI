
<?= $this->extend('admin/layout/template') ?>
<?= $this->Section('content') ?>
<!--
    https://stackoverflow.com/questions/71359871/how-to-solve-error-mysql-shutdown-unexpectedly-in-xamp
    Another reason for this error is corrupted database, to fix it simply restore your database backup which is created automatically by xampp.
    By default, your XAMPP MySQL backup files should be under Local Disk > XAMPP > MySQL. 
    Inside that directory, you’ll see several folders, two of which are called data and backup. 
    The data folder includes all of the files that your database uses. 
    The backup folder contains a single recent copy of your MySQL. 
    To restore the MySQL backup, change the name of the data folder to anything else, such as data-old. 
    Then rename the backup folder to data. That’s it!
-->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4">Daftar Tenaga Ahli PT. Quantum HRMI</h2>
                  
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" style = "background-color:#1b5c1a">
                                    <div class="card-body">Tenaga Ahli</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" style = "background-color:#649608">
                                    <div class="card-body">Pengalaman</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/pengalaman">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-black mb-4" style = "background-color:#b0fa05">
                                    <div class="card-body">Proyek</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/proyek">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Logout</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="http://localhost:8080/logout">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="card mb-4">          
                                <div>
                                <a href="/tambah-CV" class=btn btn-primary style = "width:100px; background-color:#b0fa05">
                                <i class="fas fa-plus-circle"></i>Tambah</a>     
                               
                                <a href="/filter-SIPP-kadaluarsa" class=btn btn-primary style = "width:80px; background-color:#b0fa05;" title="Filter SIPP kadaluarsa">
                                <i class="fa-solid fa-filter" ></i>SIPP</a>  
                            </div>
                        
                        <!--Notifikasi berhasil hapus data CV -->
                        <!--Kalau native : $_SESSION[]...., pasangannya di Dashboard.php fungsi delete($id) -->
                         <?php if (session('hapus')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('hapus');?>
                            </div>
                        <?php endif; ?>

                                <!--pasangannya di Dashboard.php fungsi simpan_update()-->
                                <?php if (session('update')) :  ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session('update');?>
                                    </div>
                                <?php endif; ?>
                                
                        
                            <div class="card-body">                                
                                <table id="datatablesSimple">
                                    <colgroup>
                                        <col span="1" style="width: 5%;">
                                        <col span="1" style="width: 20%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 10%;">
                                        <col span="1" style="width: 15%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                        <th scope="col" style = "width:5%; text-align:center">No.</th>
                                        <th scope="col" style = "width:20%; text-align:center">Nama</th>
                                        <th scope="col" style = "width:10%; text-align:center">SIPP</th>
                                        <th scope="col" style = "width:10%; text-align:center">SIPP ED</th> 
                                        <th scope="col" style = "width:10%; text-align:center">Expired(hari)</th>  
                                        <th scope="col" style = "width:10%; text-align:center">STR ED</th> 
                                        <th scope="col" style = "width:10%; text-align:center">Expired(hari)</th> 
                                        <th scope="col" style = "width:15%; text-align:center">Edit</th>                                  
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ( $cv as $v) : ?>
                                                <tr>
                                                <?php
                                                        //////////     SIPP ED    //////////////////////////////////////
                                                        if ($v['sipp_ed']=='0000-00-00') {
                                                            $ED_for_SIPP = "belum terdaftar";
                                                        }
                                                        if ($v['sipp_ed']!=null && $v['sipp_ed']!='0000-00-00') {
                                                            $tglED = new DateTime($v['sipp_ed']);
                                                            $skrg = date_create();
                                                                if ($skrg > $tglED) {
                                                                    //$ED_for_SIPP = date_diff($skrg, $tglED);
                                                                    $ED_for_SIPP = "kadaluarsa";
                                                                }
                                                                else {
                                                                    $ED_for_SIPP = date_diff($tglED, $skrg);
                                                                    if ($ED_for_SIPP->days <= 90) {
                                                                        $ED_for_SIPP = "< 90 hari";
                                                                    }
                                                                    else {
                                                                        $ED_for_SIPP = $ED_for_SIPP->days . ' hari lagi';
                                                                    }
                                                                }
                                                        } 
                                                        else {
                                                            $ED_for_SIPP = "belum terdaftar";
                                                        }
                                                        //////////    END OF SIPP ED    //////////////////////////////////////


                                                        //////////     STR ED    //////////////////////////////////////
                                                        if ($v['str_ed']=='0000-00-00') {
                                                            $ED_for_STR = "belum terdaftar";
                                                        }
                                                        if ($v['str_ed']!=null && $v['str_ed']!='0000-00-00') {
                                                            $tglED = new DateTime($v['str_ed']);
                                                            $skrg = date_create();
                                                            
                                                                if ($skrg > $tglED) {
                                                                    $ED_for_STR = "kadaluarsa";
                                                                }
                                                                else {
                                                                    $ED_for_STR = date_diff($tglED, $skrg);
                                                                    if ($ED_for_STR->days <= 90) {
                                                                        $ED_for_STR = "< 90 hari";
                                                                    }
                                                                    else {
                                                                        $ED_for_STR = $ED_for_STR->days . ' hari lagi';
                                                                    }
                                                                }
                                                        } 
                                                        else {
                                                            $ED_for_STR = "belum terdaftar";
                                                        }
                                                         //////////    END OF STR ED    //////////////////////////////////////
                                                    ?>
                                                    <tr>

                                                        <td style = "widht:5%"><?= $i; ?></td>
                                                        <td onclick="cetak(<?= $v['id']; ?>)" id="#name" style = "width:20%"><?= $v['nama']; ?></td>
                                                        <td style = "width:10%"><?= $v['sipp']; ?></td>
                                                        <td style = "width:10%"><?= $v['sipp_ed']; ?></td> 

                                                        <!--    JIKA SIPP KADALUARSA WARNA BACKGROUND MERAH  -->
                                                        <?php if ($ED_for_SIPP == "kadaluarsa") :  ?>
                                                            <td style = "width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $ED_for_SIPP ?></td>                                                             
                                                        <?php elseif ($ED_for_SIPP == "< 90 hari") : ?>     
                                                            <td style = "width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $ED_for_SIPP ?></td> 
                                                        <?php else : ?>
                                                        <!--    JIKA BELUM KADALUARSA WARNA BACKGROUND PUTIH  -->
                                                            <td style = "width:10%; text-align:center;"><?= $ED_for_SIPP ?></td>                                                       
                                                        <?php endif; ?>
                                                        
                                                        <td style = "width:10%"><?= $v['str_ed']; ?></td> 
                                                        
                                                         <!--    JIKA STR KADALUARSA WARNA BACKGROUND MERAH  -->
                                                         <?php if ($ED_for_STR == "kadaluarsa") :  ?>
                                                            <td style = "width:10%; text-align:center;background-color:red;color:white; font-weight:bold"><?= $ED_for_STR ?></td>    
                                                        <?php elseif ($ED_for_STR == "< 90 hari") : ?>     
                                                            <td style = "width:10%; text-align:center;background-color:#fcba03;color:black; font-weight:bold"><?= $ED_for_STRphp ?></td>                                                          
                                                        <?php else : ?>
                                                        <!--    JIKA BELUM KADALUARSA WARNA BACKGROUND PUTIH  -->
                                                            <td style = "width:10%; text-align:center;"><?= $ED_for_STR ?></td>                                                       
                                                        <?php endif; ?>

                                                        <td style = "width:15%; text-align:center"> 
                                                    <!--
                                                    <a href="/read/<?= $v['id'];?>">
                                                        <i class="fa-solid fa-magnifying-glass" title="detil">  
                                                        </i>|-->
                                                 
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#baca<?= $v['id']?>">
                                                        <i class="fa-solid fa-magnifying-glass" title="baca">  
                                                        </i>
                                                    <!--
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#baca<?= $v['id']?>" 
                                                    class="btn btn-sm btn-warning" id="#baca" title="baca">
                                                    <i class="fa-solid fa-magnifying-glass"></i></button>-->

                                                        <?php if (in_groups("administrator")) : ?>
                                                            |<a href="/update/<?= $v['id'];?>">
                                                            <i class="fa-solid fa-pencil" title="edit"></i>|
                                                            <a href="/delete/<?= $v['id'];?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                                                            <i class="fa-solid fa-trash-can" title="hapus"></i>|<a target = "_blank" href="/laporan1/<?= $v['id'];?>">
                                                            <i class="fa-solid fa-print" title="print cv"></i>
                                                            <!--
                                                            <a href="/laporan/<?= $v['id'];?>">
                                                            <i class="fa-solid fa-print" title="cetak pdf"></i>|-->
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

 <!-- Modal Baca-->
 <?php $i = 1; ?>
    <?php foreach ( $cv as $v) : ?>
        <div class="modal fade" id="baca<?= $v['id']?>" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detil CV Tenaga Ahli (<?= $v['nama'] ?>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
                    <form action="<?= route_to('baca-CV', $v['id']) ?>" method="get">
                        
                        <div class="m-1 row">
                            <label for="perusahaan" class="col-sm-4 col-form-label">Nama perusahaan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="perusahaan" value="<?=$v['perusahaan']; ?>">
                            </div>
                        </div>
                        <div class="m-1 row">
                            <label for="posisi" class="col-sm-4 col-form-label">Posisi</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="posisi" value="<?=$v['posisi']; ?>">
                            </div>
                        </div>
                        <div class="m-1 row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama personil</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="nama" value="<?=$v['nama']; ?>">
                            </div>
                        </div>
                        <div class="m-1 row">
                            <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="kategori" value="<?=$v['kategori']; ?>">
                            </div>
                        </div>
                        <div class="m-1 row">
                            <label for="ttl" class="col-sm-4 col-form-label">Tempat/Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="ttl" value="<?=$v['ttl']; ?>">
                            </div>                            
                        </div>
                        <div class="m-1 row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="alamat" value="<?=$v['alamat']; ?>">
                            </div>                            
                        </div>
                        <div class="m-1 row">
                            <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="kota" value="<?=$v['kota']; ?>">
                            </div>                            
                        </div>

                        <div class="m-1 row">
                            <label for="no_ktp" class="col-sm-4 col-form-label">KTP</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="no_ktp" value="<?=$v['no_ktp']; ?>">
                            </div>                            
                        </div>

                        <div class="m-1 row">
                            <label for="no_npwp" class="col-sm-4 col-form-label">NPWP</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="no_npwp" value="<?=$v['no_npwp']; ?>">
                            </div>                            
                        </div>

                        <div class="m-1 row">
                            <label for="no_telp" class="col-sm-4 col-form-label">Telp</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="no_telp" value="<?=$v['no_telp']; ?>">
                            </div>                            
                        </div>

                        <div class="m-1 row">
                            <label for="no_hp" class="col-sm-4 col-form-label">HP</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="no_hp" value="<?=$v['no_hp']; ?>">
                            </div>                            
                        </div>

                        <div class="m-1 row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="email" value="<?=$v['email']; ?>">
                            </div>                            
                        </div>

                        <label>Pendidikan</label><br><br>
                        <b>S1</b><br>
                        <div class="m-0 row">
                            <label for="ijazahS1" class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="ttl" value="<?=$v['ijazahS1']; ?>">
                            </div>                            
                        </div>

                        <div class="m-0 row">
                            <label for="s1_univ" class="col-sm-4 col-form-label">Universitas</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s1_univ" value="<?=$v['s1_univ']; ?>">
                            </div>                            
                        </div>

                        <div class="m-0 row">
                            <label for="s1_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s1_thn" value="<?=$v['s1_thn']; ?>">
                            </div>                            
                        </div>

                        <br><b>S2</b><br>
                        <div class="m-0 row">
                            <label for="ijazahS2" class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="ijazahS2" value="<?=$v['ijazahS2']; ?>">
                            </div>                            
                        </div>

                        <div class="m-0 row">
                            <label for="s2_univ" class="col-sm-4 col-form-label">Universitas</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s2_univ" value="<?=$v['s2_univ']; ?>">
                            </div>                            
                        </div>

                        <div class="m-0 row">
                            <label for="s2_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s2_thn" value="<?=$v['s2_thn']; ?>">
                            </div>                            
                        </div>

                        <br><b>S3</b><br>
                        <div class="m-0 row">
                            <label for="ijazahS3" class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="ijazahS3" value="<?=$v['ijazahS3']; ?>">
                            </div>                            
                        </div>

                        <div class="m-0 row">
                            <label for="s3_univ" class="col-sm-4 col-form-label">Universitas</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s3_univ" value="<?=$v['s3_univ']; ?>">
                            </div>                            
                        </div>
                        <div class="m-0 row">
                            <label for="s3_thn" class="col-sm-4 col-form-label">Tahun lulus</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="s3_thn" value="<?=$v['s3_thn']; ?>">
                            </div>                            
                        </div>
 
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="sipp">SIPP</span>
                            <input type="text" readonly class="form-control" name="sipp" value="<?=$v['sipp']; ?>"/>
                            <span class="input-group-text" id="sipp_ed">SIPP ED</span>
                            <input type = "text" readonly class="form-control" name="sipp_ed" value="<?=$v['sipp_ed']; ?>"/>
                        </div>

                        <div class="input-group mb-1">
                            <span class="input-group-text" id="str">STR</span>
                            <input type="text" readonly class="form-control" name="str" value="<?=$v['str']; ?>"/>
                            <span class="input-group-text" id="str_ed">STR ED</span>
                            <input type = "text" readonly class="form-control" name = "str_ed" value="<?=$v['str_ed']; ?>"/>
                        </div>

                        <div class="input-group mb-1">
                            <span class="input-group-text" id="kta">KTA</span>
                            <input type="text" readonly class="form-control" name="kta" value="<?=$v['kta']; ?>">
                            <span class="input-group-text" id="kta_ed">KTA ED</span>
                            <input type = "text" readonly class="form-control" name = "kta_ed" value="<?=$v['kta_ed']; ?>"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:100px;height: 43px;"><i class="fa-solid fa-circle-xmark"></i>Tutup</button>    
                            <a href="/laporan/<?= $v['id'];?>" target="_blank" class="btn btn-success p-2"><i class="fa-solid fa-file-pdf"></i></i> Cetak PDF</a>                  
                        </div>
                        
                       
                    </form>     
                </div>
            </div>
        </div>
        </div>
    <?php $i++; ?>
<?php endforeach; ?>
<!-- End Modal Baca-->    

<script>
    function cetak($id) {
        let nama = document.getElementById('#name').innerText;
        window.location.href = "/laporan1/" + $id
    }
</script>
<?= $this->endSection(); ?>
 