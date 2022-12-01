
<?= $this->extend('admin/layout/template'); ?>

<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="row px-4">
                            
                            <div class="col-12"><br><br>
                                <h2>Form Tambah Data Riwayat Hidup Tenaga Ahli</h2>
                                        <!--pasangannya di Dashboard.php fungsi simpan()
                                        <div class="suwal" data-swal="<?= session('tambah');?>"></div>-->
                                        <!--Notifikasi berhasil tambah data CV -->
                                        <?php if (session('tambah')) :  ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= session('tambah');?>
                                            </div>
                                        <?php endif; ?>

                                        <!--Notifikasi gagal tambah data CV -->
                                        <!--pasangannya di Dashboard.php fungsi simpan() > session()->setFlashdata('add-failed','Tambah Data gagal !!!');-->
                                        <?php if (session('add-failed')) :  ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session('add-failed');?>
                                            </div>
                                        <?php endif; ?>
                                        <!--Notifikasi gagal tambah data CV -->
                                <form action="tambah-CV" method="post" enctype="multipart/form-data">
                                    <?= csrf_field();?>
                                    <div class = "mb-1 row">
                                        <!--Posisi Penugasan dipakai untuk mengisi Posisi yang diusulkan-->
                                        <div class = "mb-1 row">
                                            <label for="posisi" class="col-sm-4 col-form-label">Posisi yang diusulkan</label>
                                            <div class = "col-sm-8">
                                                <select class="form-control" name="posisi">
                                                    <?php foreach ($posisi as $val) : ?> 
                                                        <option value="<?= $val->posisi?>"> <?= $val->posisi?></option>                                                
                                                    <?php endforeach; ?>                                 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="perusahaan" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control <?= $validation->hasError('perusahaan') ? 'is-invalid' : null ?>" 
                                            name="perusahaan" value="<?= old('perusahaan') ?>" placeholder="Perusahaan">       
                                            <?php if ($validation->hasError('perusahaan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('perusahaan') ?>
                                                </div>  
                                            <?php endif; ?>                                  
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama Personil</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" 
                                            name="nama" value="<?= old('nama') ?>" placeholder="Personil" >       
                                            <?php if ($validation->hasError('nama')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama') ?>
                                                </div>    
                                            <?php endif; ?>                               
                                        </div>
                                    </div>

                                    <div class = "input-group mb-1">
                                        <label for="tgl_lahir" class="col-sm-1">Tanggal lahir</label>
                                        <div class = "col-sm-2">
                                            <input type = "date"  class="form-control" name="tgl" value="<?= old('tgl') ?>" id="tgl_lahir" onchange="tampil()"/>                                      
                                        </div>
                                        <label for="umur" class="col-sm-1 col-form-label">Usia</label>
                                        <div class = "col-sm-1">
                                            <input type="text" readonly class="form-control" name="usia" id="umur">                                         
                                        </div>
                                        <label for="alamat" class="col-sm-1">Alamat</label>
                                        <div class = "col-sm-4">
                                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= old('alamat') ?>" placeholder="Alamat">                                         
                                        </div>                                       
                                        <label for="kota" class="col-sm-1">Kota</label>
                                        <div class = "col-sm-1">
                                            <input type="text" class="form-control" name="kota" id="kota" value="<?= old('kota') ?>" placeholder="Kota">                                         
                                        </div>

                                    </div>

                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="no_ktp">No. KTP</span>
                                        <input type="text" class="form-control" name="no_ktp">
                                        <span class="input-group-text" id="no_npwp">No. NPWP</span>
                                        <input type="text" class="form-control" name="no_npwp" value="<?= old('no_npwp') ?>"/>
                                        <span class="input-group-text" id="no_telp">No. Telp</span>
                                        <input type = "text"  class="form-control" name="no_telp" value="<?= old('no_telp') ?>" />
                                        <span class="input-group-text" id="no_hp">No. HP</span>
                                        <input type = "text"  class="form-control" name="no_hp" value="<?= old('no_hp') ?>" />
                                    </div>
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="email">E-mail</span>
                                        <input type = "text" class="form-control" name = "email" value="<?= old('email') ?>"/>
                                        <label for="kategori" class="col-sm-1">Kategori</label>
                                            <div class = "col-sm-4">
                                                <select class="form-control" name="kategori">
                                                    <?php foreach ($kategori as $val) : ?> 
                                                        <option value="<?= $val->kategori?>"> <?= $val->kategori?></option>                                                
                                                    <?php endforeach; ?>                                 
                                                </select>
                                            </div>                                      
                                    </div>

                                    <label class = "col-sm-2 col-form-label" style="width: 120px;">Pendidikan</label>
                                    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px; font-weight:bold">S1</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS1" id="ijasah" value="<?= old('ijazahS1') ?>" placeholder="Jurusan">                              
                                        </div>

                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusan" id="jur" onchange="jurusanS1()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        <div class = "col-sm-4">
                                            <input type="text" class="form-control" name="s1_univ" value="<?= old('s1_univ') ?>" placeholder="Universitas">                                         
                                        </div>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control" name="s1_thn" value="<?= old('s1_thn') ?>" placeholder="Tahun lulus">                                         
                                        </div>
                                    </div>
                                    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px; font-weight:bold">S2</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS2" id="ijasahS2" value="<?= old('ijazahS2') ?>" placeholder="Jurusan">                              
                                        </div>

                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusanS2" id="jurS2" onchange="jurusanStrata2()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>
                                     
                                        <div class = "col-sm-4">
                                            <input type="text" class="form-control" name="s2_univ" value="<?= old('s2_univ') ?>" placeholder="Universitas">                                         
                                        </div>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control" name="s2_thn" value="<?= old('s2_thn') ?>" placeholder="Tahun lulus">                                         
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label class = "col-sm-1 col-form-label" style="width: 20px; font-weight:bold">S3</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="ijazahS3" id="ijasahS3" value="<?= old('ijazahS3') ?>" placeholder="Jurusan">                              
                                        </div>

                                        <div class = "col-sm-2">
                                            <select class="form-control" name="jurusanS3" id="jurS3" onchange="jurusanStrata3()">
                                                <?php foreach ($jurusan as $val) : ?> 
                                                    <option value="<?= $val->id?>"> <?= $val->jurusan?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>

                                        
                                        <div class = "col-sm-4">
                                            <input type="text" class="form-control" name="s3_univ" value="<?= old('s3_univ') ?>" placeholder="Universitas">                                         
                                        </div>
                                        <div class = "col-sm-3">
                                            <input type="text" class="form-control " name="s3_thn" value="<?= old('s3_thn') ?>" placeholder="Tahun lulus">                                         
                                        </div>
                                    </div>
                                    <br>
                  
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="sipp">Nomor SIPP</span>
                                        <input type="text" class="form-control" name="sipp">
                                        <span class="input-group-text" id="sipp_ed">Tgl. kadaluarsa SIPP</span>
                                        <input type = "date"  class="form-control" name="sipp_ed"/>
                                        <span class="input-group-text" id="str">Nomor STR</span>
                                        <input type="text" class="form-control" name="str">
                                        <span class="input-group-text" id="str_ed">Tgl. kadaluarsa STR</span>
                                        <input type = "date" class="form-control" name = "str_ed"/>
                                        
                                    </div>
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="kta">Nomor KTA</span>
                                        <input type="text" class="form-control" name="kta">
                                        <span class="input-group-text" id="kta_ed">Tgl. kadaluarsa nomor KTA</span>
                                        <input type = "date"  class="form-control col-sm-1" name = "kta_ed"/>
                                      
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
                                    
                                    
                                    <br>
                                    <div class="mb-3">
                                        <label for="pasfoto" style = "width:500px">Masukkan file pas foto (jpg,jpeg,png)</label>
                                        <div class="col-sm-2">
                                            <input type="file" style="display:none" class="form-control <?= $validation->hasError('pasfoto') ? 'is-invalid' : null ?>" name="pasfoto" id="pasfoto" onchange="return previewPasFoto(this);">
                                            <?php if ($validation->hasError('pasfoto')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pasfoto') ?>
                                                </div>    
                                            <?php endif; ?>                             
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevPasFoto" width = "200px"><br>

                                        <label for="ktp" style = "width:500px">Masukkan file KTP (jpg,jpeg,png) </label>
                                        <div class="col-sm-2">
                                            <input type="file"  style="display:none" class="form-control" name="ktp" id="ktp" onchange="return previewKTP(this);">
                                                                          
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevKTP" width = "200px"><br>

                                        <label for="npwp" style = "width:500px">Masukkan file NPWP (jpg,jpeg,png) </label>
                                        <div class="col-sm-10">
                                            <input type="file" style="display:none" class="form-control" name="npwp" id="npwp" onchange="return previewNPWP(this);">
                                                                   
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevNPWP" width = "200px"><br>
                                        
                                        <label for="gbrSIPP" style = "width:500px">Masukkan file SIPP (jpg,jpeg,png) </label>
                                        <div class="col-sm-3">
                                            <input type="file" style="display:none" class="form-control" name="gbrSIPP" id="gbrSIPP" onchange="return previewSIPP(this);">
                                                                       
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevSIPP" width = "200px"><br>

                                        <label for="gbrSTR" style = "width:500px" >Masukkan file STR (jpg,jpeg,png) </label>
                                        <div class="col-sm-10">
                                            <input type="file" style="display:none" class="form-control" name="gbrSTR" id="gbrSTR" onchange="return previewSTR(this);">
                                                                      
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevSTR" width = "200px"><br>
                                         
                                        <label for="gbrKTA" tyle = "width:200px" >Masukkan file KTA (jpg,jpeg,png) </label>
                                        <div class="col-sm-10">
                                            <input type="file" style="display:none" class="form-control" name="gbrKTA" id="gbrKTA" onchange="return previewKTA(this);">
                                                                         
                                        </div>
                                        <img src="/img/placeholder.png" alt="" class="prevKTA" width = "200px"><br>

                                        <label for="ref" style = "width:500px">Masukkan Referensi(file PDF)</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="ref" id="ref">
                                            <div class="invalid-feedback">File belum ada</div>                              
                                        </div>
                                        
                                    </div>

                                    <!--                        
                                    <button type="reset" class="btn btn-danger">Tutup</button>      created_at,updated_at -->
                                    <a href="/admin" class="btn btn-primary p-2" style="height: 40px; width: 100px"><i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                                    <button type="submit" class="btn btn-success" style="height: 40px; width: 100px"><i class="fa-solid fa-floppy-disk"></i>Simpan</button>  

                                </form>
                            </div>
                    </div>      
                </main>
             
                <script>                
                    function tampil() {//Mengatur tampilan format tanggal lahir
                        //Mengambil tanggal lahir baru dari input date 
                        const tgl = new Date(document.getElementById('tgl_lahir').value);
                        const skrg = new Date();
                        let tahun = tgl.getFullYear();
                        let sekarang_tahun = skrg.getFullYear();
                        let usia = sekarang_tahun - tahun;  //  Menghitung usia
                    //    let bulan = tgl.getMonth() + 1; // Months start at 0
                    //    if (tanggal < 10) tanggal = '0' + tanggal;
                    //    if (bulan < 10) bulan = '0' + bulan;
                   //     let formattedToday = tahun + '-' + bulan + '-' + tanggal;   //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
                       // document.getElementById('old_tgl_lahir').value = formattedToday;    //  Menampilkan tanggal lahir dengan format MySQL
                        document.getElementById('umur').value = usia;   //  Mengisi data  usia 
                    }
                </script>
                <script>
                    function jurusanS1() {
                        var sel = document.getElementById("jur");
                        var teks= sel.options[sel.selectedIndex].text;
                        document.getElementById("ijasah").value=teks;
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
                    function previewKTA(){
                        const gbr = document.querySelector('#gbrKTA');
                        const prev = document.querySelector('.prevKTA');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                </script>

                <script>
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
                </script>
                
                <script>
                    function previewSTR(){
                        const gbr = document.querySelector('#gbrSTR');
                        const prev = document.querySelector('.prevSTR');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                </script>

                <script>
                    function previewPasFoto(){
                        const gbr = document.querySelector('#pasfoto');
                        const prev = document.querySelector('.prevPasFoto');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                </script>

                <script>
                    function previewKTP(){
                        const gbr = document.querySelector('#ktp');
                        const prev = document.querySelector('.prevKTP');
                        const fileGbr = new FileReader();
                        fileGbr.readAsDataURL(gbr.files[0]);
                        fileGbr.onload = function(e) {
                            prev.src = e.target.result;
                        }
                    }
                </script>

                <script>
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



    
