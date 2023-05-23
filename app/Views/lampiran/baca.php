<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <h2>Form Baca Lampiran Tenaga Ahli</h2>
                    <!-- /.card-header -->
                    <div class="card-body">

                     
                        <form action="<?= route_to('simdit-attachment', $img['id']) ?>" 
                                method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>

                            <div class="row ms-3">
                                    <!------Mengisi nama tenaga ahli dari drop down di atas -->
                                    

                                    <div class="mb-3 row">
                                        <div class="col-sm-2 mx-3" style="margin-left:20px;">
                                            <label>Nama Tenaga Ahli</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" value="<?= $img['nama_ta'] ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2 mx-3" style="margin-left:20px;">
                                            <label>Nama file</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" value="<?= $img['namafile'] ?>" readonly>
                                        </div>
                                    </div>
                                    <!------Mengisi nama tenaga ahli dari drop down di atas -->

                                    <!--Mengisi file yang dipilih dan menampilkan gambarnya (preview)-->
                                    <div class="mb-3 row">
                                        <div class="col-sm-2 mx-3" style="margin-left:20px;">
                                            <label style="width:200px">Gambar</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="/uploads/<?= $img['namafile'] ?>" style="width: 200px;">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="mb-3 row">
                                        <!-- <label class="col-sm-2 col-form-label">Keterangan</label>-->
                                        <div class="col-sm-2 mx-3" style="margin-left:20px;">
                                            <label for="lampiran" style="width: 200px;">Lampiran</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" readonly 
                                            value="<?= $img['lampiran'] ?>" id="Nama_lampiran" >
                                        </div>
                                        
                                    </div>
                                    <br><br>
                                    <div class="modal-footer">
                                        <a href="/lampiran" class="btn btn-primary px-2 mx-2" style="height: 40px; width: 100px"><i class="fa-solid fa-circle-left"></i></i>Kembali</a>
                                        <button type="submit" class="btn btn-success" style="height: 40px; width: 100px"><i class="fa-solid fa-floppy-disk"></i>Simpan</button>
                                    </div>
                            </div>
                        </form>
                    </div>

                    <!-- /.col -->
                </div>
                
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<script>
    function FillTheName() {
        const sel = document.getElementById("ta_ID");
        const teks = sel.options[sel.selectedIndex].text;
        document.getElementById("Nama_Personil").value = teks;
    }

    function FillTheID() {

        let ta = document.getElementById('ta_ID').value;
        const sel = document.getElementById("ta_ID");
        sel.options[sel.selectedIndex].text = ta;
    }

    function previewGbr() {
        //  alert('Halo');
        const pict = document.querySelector('#gambar');
        const prev = document.querySelector('.gbr');
        const fileGbr = new FileReader();
        fileGbr.readAsDataURL(pict.files[0]);
        fileGbr.onload = function(e) {
            prev.src = e.target.result;
        }
    }
    function attachment() {
            const sel = document.getElementById("lamp");
            const lampiran = sel.options[sel.selectedIndex].text;
            document.getElementById('Nama_lampiran').value = lampiran;
        }
</script>


<?= $this->endSection(); ?>