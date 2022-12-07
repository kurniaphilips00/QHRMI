
<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <style>
       
        </style>
            <div id="layoutSidenav_content">
                <main>
                    <div class="row px-4">
                            <div class="col-8"><br><br>
                                <h2>Form Edit Data Pengalaman</h2>        
                                <!--pasangannya di Dashboard.php fungsi simpan()-->
                                <?php if (session('gagal-update-pengalaman')) :  ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session('gagal-update-pengalaman');?>
                                    </div>
                                <?php endif; ?>
                                <!--Notifikasi berhasil tambah data CV -->

                                <form action="<?= route_to('edit-pengalaman') ?>" method="post">
                            

                                    <div class = "mb-3 row">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                        <div class = "col-sm-8"><input type="text" class="form-control"  name="nama_ta" id = "nama_ta" value="<?= $exp['nama_ta'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class = "mb-3 row">
                                        <label for="nama" class="col-sm-4 col-form-label">ID</label>
                                        <div class = "col-sm-8"><input type="text" class="form-control"  name="kode_ta" id = "kode_ta" value="<?= $exp['kode_ta'] ?>" readonly>
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                                        <div class = "col-sm-2">
                                            <input type="text" class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : null ?>" 
                                            name="tahun" id = "tahun" value="<?= old('tahun', $exp['tahun']) ?>" placeholder="Tahun Kegiatan">      
                                            <?php if ($validation->hasError('tahun')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tahun') ?>
                                                </div>  
                                            <?php endif; ?>                                        
                                        </div>
                                    </div>
                     
                                    <div class = "mb-3 row">
                                        <label for="kegiatan" class="col-sm-4 col-form-label">Nama Kegiatan</label>
                                        <div class = "col-sm-8">
                                        <input type="text" class="form-control <?= $validation->hasError('kegiatan') ? 'is-invalid' : null ?>" 
                                            name="kegiatan" value="<?= old('kegiatan', $exp['kegiatan']) ?>" placeholder="Nama Kegiatan">       
                                            <?php if ($validation->hasError('kegiatan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('kegiatan') ?>
                                                </div>  
                                            <?php endif; ?>                    
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="lokasi" class="col-sm-4 col-form-label">Lokasi Kegiatan</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="lokasi" value="<?= old('lokasi', $exp['lokasi']) ?>">                                  
                                        </div>
                                    </div>
                                    
                                    <div class = "mb-3 row">
                                        <label for="pengguna" class="col-sm-4 col-form-label">Pengguna Jasa</label>
                                        <div class = "col-sm-8">
                                        <input type="text" class="form-control <?= $validation->hasError('pengguna') ? 'is-invalid' : null ?>" 
                                            name="pengguna" id="pengguna" value="<?= old('pengguna', $exp['pengguna']) ?>" placeholder="Nama pengguna">       
                                            <?php if ($validation->hasError('pengguna')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pengguna') ?>
                                                </div>  
                                            <?php endif; ?>                                     
                                        </div>
                                    </div>
                                    
                                    <div class = "mb-1 row">
                                        <label for="pers" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="pers" value="<?= old('pers', $exp['pers']) ?>">  
                                                                             
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="uraian" class="col-sm-4 col-form-label">Uraian Tugas</label>
                                        <div class = "col-sm-8">
                                            <textarea name="uraian" value="<?= old('uraian', $exp['uraian']) ?>" id="uraian" cols="100" rows="10">
                                            <?= $exp['uraian'] ?>
                                        </textarea>                                       
                                        </div>
                                    </div>

                                    <?php
                                         $mulai=isset($exp['mulai']) ? $exp['mulai'] : '';
                                         $selesai=isset($exp['selesai']) ? $exp['selesai'] : '';
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
                                        <label class = "col-sm-4 col-form-label">Awal Pelaksanaan</label>
                                        <div class="col-sm-4">                                      
                                            <input type="text" class="form-control" name="mulai" id="awal00" value="<?= old('mulai', $tgl_mulai) ?>">   
                                        </div>
                                        <div class="col-sm-4"><input type="date" class="form-control" id="awal01" onchange="start()"></div>
                                    </div>    
                                    <div class="mb-3 row px-0">    
                                        <label class = "col-sm-4 col-form-label mx-0">Akhir Pelaksanaan</label>
                                        <div class="col-sm-4">                                      
                                            <input type="text" class="form-control" name="selesai" id="akhir00" value="<?= old('selesai', $tgl_selesai) ?>">   
                                        </div>
                                        <div class="col-sm-4"><input type="date" class="form-control" id="akhir01" onchange="end()"></div>
                                    </div> 

                                    <div class="mb-3 row px-0"> 
                                        <label class = "col-sm-3 col-form-label mx-0">Intermitten</label>
                                        <div class="col-sm-5 mx-0"><input type="text" class="form-control mx-0" name="inter" id="Intermitten" 
                                           style = "width:500" value="<?= old('inter', $exp['inter']) ?>"> 
                                        </div>

                                        <label class = "col-sm-2 col-form-label mx-0">Jml bulan</label>
                                        <div class="col-sm-2 mx-0"><input type="text" class="form-control mx-0" name="jml_bln" id="Bulan" 
                                           style = "width:100" value="<?= old('jml_bln', $exp['jml_bln']) ?>"> 
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class = "col-sm-4 col-form-label">Posisi Penugasan</label>
                                        <div class = "col-sm-8">                                           
                                            <input type="text" class="form-control" name="posisipenugasan" id="posisi" value="<?= old('posisitugas', $exp['posisitugas']) ?>" readonly>                                         
                                        </div>
                                        <div class = "mt-1 row">
                                            <label class = "col-sm-4 col-form-label">Pilih posisi penugasan</label>
                                            <div class = "col-sm-8">
                                                <select class="form-control" name="posisitugas" id="positions" onchange="pos()">
                                                    <?php foreach ($posisi as $val) : ?> 
                                                        <option value="<?= $val->posisi ?>"><?= $val->posisi?>
                                                        </option>                                                
                                                    <?php endforeach; ?>                                 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="status" class="col-sm-4 col-form-label">Status Kepegawaian</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="status" value="<?= old('statuse', $exp['statuse']) ?>">                                  
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="referensi" class="col-sm-4 col-form-label">Surat Referensi</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="referensi" value="<?= old('referensi', $exp['referensi']) ?>">                                  
                                        </div>
                                    </div>

                                    <a href="/pengalaman" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                    <button type="submit" class="btn btn-success" style="height: 40px; width: 110px">Simpan</button>  

                                </form>
                            </div>
                    </div>

                </main>
            <!---ckEditor 5 start   -->
            <script>
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );

            </script>
            <!--ckEditor 5 end---->
            <script>
                function pos() {
                   // alert ('Halo');
                    let pos = document.getElementById('positions').value;
                    document.getElementById('posisi').value = pos;
                    
                    //   window.location.href = "/fPosisi/" + posisi;
                    }; 
                
            </script>
           

            <script>                
                function start() {//    Mengatur tampilan format tanggal mulai
                
                    const tgl = new Date(document.getElementById('awal01').value);
                    let thn = tgl.getFullYear();
                   
                    let bulan = tgl.getMonth() + 1; // Months start at 0
                    //alert(bulan);
                    let tanggal = tgl.getDate();
                 //   alert(tanggal);
                    let formattedTMySQL = thn + '-' + bulan + '-' + tanggal;   //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
              
                    document.getElementById('awal00').value = formattedTMySQL;    //  Menampilkan tanggal lahir dengan format MySQL
                   
                }
            </script>
           <script>
                   function end() {
                
                        const tglawal = new Date(document.getElementById('awal01').value);
                        const tglakhir = new Date(document.getElementById('akhir01').value);
                        let time_difference = tglakhir.getTime() - tglawal.getTime();  
                        let Years_difference = 0;
                        let SisaBulan = 0;
                        let SisaHari = 0;
                        var inter = "( ";
                        //calculate days difference by dividing total milliseconds in a day  
                        let days_difference = time_difference / (1000 * 60 * 60 * 24);  
                        let Months_difference = Math.floor(days_difference / 30);
                        if (Months_difference > 12) {
                            Years_difference = Math.floor(Months_difference / 12); 
                            SisaBulan = Months_difference % 12;
                            SisaHari = days_difference - ((Years_difference * 360) + (SisaBulan * 30));
                          
                            inter += Years_difference + " tahun ";
                            inter += SisaBulan + " bulan ";
                            inter += SisaHari + " hari ";
                        }
                        else if (Months_difference > 0) {
                            SisaHari = days_difference % 30;
                            inter += Months_difference + " bulan ";
                            inter += SisaHari + " hari ";
                          //  console.log('Sisa hari ' + SisaHari);
                        }
                        else {
                            inter += days_difference + " hari ";
                        }
                        inter+=" )";
                        let tahuntglakhir = tglakhir.getFullYear();
                        let bulantglakhir = tglakhir.getMonth() + 1; // Months start at 0
                        let haritglakhir = tglakhir.getDate();
                        let tglSelesai = tahuntglakhir + '-' + bulantglakhir + '-' + haritglakhir;
                        document.getElementById('akhir00').value = tglSelesai;
                        document.getElementById('Intermitten').value = inter;
                        document.getElementById('Bulan').value = Months_difference;
                    }


           </script>

<?= $this->endSection(); ?>


