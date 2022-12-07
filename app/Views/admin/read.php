
<?= $this->extend('admin/layout/template'); ?>
<?= $this->Section('content'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="row px-4">
                            <div class="col-8"><br><br>
                                <h2 style="text-align:center">Daftar Riwayat Hidup</h2>
                                
                                <form action="<?= route_to('read', $result['id']) ?>"  method="post">

                                    <div class = "mb-3 row">
                                        <label for="posisi" class="col-sm-3 col-form-label">Posisi yang diusulkan</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control" name="posisi" value="<?= $result['posisi'] ?>">
                                        </div>
                                    </div>

                                    <div class = "mb-3 row">
                                        <label for="perusahaan" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control name="perusahaan" value="<?= old('perusahaan', $result['perusahaan']) ?>">
                                        </div>
                                    </div>
                                     <div class = "mb-3 row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Personil</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control" name="nama" value="<?= old('nama', $result['nama']) ?>">
                                        </div>
                                    </div>
                                    <div class = "mb-1 row">
                                        <label for="ttl" class="col-sm-3 col-form-label">Tempat/tgl.lahir</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control" name="ttl" value="<?= old('ttl', $result['ttl']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="no_npwp" class="col-sm-3 col-form-label">No. NPWP</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control" name="no_npwp" value="<?= old('no_npwp', $result['no_npwp']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class = "mb-1 row">
                                        <label for="no_telp" class="col-sm-3 col-form-label">No. Telp./HP</label>
                                        <div class = "col-sm-9">
                                            <input type="text" readonly class="form-control" name="no_telp" value="<?= old('no_telp', $result['no_telp']) ?>">                                         
                                        </div>
                                    </div>

                                    <label class = "col-sm-3 col-form-label" style="width: 250px;">Pendidikan Formal</label>
                                    
                                    <div class="mb-1 row">
                                        <b>S1</b>
                                      <label class = "col-sm-2 col-form-label" style="width: 30px; text:bold">    </label>
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Jurusan</label>
                                        <div class="col-sm-5">
                                            <input type="text" readonly class="form-control" name="ijazahS1" value="<?= old('ijazahS1', $result['ijazahS1']) ?>">                              
                                        </div>
                                    </div>    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label>
                                        <label class = "col-sm-2 col-form-label" style="width: 180px;">Universitas</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s1_univ" value="<?= old('s1_univ', $result['s1_univ']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class="mb-1 row">   
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label> 
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Tahun lulus</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s1_thn" value="<?= old('s1_thn', $result['s1_thn']) ?>">                                         
                                        </div>
                                    </div>
                                    
                                    <div class="mb-1 row">
                                        <b>S2</b>
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label>
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Jurusan</label>
                                        <div class="col-sm-5">
                                            <input type="text" readonly class="form-control" name="ijazahS2" value="<?= old('ijazahS2', $result['ijazahS2']) ?>">                              
                                        </div>
                                    </div>    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label>
                                        <label class = "col-sm-2 col-form-label" style="width: 180px;">Universitas</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s2_univ" value="<?= old('s2_univ', $result['s2_univ']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class="mb-1 row">   
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label> 
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Tahun lulus</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s2_thn" value="<?= old('s2_thn', $result['s2_thn']) ?>">                                         
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <b>S3</b>
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label>
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Jurusan</label>
                                        <div class="col-sm-5">
                                            <input type="text" readonly class="form-control" name="ijazahS3" value="<?= old('ijazahS3', $result['ijazahS3']) ?>">                              
                                        </div>
                                    </div>    
                                    <div class="mb-1 row">
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label>
                                        <label class = "col-sm-2 col-form-label" style="width: 180px;">Universitas</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s3_univ" value="<?= old('s3_univ', $result['s3_univ']) ?>">                                         
                                        </div>
                                    </div>
                                    <div class="mb-1 row">   
                                        <label class = "col-sm-2 col-form-label" style="width: 30px;">    </label> 
                                        <label class = "col-sm-1 col-form-label" style="width: 180px;">Tahun lulus</label>
                                        <div class = "col-sm-5">
                                            <input type="text" readonly class="form-control" name="s3_thn" value="<?= old('s3_thn', $result['s3_thn']) ?>">                                         
                                        </div>
                                    </div>

                                    <br>
                                    <label class = "col-sm-2 col-form-label" style="width: 250px;">Pendidikan Non Formal</label>
                                    <br>
                                    
                                    
                                    <table>
                                        <tbody>
                                            <?php foreach ( $sertifikat as $v) : ?>
                                                <tr>
                                                    <td style = "width:100%"><?= $v['sertifikat']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    
                                    <br>
                                    <br>
								<br>
									<td style = "width:40%">8. Penguasaan Bahasa : </td>
								</br>
								
								<?php foreach ( $bahasa as $b) : ?>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style = "width:2%"></td>
                                                <td style = "width:5%">Bahasa</td>
                                                <td style = "width:10%"><?= $b['bahasa'];?></td>
                                                <td style = "width:1%">:</td>
                                                <td style = "width:5%"><?= $b['nilai'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
								<?php endforeach; ?>
								
                                <br>
                                <br>
                                    <label class = "col-sm-2 col-form-label" style="width: 20px;">Pengalaman</label> 

                                    <?php $i = 1; ?>
                                    
                                            <?php foreach ( $pengalaman as $v) : ?>
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td style = "widht:20%">Tahun</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['tahun']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Nama Kegiatan</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['kegiatan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Lokasi Kegiatan</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['lokasi']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Pengguna Jasa</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['pengguna']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Nama Perusahaan</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['perusahaan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Waktu Pelaksanaan</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['waktu']; ?></td> 
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Posisi Penugasan</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['posisi']; ?></td>  

                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Status Kepegawaian</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['status']; ?></td> 
                                                    </tr>
                                                    <tr>
                                                        <td style = "widht:20%">Surat Referensi</td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%"><?= $v['referensi']; ?></td> 
                                                    </tr>
                                                
                                                    <tr>
                                                        <td style = "widht:20%">Uraian Tugas     : </td>
                                                        <td style = "widht:3%">:</td>
                                                        <td style = "width:70%">
                                                        <textarea class="form-control" style="text-align:left" name="uraian" id="uraian" cols="100" rows="10" readonly> 
                                                        <?= $v['uraian'] ?></textarea>
                                                        </td>
                                                    </tr>                         
                                   


                                                    </tbody>
                                                </table>
                                               
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        
                                            <br><br>
                                            <p>Pernyataan :</p>
                                            <ul>
                                                <li>Daftar riwayat hidup ini sesuai dengan kualifikasi dan pengalaman saya</li>
                                                <li>Saya akan melaksanakan penugasan sesuai dengan waktu yang telah dijadwalkan 
                                                    dalam proposal penawaran, kecuali terdapat permasalahan kesehatan yang mengakibatkan saya tidak bisa melaksanakan tugas</li>
                                                <li>Saya berjanji melaksanakan semua penugasan</li>
                                                <li>Saya bukan merupakan bagian dari tim yang menyusun Kerangka Acuan Kerja</li>
                                                <li>Saya akan memenuhi semua ketentuan Klausul 4 dan 5 pada IKP</li>
                                            </ul>
                                            <p>Jika terdapat pengungkapan keterangan yang tidak benar secara sengaja atau sepatutnya diduga 
                                                maka saya siap untuk digugurkan dari proses seleksi atau dikeluarkan jika sudah dipekerjakan.</p>
    <pre>
                                                                                                    Surabaya, 
            Mengetahui                                                                          Yang membuat Pernyataan    
PT. Quantum HRM Internasional







Noeri Djati Perwitasari, S.Psi., M.Psi., Psikolog                                               (Dr. Pribadiyono, Ir., MS)
                Komisaris Utama
</pre>
                                            
                                    <!-- Pas foto 
                                    <div class="mb-1 row">
                                        <label for="Image" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="mb-5"> 
                                            <input class="form-control" type="file" id="pasfoto" name="foto" onchange="preview()">
                                            <button onclick="clearImage()" class="btn btn-primary mt-3">Hapus gambar</button>
                                        </div>
                                        <img id="frame" src="/img/person.png" class="img-thumbnail" style="width: 200px;">
                                    </div>
                                    Pas foto -->
                                   <!-- <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i>Cetak</button>    -->                                  
                                   <!-- <button type="reset" href="/tambah" class="btn btn-dark">Close</button> -->
                                   <a href="/admin" class="btn btn-primary p-2"><i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                                   <a href="/laporan/<?= $result['id'];?>" target="_blank" class="btn btn-success p-2"><i class="fa-solid fa-file-pdf"></i></i> Cetak PDF</a>
                                </form>
                            </div>
                    </div>

                </main>
                <script>
    $('.summernote').summernote({
        placeholder: 'Masukkan uraian tugas di sini...',
        tabsize: 2,
        height: 120,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
<?= $this->endSection(); ?>


