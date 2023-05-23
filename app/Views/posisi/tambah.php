<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Tambah Posisi</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (session('gagal-menambah-posisi')) :  ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session('gagal-menambah-posisi');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session('sukses-tambah-posisi')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('sukses-tambah-posisi');  //  Delete success 
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('/posisi/tambah') ?>" method="post">
                            <?= csrf_field() ?>
                     
                            <div class="mb-3 row">
                                <label for="posisi" class="col-sm-2 col-form-label">Masukkan Posisi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control <?= $validation->hasError('posisi') ? 'is-invalid' : null ?>" 
                                    name="posisi" id="posisi" placeholder="Posisi">
                                    <?php if ($validation->hasError('posisi')) : ?>
                                        <div class="invalid-feedback" style="color:red">
                                            <?= $validation->getError('posisi') ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Uraian Tugas</label>
                                <div class="col-sm-8">
                                    <textarea name="editor1" id="editor" cols="100" rows="11">
                                        </textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/posisi" class="btn btn-primary m-2" 
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

<!-- Start ckEditor 4 -->
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
<!--    End ckEditor 4 -->
<?= $this->endsection(); ?>