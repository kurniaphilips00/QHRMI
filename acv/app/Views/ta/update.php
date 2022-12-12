
<?= $this->extend('layout/template'); ?>
<?= $this->Section('isi'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="row px-4">
                            <div class="col-12"><br><br>
                                <h2>Form Edit Data Riwayat Hidup Tenaga Ahli</h2>
                                        <!--pasangannya di Dashboard.php fungsi simpan()-->
                                        <?php if (session('update-failed')) :  ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session('update-failed');?>
                                            </div>
                                        <?php endif; ?>

                                     
                                        <!--Notifikasi gagal update data CV -->
                                <form action="<?= route_to('simdat', $result['id']) ?>"  method="post" enctype="multipart/form-data">
                                    <?= csrf_field();?>
                                    <input type="hidden" name="_method" value="PUT">
                                    
                                    <input type="hidden" name="gbrFotoLama" value="<?= isset($result['pasfoto']) ? $result['pasfoto'] : '';?>">
                                    <input type="hidden" name="gbrKTPLama" value="<?= isset($result['fktp']) ? $result['fktp'] : '';?>">
                                    <input type="hidden" name="gbrNPWPLama" value="<?= isset($result['fnpwp']) ? $result['fnpwp'] : '';?>">
                                    <input type="hidden" name="gbrSIPPLama" value="<?= isset($result['fsipp']) ? $result['fsipp'] : '';?>">
                                    <input type="hidden" name="gbrSTRLama" value="<?= isset($result['fstr']) ? $result['fstr'] : '';?>">
                                    <input type="hidden" name="gbrKTALama" value="<?= isset($result['fkta']) ? $result['fkta'] : '';?>">
                                    <input type="hidden" name="pdfREFLama" value="<?= isset($result['ref']) ? $result['ref'] : '';?>">
                                    
                                    <!--Posisi Penugasan dipakai untuk mengisi Posisi yang diusulkan-->
                                    <div class = "mb-1 row">
                                            <label for="posisinya" class="col-sm-2 col-form-label">Posisi yang diusulkan</label>
                                            <input type="text" class="col-sm-4" name="posisinya" id="posisinya" readonly value="<?= $result['posisi'] ?>">  
                                            <div class = "col-sm-4">
                                                <select class="form-control" name="posisi" id="pos" onchange="positions()">
                                                    <?php foreach ($posisi as $val) : ?> 
                                                                
                                                        <option value="<?= $val->posisi?>">
                                                            <?= $val->posisi?>
                                                        </option>                                                
                                                    <?php endforeach; ?>                                 
                                                </select>
                                                <?php if ($validation->hasError('posisi')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('posisi') ?>
                                                    </div>  
                                                <?php endif; ?> 
                                            </div>
                                    </div>
                                 <!--
                                    <div class = "mb-1 row">
                                        <label for="posisi" class="col-sm-4 col-form-label">Posisi</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control <?= $validation->hasError('posisi') ? 'is-invalid' : null ?>" 
                                            name="posisi" value="<?= old('posisi') ?>" placeholder="Posisi">       
                                            <?php if ($validation->hasError('posisi')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('posisi') ?>
                                                </div>  
                                            <?php endif; ?>                                  
                                        </div>
                                    </div>  -->

                                    <div class = "mb-1 row">
                                        <label for="perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control <?= 
                                            $validation->hasError('perusahaan') ? 'is-invalid' : null ?>" name="perusahaan" value="<?= old('perusahaan', $result['perusahaan']) ?>">
                                            <?php if ($validation->hasError('perusahaan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('perusahaan') ?>
                                                </div>  
                                            <?php endif; ?>      
                                        </div>
                                    </div>

                                     <div class = "mb-1 row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama Personil</label>
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control <?= 
                                            $validation->hasError('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= old('nama', $result['nama']) ?>">
                                             <?php if ($validation->hasError('nama')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama') ?>
                                                </div>    
                                            <?php endif; ?>  
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control <?= 
                                            $validation->hasError('kategori') ? 'is-invalid' : '' ?>" name="kategori" value="<?= old('kategori', $result['kategori']) ?>">
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                <?= $validation->getError('kategori') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="alamat" value="<?= old('alamat', $result['alamat']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="kota" value="<?= old('kota', $result['kota']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <?php
                                            if ($result['tgl'] != '0000-00-00' && $result['tgl'] != null) {
                                                $tgl = new DateTime($result['tgl']);
                                                $tgl_lahir = $tgl->format('d-m-Y'); //  Menampilkan format Indo
                                                $sekarang = new DateTime();
                                                $diff = $sekarang->diff($tgl);
                                            }
                                            else {
                                                $tgl_lahir = "";
                                            }    
                                            
                                        ?>
                                        <label for="tgl" class="col-sm-2 col-form-label">Tgl.lahir</label>
                                        <div class = "col-sm-2">
                                            <input type = "text"  class="form-control" name="tgl" value="<?= $tgl_lahir ?>" id="old_tgl_lahir"/> 
                                        </div>
                                        <div class = "col-sm-2">
                                            <input type = "date"  class="form-control" name="new_ttl" id="new_tgl_lahir" onchange="tampil()"/>                                      
                                        </div>
                                        <label for="usia" class="col-sm-1 col-form-label">Usia</label>
                                        <div class = "col-sm-2">
                                            <input type="text" readonly class="form-control" name="usia" value="<?= $result['usia'] ?>" id="umur">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="no_ktp" class="col-sm-2 col-form-label">KTP</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="no_ktp" value="<?= old('no_ktp', $result['no_ktp']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="no_npwp" class="col-sm-2 col-form-label">NPWP</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="no_npwp" value="<?= old('no_npwp', $result['no_npwp']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="no_telp" class="col-sm-2 col-form-label">Telp.</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="no_telp" value="<?= old('no_telp', $result['no_telp']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="no_hp" class="col-sm-2 col-form-label">HP</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="no_hp" value="<?= old('no_hp', $result['no_hp']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="email" value="<?= old('email', $result['email']) ?>">                                         
                                        </div>
                                    </div>
                                    <label class = "col-sm-2 col-form-label" style="width: 120px;">Pendidikan</label>
                                    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px;">S1</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS1" id="ijasahS1" value="<?= old('ijazahS1', $result['ijazahS1']) ?>">                              
                                        </div>

                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusan" id="jurS1" onchange="jurusanS1()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        <label class = "col-sm-2 col-form-label" style="width: 100px;">Universitas</label>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control" name="s1_univ" value="<?= old('s1_univ', $result['s1_univ']) ?>">                                         
                                        </div>

                                        <label class = "col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                        <div class = "col-sm-2">
                                            <input type="text" class="form-control" name="s1_thn" value="<?= old('s1_thn', $result['s1_thn']) ?>">                                         
                                        </div>
                                    </div>
                                    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px;">S2</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS2" id="ijasahS2" value="<?= old('ijazahS2', $result['ijazahS2']) ?>">                              
                                        </div>
                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusanS2" id="jurS2" onchange="jurusanStrata2()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        <label class = "col-sm-2 col-form-label" style="width: 100px;">Universitas</label>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control" name="s2_univ" value="<?= old('s2_univ', $result['s2_univ']) ?>">                                         
                                        </div>
                                        <label class = "col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                        <div class = "col-sm-2">
                                            <input type="text" class="form-control" name="s2_thn" value="<?= old('s2_thn', $result['s2_thn']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px;">S3</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS3" id="ijasahS3" value="<?= old('ijazahS3', $result['ijazahS3']) ?>">                              
                                        </div>
                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusanS3" id="jurS3" onchange="jurusanStrata3()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        <label class = "col-sm-2 col-form-label" style="width: 100px;">Universitas</label>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control" name="s3_univ" value="<?= old('s3_univ', $result['s3_univ']) ?>">                                         
                                        </div>

                                        <label class = "col-sm-1 col-form-label" style="width: 150px;">Tahun lulus</label>
                                        <div class = "col-sm-2">
                                            <input type="text" class="form-control" name="s3_thn" value="<?= old('s3_thn', $result['s3_thn']) ?>">                                         
                                        </div>
                                    </div>
     
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="sipp">Nomor SIPP</span>
                                        <input type="text" class="form-control" name="sipp" value="<?= old('sipp', $result['sipp']) ?>"/>
                                        <span class="input-group-text" id="sipp_ed">Tgl. kadaluarsa SIPP</span>
                                        <input type = "date"  class="form-control" name="sipp_ed" value="<?= old('sipp_ed', $result['sipp_ed']) ?>"/>
                                        <span class="input-group-text" id="str">Nomor STR</span>
                                        <input type="text" class="form-control" name="str" value="<?= old('str', $result['str']) ?>"/>
                                        <span class="input-group-text" id="str_ed">Tgl. kadaluarsa STR</span>
                                        <input type = "date" class="form-control" name = "str_ed" value="<?= old('str_ed', $result['str_ed']) ?>"/>
                                          
                                    </div>

                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="kta">Nomor KTA</span>
                                        <input type="text" class="form-control" name="kta" value="<?= old('kta', $result['kta']) ?>"/>
                                        <span class="input-group-text" id="kta_ed">Tgl. kadaluarsa nomor KTA</span>
                                        <input type = "date"  class="form-control" name = "kta_ed" value="<?= old('kta_ed', $result['kta_ed']) ?>"/>
                                        <select class="form-select form-select-sm-3" name = "asosiasi">
                                            <option selected>Asosiasi</option>
                                            <option value="Asosiasi Psikologi Industri dan Organisasi (APIO)">Asosiasi Psikologi Industri dan Organisasi (APIO)</option>
                                            <option value="Himpunan Psikologi Indonesia (HIMPSI)">Himpunan Psikologi Indonesia (HIMPSI)</option>
                                            <option value="Asosiasi Psikologi Forensik(APSIFOR)">Asosiasi Psikologi Forensik(APSIFOR)</option>
                                            <option value="Ikatan Psikolog Klinis(IPK)">Ikatan Psikolog Klinis(IPK)</option>
                                            <option value="IIkatan Psikologi Pendidikan Indonesia(IPPI)">Ikatan Psikologi Pendidikan Indonesia(IPPI)</option>
                                        </select>
                                    </div>
                              
                                    <div class="input-group mb-1">
                                        <span class="input-group-text col-sm-4" id="status">Status kepegawaian pada perusahaan ini </span>
                                        <input type="text" class="form-control col-sm-4" name="status" placeholder="Status kepegawaian">
                                    </div>

                                    <div class="mb-3">
                                            <?php 
                                                  $pasfoto=isset($result['pasfoto']) ? $result['pasfoto'] : '';
                                                  $fktp=isset($result['fktp']) ? $result['fktp'] : '';
                                                  $fnpwp=isset($result['fnpwp']) ? $result['fnpwp'] : '';
                                                  $fsipp=isset($result['fsipp']) ? $result['fsipp'] : '';
                                                  $fstr=isset($result['fstr']) ? $result['fstr'] : '';
                                                  $fkta=isset($result['fkta']) ? $result['fkta'] : '';
                                                  $ref=isset($result['ref']) ? $result['ref'] : '';
                                            ?>

                                        <label for="pasfoto" style = "width:200px" >Pas Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control <?= $validation->hasError('pasfoto') ? 'is-invalid' : null ?>" name="pasfoto" id="pasfoto" onchange="return previewPasFoto(this);">
                                            <?php if ($validation->hasError('pasfoto')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pasfoto') ?>
                                                </div>    
                                            <?php endif; ?>                            
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$pasfoto)?>" alt="" class="prevPasFoto" width=100px>
                                  
                                        <br><br>

                                        <label for="ktp" tyle = "width:200px" >KTP</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control" name="ktp" id="ktp" onchange="return previewKTP(this);">
                                                                      
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$fktp)?>" alt="" class="prevKTP" width = "100px">

                                        <br><br>
                                        
                                        <label for="npwp" style = "width:200px">NPWP</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control" name="npwp" id="npwp" onchange="return previewNPWP(this);">
                                                                      
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$fnpwp)?>" alt="" class="prevNPWP" width = "100px">

                                        <br><br>
                                        
                                        <label for="gbrSIPP" style = "width:200px">SIPP</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control" name="gbrSIPP" id="gbrSIPP" onchange="return previewSIPP(this);">
                                                                      
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$fsipp)?>" alt="" class="prevSIPP" width = "100px">

                                        <br><br>            
                                        
                                        <label for="gbrSTR" style = "width:200px" >STR</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control" name="gbrSTR" id="gbrSTR" onchange="return previewSTR(this);">
                                                                         
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$fstr)?>" alt="" class="prevSTR" width = "100px">

                                        <br><br>  

                                        <label for="gbrKTA" tyle = "width:200px" >KTA</label>
                                        <div class="col-sm-10">
                                            <input type="file"  style="display:none" class="form-control" name="gbrKTA" id="gbrKTA" onchange="return previewKTA(this);">
                                                                    
                                        </div><br>
                                        <img src="<?= base_url('/img/'.$fkta)?>" alt="" class="prevKTA" width = "100px">

                                        <br><br>  
                                        
                                        <label for="ref" style = "width:200px">Referensi</label>
                                        <input type="text" readonly class="form-control" name="ref" value="<?=$ref; ?>"/>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="ref" id="ref">
                                                                        
                                        </div><br>
                                        
                                    </div>


                                    <button type="submit" class="btn btn-success">Update</button>  
                                    <a href="/cv" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                    <!--<button type="reset" class="btn btn-dark">Close</button>-->
                                </form>
                            </div>
                    </div>

                </main>
                <script>
                    function positions() {
                      // alert('hai');
                        let posi = document.getElementById('pos').value;
                        document.getElementById('posisinya').value = posi;
                        }; 
                  
                </script>
                <script>
                    function jurusanS1() {
                        var sel = document.getElementById("jurS1");
                        var teks= sel.options[sel.selectedIndex].text;
                        document.getElementById("ijasahS1").value=teks;
                    }
                </script>
                <script>
                    function jurusanStrata2() {
                    // alert('Halo');
                        var sel = document.getElementById("jurS2");
                        var teks= sel.options[sel.selectedIndex].text;
                        document.getElementById("ijasahS2").value=teks;
                    }
                </script>
                <script>
                    function jurusanStrata3() {
                        var sel = document.getElementById("jurS3");
                        var teks= sel.options[sel.selectedIndex].text;
                        document.getElementById("ijasahS3").value=teks;
                    }
                </script>

                <script>
                    function jurusanS3() {
                        var sel = document.getElementById("jurS3");
                        var teks= sel.options[sel.selectedIndex].text;
                        document.getElementById("ijasahS3").value=teks;
                    }
                </script>

                <script>                
                    function tampil() {//Mengatur tampilan format tanggal lahir
                        //Mengambil tanggal lahir baru dari input date 
                        const tgl = new Date(document.getElementById('new_tgl_lahir').value);
                        const skrg = new Date();
                        let tahun = tgl.getFullYear();
                        let sekarang_tahun = skrg.getFullYear();
                        let usia = sekarang_tahun - tahun;  //  Menghitung usia
                        let bulan = tgl.getMonth() + 1; // Months start at 0
                        
                        let tanggal = tgl.getDate();
                        
                        if (tanggal < 10) tanggal = '0' + tanggal;
                        if (bulan < 10) bulan = '0' + bulan;
                        let formattedToday = tahun + '-' + bulan + '-' + tanggal;   //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
                        document.getElementById('old_tgl_lahir').value = formattedToday;    //  Menampilkan tanggal lahir dengan format MySQL
                        document.getElementById('umur').value = usia;   //  Mengisi data  usia 
                    }
                </script>
                

                <script>
                    //  Fungsi-fungsi untuk menampilkan file lampiran (image)
                    function previewKTA(){
                        const gbr = document.querySelector('#gbrKTA');
                        const prev = document.querySelector('.prevKTA');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                    function previewSIPP(){
                        //alert('Halo');
                        const gbr = document.querySelector('#gbrSIPP');
                        const prev = document.querySelector('.prevSIPP');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                    function previewSTR(){
                        const gbr = document.querySelector('#gbrSTR');
                        const prev = document.querySelector('.prevSTR');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                    function previewPasFoto(){
                        const gbr = document.querySelector('#pasfoto');
                        const prev = document.querySelector('.prevPasFoto');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                    function previewKTP(){
                        const gbr = document.querySelector('#ktp');
                        const prev = document.querySelector('.prevKTP');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                    function previewNPWP(){
                        const gbr = document.querySelector('#npwp');
                        const prev = document.querySelector('.prevNPWP');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                 
                </script>

<?= $this->endSection(); ?>


