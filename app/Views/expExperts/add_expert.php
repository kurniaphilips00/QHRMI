<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session('gagal-menambah-ta')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-ta');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session('sukses-tambah-ta')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah-ta');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('/pengalaman/tambahTA') ?>" method="post">
                          
                            <div class="mb-3 row">
                                <label for="id_exp" class="col-sm-2 col-form-label">Kode Pengalaman</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                     name="kode_pengalaman" value="<?= $kode ?>" readonly>
                                </div>
                            </div>
                            <br><br>

                            <h3> Proyek</h3>
                            <div class="mb-3 row">
                                <label class="col-sm-1 col-form-label" style="width:30">Kode</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="id_pekerjaan" onchange="IsiIDPekerjaan()">
                                        <option value=""> Pilih Kode </option>
                                        <?php foreach ($proyek as $val) : ?>
                                            <option value="<?= $val['kode_proyek'] ?>">
                                                <?php echo $val['kode_proyek'] . ' - ' . $val['tahun'] . ' - ' . $val['pekerjaan'] . ' - ' .$val['instansi']; ?>
                                               
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                            
                      <!--          <label class="col-sm-1 col-form-label"style="width:60">Pekerjaan</label>-->
                                <div class="col-sm-8">
                                    <select class="form-control" id="NamaPekerjaan" onchange="IsiNamaPekerjaan()">
                                        <option value=""> Pilih Pekerjaan </option>
                                        <?php foreach ($proyek as $val) : ?>
                                            <option value="<?= $val['kode_proyek'] ?>">
                                                <?php echo $val['pekerjaan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="mb-3 row">
                                <label for="id_exp" class="col-sm-2 col-form-label">Kode Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('kode_proyek') ? 'is-invalid' : null ?>"
                                     name="kode_proyek" id="id_exp" 
                                    placeholder="Kode Pekerjaan" readonly>
                                  
                                </div>
                            </div>
                            <br>
                            <h3>Tenaga Ahli :</h3>
                            <div class="mb-3 row">
                                <label for="id_pekerjaan" class="col-sm-1 col-form-label" style="width:30">Kode</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="idTA" onchange="IsiIDTA()">
                                        <option value=""> Pilih Kode </option>
                                        <?php foreach ($ta as $val) : ?>
                                            <option value="<?= $val['kode_ta'] ?>">
                                                <?php echo $val['kode_ta'] . ' - ' . $val['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                         <!--       <label for="pekerjaan" class="col-sm-1 col-form-label"style="width:60">Nama TA</label>-->
                                <div class="col-sm-8">
                                    <select class="form-control" id="nama_TA" onchange="IsiNamaTA()">
                                        <option value=""> Pilih Tenaga Ahli </option>
                                        <?php foreach ($ta as $val) : ?>
                                            <option value="<?= $val['kode_ta'] ?>">
                                                <?php echo $val['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                             <div class="mb-3 row">
                                <label for="id_TA" class="col-sm-2 col-form-label">Kode Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('id_TA') ? 'is-invalid' : null ?>"
                                     name="kode_TA" id="id_TA" 
                                    placeholder="ID Tenaga Ahli" readonly value="<?= old('id_TA') ?>">
                                    <?php if ($validation->hasError('id_TA')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('id_TA') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                   
                            <h3>Posisi :</h3>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Kode Posisi tugas</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control"  name="posisi" id="pos">
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="id_posisi" onchange="IsiPosisiPekerjaan()">
                                        <option value="">Pilih posisi</option>
                                        <?php foreach ($posisi as $val) : ?>
                                            <option value="<?= $val['kode_posisi'] ?>"> <?= $val['posisitugas'] ?></option>
                                            
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="/ta-exp" class="btn btn-primary m-2" style="height: 40px; width: 110px"><i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                <button type="submit" class="btn btn-success" style="height: 40px; width: 110px">Simpan</button>
                            </div>
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


    function ShowExperts($id) {
        //      let nama = document.getElementById('#intermitten').innerText;
        window.location.href = "/ExpertsList/" + $id
    }
    
    function IsiPosisiPekerjaan(){
        const sel = document.getElementById("id_posisi");
        const teks = sel.options[sel.selectedIndex].value;
        let tugas = document.getElementById('id_posisi').value;
       // alert(tugas);
        document.getElementById("pos").value = teks;
        document.getElementById("editor").value = tugas;
        
    }
/*///////////////////PILIHAN TENAGA AHLI//////////////////////////////////////////////////////////////*/
   /*  Mengisi nama tenaga ahli dengan memasukkan input nama */
    function IsiNamaTA() {
        let ID = document.getElementById('nama_TA').value;
        const sel = document.getElementById("nama_TA");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("id_TA").value = ID;
        document.getElementById("NamaTA").value = teks;
    }
/*  Mengisi nama tenaga ahli dengan memasukkan input ID */
    function IsiIDTA() {    
        const sel = document.getElementById("idTA");//Ini id dari drop down/ fungsi onclick
        const teks = sel.options[sel.selectedIndex].text;
        const id = sel.options[sel.selectedIndex].value;
        sel.options[sel.selectedIndex].text=id;
        const hasil = teks.substring(4, );  // Diambil nama pekerjaannya saja, ID tidak dipakai
        let result = hasil.replace("-", "");

        //  Hapus karakter spasi yang pertama kali ditemukan
        const lastresult = result.replace(/' '/i, '');
       
        document.getElementById("id_TA").value = id;//Ini ID dari input text, sesuai nama field database > sesuai validasi
        document.getElementById("NamaTA").value = lastresult;
        
    }
/*///////////////////PILIHAN TENAGA AHLI//////////////////////////////////////////////////////////////*/

   

/////////////////////PILIHAN PEKERJAAN//////////////////////////////////////////////////////////////
/*  Mengisi kegiatan (pekerjaan) dengan memasukkan input Pekerjaan */
function IsiNamaPekerjaan() {
        //let Kegiatan = document.getElementById('nama_pekerjaan').value;
        const sel = document.getElementById("NamaPekerjaan");
        const teks = sel.options[sel.selectedIndex].text;
        const id = sel.options[sel.selectedIndex].value;
        document.getElementById("id_exp").value = id;
        document.getElementById("aktifitas").value = teks;
    }
/*  Mengisi kegiatan (pekerjaan) dengan memasukkan input ID */
    function IsiIDPekerjaan() {
        const sel = document.getElementById("id_pekerjaan");//Ini id dropdown > onclick="IsiIDPekerjaan()"
        const teks = sel.options[sel.selectedIndex].text;
        const id = sel.options[sel.selectedIndex].value;
        sel.options[sel.selectedIndex].text=id;
        const hasil = teks.substring(11, );  // Diambil nama pekerjaannya saja, ID tidak dipakai
        let result = hasil.replace("-", "");
        
        //  Hapus karakter spasi yang pertama kali ditemukan
        const lastresult = result.replace(/' '/i, '');
       
        document.getElementById("id_exp").value = id;//Ini ID input text, sesuai nama field (database) dan validasi 
        document.getElementById("aktifitas").value = lastresult;

    }
/*  Mengisi kegiatan (pekerjaan) dengan memasukkan input ID */
/////////////////////PILIHAN PEKERJAAN//////////////////////////////////////////////////////////////

</script>

<?= $this->endsection(); ?>