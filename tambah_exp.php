
<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="row px-4">
                            <div class="col-8"><br><br>
                                <h2>Form Tambah Data Pengalaman</h2>        
                                        <!--Notifikasi gagal tambah data  -->             
                                        <!--pasangannya di ExpController.php fungsi simpan_exp()-->
                                        <?php if (session('gagal-menambah-pengalaman')) :  ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session('gagal-menambah-pengalaman');?>
                                            </div>
                                        <?php endif; ?>
                                        <!--Notifikasi gagal tambah data  -->
                                <form action="<?= route_to('simexp') ?>"  method="post">
                                                                
                                    <div class = "mb-3 row">
                                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : null ?>" 
                                            name="tahun" value="<?= old('tahun') ?>" placeholder="Tahun Kegiatan">       
                                            <?php if ($validation->hasError('tahun')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tahun') ?>
                                                </div>  
                                            <?php endif; ?>                                    
                                        </div>
                                    </div>
                               
                                    <!------Menampilkan pilihan tenaga ahli untuk mengisi id TA     -->
                                    <div class = "mb-1 row">
                                        <label for="id" class="col-sm-4 col-form-label">ID Personil</label>
                                        <div class = "col-sm-8">
                                            <select class="form-control" name="kode_ta" id = "ta_ID" onclick="IsiNama()" onfocusout="IsiID()">
                                                <?php foreach ($ta as $val) : ?> 
                                                <!--   <option value="<?= $val['id']?>"><?= $val['id']?></option>     -->
                                                    <option value="<?= $val['id']?>"><?= $val['nama']?></option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>
                                        </div>
                                    <br>
                                    <!------Mengisi nama tenaga ahli dari drop down di atas -->
                                    <div class = "mb-3 row">
                                        <label for="Nama_Personil" class="col-sm-4 col-form-label">Nama Personil</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" readonly
                                            name="nama_ta" id="Nama_Personil" placeholder="Nama Personil">       
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control <?= $validation->hasError('kegiatan') ? 'is-invalid' : null ?>" 
                                            name="kegiatan" id="aktifitas" value="<?= old('kegiatan') ?>" placeholder="Nama Kegiatan" >       
                                            <?php if ($validation->hasError('kegiatan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('kegiatan') ?>
                                                </div>  
                                            <?php endif; ?>    
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="idproyek" class="col-sm-2 col-form-label">Nama proyek</label>
                                            <div class = "col-sm-10">
                                                <select class="form-control" name="idproyek" id="proj" onchange="tambah()">
                                                    <?php foreach ($proyek as $val) : ?> 
                                                        <option value="<?= $val->id?>"> <?= $val->pekerjaan?> </option>                                                
                                                    <?php endforeach; ?>                                 
                                                </select>
                                            </div>
                                        
                                    </div>
                                    <div class = "mb-3 row">
                                        <label for="lokasi" class="col-sm-4 col-form-label">Lokasi Kegiatan</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="lokasi" value="<?= old('lokasi') ?>">                                  
                                        </div>
                                    </div>
                                    
                                    <div class = "mb-3 row">
                                        <label for="pengguna" class="col-sm-4 col-form-label">Pengguna Jasa</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="pengguna" id="pengguna" value="<?= old('pengguna') ?>">                                  
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="pers" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="pers" id="pers" value="<?= old('pers') ?>">                                  
                                        </div>
                                    </div>
                                    
                                    <div class = "mb-1 row">
                                        <label for="uraian" class="col-sm-4 col-form-label">Uraian Tugas</label>
                                        <div class = "col-sm-8">
                                            
                                          <textarea name="uraian" value="<?= old('uraian') ?>" id="editor" cols="100" rows="10">
                                        </textarea>                                       
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label class = "col-sm-4 col-form-label">Mulai</label>
                                  <!--      <div class="col-sm-3"> 
                                            <input type="text" class="form-control" name="mulai" id="mulai" >  
                                        </div>          -->
                                        <div class="col-sm-3">                                      
                                            <input type="date" class="form-control" name="mulai1" id="tgl_awal" onchange="halo()"/>                              
                                        </div>
                                    </div>    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-4 col-form-label">Selesai</label>
                                <!--        <div class="col-sm-3"> 
                                            <input type="text" class="form-control" name="selesai" id="selesai" >  
                                        </div>  -->
                                        <div class="col-sm-3">                                      
                                            <input type="date" class="form-control" name="selesai1" id="tgl_akhir" onchange="hitung_intermitten()"/>                              
                                        </div>
                                    </div>
                
                                    <div class="mb-3 row">
                                        <label class = "col-sm-2 col-form-label">Intermitten</label>
                                        <div class="col-sm-5 mx-0">
                                            <input type="text" class="form-control mx-0" name="inter" id="intermitten" 
                                           style = "width:500"> 
                                        </div>

                                        <label class = "col-sm-2 col-form-label">Jml Bulan</label>
                                        <div class="col-sm-3">                                      
                                            <input type="text" class="form-control" readonly name="jml_bln" id="jmlbln" value="<?= old('jmlBulan') ?>">                              
                                        </div>
                                    </div>     

                 
                                    <div class = "mt-1 row">
                                        <label class = "col-sm-4 col-form-label">Posisi Penugasan</label>
                                        <div class = "col-sm-8">
                                            <select class="form-control" name="posisi">
                                                <?php foreach ($posisi as $val) : ?> 
                                                    <option value="<?= $val->posisi?>">
                                                        <?= $val->posisi?>
                                                    </option>                                                
                                                <?php endforeach; ?>                                 
                                            </select>
                                        </div>
                                    </div>
                                 
                                    <div class = "mb-3 row">
                                        <label for="status" class="col-sm-4 col-form-label">Status Kepegawaian</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="status" value="<?= old('status') ?>">                                  
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="referensi" class="col-sm-4 col-form-label">Surat Referensi</label>
                                        <div class = "col-sm-8">
                                            <input type="text" class="form-control" name="referensi" value="<?= old('referensi') ?>">                                  
                                        </div>
                                    </div>

                                    <a href="/pengalaman" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                    <button type="submit" class="btn btn-success" style="height: 40px; width: 110px">Simpan</button>  
                                    
                                </form>
                            </div>
                    </div>
                </main>
            
                <script>src="js/intermitten.js"</script>
          
          
            <!---ckEditor 5 start   -->
            <script>
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
            </script>
            <!--ckEditor 5 end---->

<?= $this->endSection(); ?>


