<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
              <a href="/lampiran/tambah" class=btn btn-primary style="width:120px; background-color:#90e1f5; margin-right: 1em;">
                <i class="fa-solid fa-circle-plus"></i> Tambah</a>
            </div>
          </div>
          <!-- /.card-header -->
          <br>
          <div class="card-body">
            <?php if (session('DelSuccess')) :  ?>
              <div class="alert alert-info" role="alert">
                <?= session('DelSuccess');  //  Delete success 
                ?>
              </div>
            <?php endif; ?>
            <!--Notifikasi berhasil tambah data CV -->
            <?php if (session('AddSuccess')) :  ?>
              <div class="alert alert-success" role="alert">
                <?= session('AddSuccess'); ?>
              </div>
            <?php endif; ?>

            <?php if (session('edit-success')) :  ?>
                            <div class="alert alert-info" role="alert">
                                <?= session('edit-success');
                                ?>
                            </div>
                        <?php endif; ?>


            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align:center; width:5%">No.</th>
                  <th style="text-align:center; width:10%">Gambar</th>
                  <th style="text-align:center; width:30%">Nama file</th>
                  <th style="text-align:center; width:10%">Lampiran</th>
                  <th style="text-align:center; width:25%">Tenaga Ahli</th>
                  <th style="text-align:center; width:5%">Kode TA</th>
                  <th style="text-align:center; width:15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($img) {
                  $no = 1;
                  foreach ($img as $v) {
                    $id = isset($v['id']) ? $v['id'] : '';
                    $namafile = isset($v['namafile']) ? $v['namafile'] : '';
                    $path = isset($v['path']) ? $v['path'] : '';
                    $lampiran = isset($v['lampiran']) ? $v['lampiran'] : '';
                    $nama_ta = isset($v['nama_ta']) ? $v['nama_ta'] : '';
                    $kode_ta = isset($v['kode_ta']) ? $v['kode_ta'] : '';
                ?>
                    <tr>
                      <td style="width:5%"><?= $no ?></td>
                      <td style="width:10%">
                        <img src="/uploads/<?= $v['namafile'] ?>" width="100px">
                      </td>
                      <td style="width:30%"><?= $path ?></td>
                      <td style="width:10%"><?= $lampiran; ?></td>

                      <td style="width:25%;"><?= $nama_ta; ?></td>
                      <td style="width:5%;"><?= $kode_ta; ?></td>

                      <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                      <td style="width:15%; text-align:center">
                        <a href="/lampiran/baca/<?= $id; ?>"><i class="fa-solid fa-glasses" title="baca"></i>|
                          <a href="/lampiran/edit/<?= $id; ?>"><i class="fa-solid fa-pencil" title="edit"></i>|
                            <a href="/lampiran/hapus/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus lampiran ?')">
                              <i class="fa-solid fa-trash-can" title="hapus"></i>
                      </td>
                      <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->

                    </tr>

                  <?php
                    $no++;
                  }
                } else { ?>

                  <tr>
                    <td colspan="5">Tidak ada data(kosong)..........................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</td>
                  </tr>
                <?php


                } ?>


              </tbody>

            </table>
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
  function cari_pengalaman() {
    // alert('Hail');
    const v = document.getElementById('names').value;
    if (v != '') {
      let names = document.getElementById('names');
      names.onclick = function(event) {
        var target = event.target;
        var nama = event.target.value;
        window.location.href = "/fNama/" + nama;
      };
    }

  }

  function ShowExperts($id) {
    //      let nama = document.getElementById('#intermitten').innerText;
    window.location.href = "/ExpertsList/" + $id
  }
</script>
<?= $this->endsection(); ?>