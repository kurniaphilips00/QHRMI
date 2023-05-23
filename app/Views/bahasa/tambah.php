<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Tambah Bahasa</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (session('gagal-menambah-bahasa')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-bahasa');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('sukses-tambah-bahasa')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah-bahasa');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('/bahasa/tambah') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3 row">
                                <label for="id_pekerjaan" class="col-sm-1 col-form-label" style="width:30">ID</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="idTA" onclick="IsiIDTA()">
                                        <option value=""> Pilih ID </option>
                                        <?php foreach ($taID as $val) : ?>
                                            <option value="<?= $val['id'] ?>">
                                                <?php echo $val['id'] . ' - ' . $val['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                               <!-- <label for="pekerjaan" class="col-sm-1 col-form-label"style="width:60">Nama TA</label>-->
                                <div class="col-sm-8">
                                    <select class="form-control" id="nama_TA" onchange="IsiNamaTA()">
                                        <option value=""> Pilih Tenaga Ahli </option>
                                        <?php foreach ($taName as $val) : ?>
                                            <option value="<?= $val['id'] ?>">
                                                <?php echo $val['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                             <div class="mb-3 row">
                                <label for="kode_ta" class="col-sm-2 col-form-label">ID Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control <?= $validation->hasError('kode_ta') ? 'is-invalid' : null ?>"
                                     name="kode_ta" id="kode_ta" 
                                    placeholder="ID Tenaga Ahli" readonly value="<?= old('kode_ta') ?>">
                                    <?php if ($validation->hasError('kode_ta')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('kode_ta') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="NamaTA" class="col-sm-2 col-form-label">Nama Tenaga Ahli</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_TA" id="NamaTA" 
                                    placeholder="Nama Tenaga Ahli" readonly value="<?= old('nama_TA') ?>">
                                    
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai Bahasa Indonesia</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" 
                                    name="nilai_bhs_indo" placeholder="Bahasa Indonesia">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai Bahasa Inggris</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" 
                                    name="nilai_bhs_inggris" placeholder="Bahasa Inggris">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nilai Bahasa setempat</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" 
                                    name="nilai_bhs_setempat" placeholder="Bahasa setempat">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="/bahasa" class="btn btn-primary m-2" 
                                    style="height: 35px; width: 90px">
                                    <i class="fa-solid fa-circle-left"></i></i> Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
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

function isiKadaluarsa() {
    //  Jangan memakai onclick() untuk tanggal, pakai onchange()
        const tgl = new Date(document.getElementById('kadal').value);
        //alert(tgl.toString());
        let tahun = tgl.getFullYear();
        let bulan = tgl.getMonth() + 1; // Months start at 0
        let tanggal = tgl.getDate();

        let formattedMySQL = tahun + '-' + bulan + '-' + tanggal; //  Format tanggal disesuaikan dengan MySQL AGAR BISA DISIMPAN
        document.getElementById('txtKadaluarsa').value = formattedMySQL;

    }
/*///////////////////PILIHAN TENAGA AHLI//////////////////////////////////////////////////////////////*/
   /*  Mengisi nama tenaga ahli dengan memasukkan input nama */
    function IsiNamaTA() {
        let ID = document.getElementById('nama_TA').value;
        const sel = document.getElementById("nama_TA");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("kode_ta").value = ID;
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
        document.getElementById("kode_ta").value = id;//Ini ID dari input text, sesuai nama field database > sesuai validasi
        document.getElementById("NamaTA").value = result;
        
    }
/*///////////////////PILIHAN TENAGA AHLI//////////////////////////////////////////////////////////////*/
</script>

<?= $this->endsection(); ?>