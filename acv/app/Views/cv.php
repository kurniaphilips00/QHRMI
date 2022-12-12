<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul ?></title>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Online file upload bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--Datatables-->
  <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <!--Online Fontawesome-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<body>
  <div class="container">
    <div class="text-center my-5">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
        Tambah Data
      </button>
    </div>
  </div>

  <div class="table-responsive">
    <table id="myTable">
      <thead>
        <tr>
          <th scope="col" style="text-align:center; width:5%">No</th>
          <th scope="col" style="text-align:center; width:30%">Nama</th>
          <th scope="col" style="text-align:center; width:10%">Alamat</th>
          <th scope="col" style="text-align:center; width:10%">Kota</th>
          <th scope="col" style="text-align:center; width:15%">Edit</th>

        </tr>
      </thead>

      <tbody>

        <?php if ($cv) {
          $no = 0;
          foreach ($cv as $v) {
            $no++;
            $id = isset($v['id']) ? $v['id'] : '';
            $nama = isset($v['nama']) ? $v['nama'] : '';
            $alamat = isset($v['alamat']) ? $v['alamat'] : '';
            $kota = isset($v['kota']) ? $v['kota'] : '';
        ?>
            <tr>
              <td style="width:5%"><?= $no ?></td>
              <td style="width:30%"><?= $nama ?></td>
              <td style="width:10%"><?= $alamat ?></td>
              <td style="width:10%"><?= $kota; ?></td>
              <td style="width:15%; text-align:center">
                  <a href="" data-bs-toggle="modal" data-bs-target="#baca<?= $id ?>">
                  <i class="fa-solid fa-magnifying-glass" title="baca"></i>
                  |<a href="/update/<?= $id; ?>">
                  <i class="fa-solid fa-pencil" title="edit"></i>|
                  <a href="/delete/<?= $id; ?>" onclick="return confirm('Yakin ingin menghapus tenaga ahli')">
                  <i class="fa-solid fa-trash-can" title="hapus"></i>|<a target="_blank" href="/laporan1/<?= $id; ?>">
                  <i class="fa-solid fa-print" title="print cv"></i>
              </td>
            </tr>

          <?php
          }
        } else { ?>

          <tr>
            <td colspan="5">Tidak ada data</td>
          </tr>
        <?php


        } ?>

      <tbody>


    </table>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!--  <form action="#" method="POST" enctype="multipart/form-data" id="form_tambah">-->

        <form action="">
          <div class="modal-body">

            <!--   <div class="alert alert-success hore" role="alert" style="display: none;"></div>-->

            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" id="nama_id" class="form-control" placeholder="Masukkan nama" required>
              <div class="invalid-feedback">Nama</div>
            </div>

            <div class="mb-3">
              <label>Posisi</label>
              <input type="text" name="posisi" id="posisi_id" class="form-control" placeholder="Masukkan posisi" required>
              <div class="invalid-feedback">Posisi</div>
            </div>

            <div class="mb-3">
              <label>Perusahaan</label>
              <input type="text" name="perusahaan" id="perusahaan_id" class="form-control" placeholder="Masukkan perusahaan" required>
              <div class="invalid-feedback">Perusahaan</div>
            </div>

            <!--
            <div class="mb-3">
              <label>Pasfoto</label>
              <input type="file" name="pasfoto" id="pasfoto_id" class="form-control" placeholder="Masukkan pasfoto">
            </div>
        -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" id="tombol_simpan" class="btn btn-primary">Simpan</button>
          </div>


        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah -->

  <!-- Modal Update -->
  <div class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Tenaga Ahli</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="simpan" method="post" enctype="multipart/form-data" id='form-update'>
          <!-- Modal body -->
          <div class="modal-body">


            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" id="nama_id" class="form-control" placeholder="Masukkan nama" required>
              <div class="invalid-feedback">Nama</div>
            </div>

            <div class="mb-3">
              <label>Posisi</label>
              <input type="text" name="posisi" id="posisi_id" class="form-control" placeholder="Masukkan posisi" required>
              <div class="invalid-feedback">Posisi</div>
            </div>

            <div class="mb-3">
              <label>Perusahaan</label>
              <input type="text" name="perusahaan" id="perusahaan_id" class="form-control" placeholder="Masukkan perusahaan" required>
              <div class="invalid-feedback">Perusahaan</div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Update -->

  <!-------------JQuery----------------------------------->
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous">
  </script>

  <!-- Popper JS & Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <!--Bootstrap 5.2---------------------->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <!--Sweet Alert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--Datatable-->
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '<?= site_url('indexAjax') ?>',
          type: 'POST',
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'nama'
          },
          {
            data: 'alamat'
          },
          {
            data: 'kota'
          },

        ],
      });
    });
  </script>

  <script>
    $("#tombol_simpan").on("click", function() {
      alert
      const nama = $("#nama_id").val();
      const posisi = $("#posisi_id").val();
      debugger;
      const $perusahaan = $("#perusahaan_id").val();
      $.ajax({
        url: "<?= site_url("add") ?>",
        type: "POST",
        data: {
          nama: $nama,
          posisi: $posisi,
          perusahaan: $perusahaan
        },
        success: function(hasil) {
          //  alert(hasil.to);
          //    var $data = $.parseJSON(hasil);
          //    
          var $data = $.parseJSON(hasil);
          console.log($data.hore);
          alert($data.hore);
          if ($data.hore == false) {} else {
            //  $(".hore").show();
            //  $(".hore").html("Data berhasil disimpan");
          }
        },
      });
    });

    function edit($id) {
      debugger;
      $.ajax({
        //url:"<?= site_url("update/") ?>"+$id,
        // debugger;
        url: "update/" + $id,
        type: "GET",
        success: function(hasil) {
          var obj = $.parseJSON(hasil);
          alert(obj.nama)
        }
      });
    }
  </script>

  <script>
    /*    $(function() {
      $("#form_tambah").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
          e.preventDefault();
          $(this).addClass('was-validated');
        } else {
          //console.log('valid');

          $("#tombol_simpan").text("Tambah...");
         // debugger;
          $.ajax({
            url: '<?= site_url('add/simpan') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            success: function(response) {//response tidak tampil !!!!!???????
              console.log(response);
            }
          });
        }
      });
    });*/
  </script>

</body>

</html>