<!-- INI BAGIAN AWAL HEADER    -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title style="background-color:#006400">PT. QUANTUM HRMI</title>

        <!--    Offline Font Awesome 
        <link href="<?= base_url('font'); ?>/css/all.css" rel="stylesheet" type="text/css"/>-->

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="<?= base_url('asset-admin'); ?>/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Online file upload bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Online file ckeditor-->
        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
        
        
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?= base_url('admin') ?>">PT. Quantum HRMI</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" enctype="multipart/form-data">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Cari..." aria-label="Cari..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->
            <div style="display: inline-block; text-align: right; width: 100%;">
                <ul class="d-flex justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('help') ?>" title = "Help">SOP</a></li>
                            <!--  <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                            <li><hr class="dropdown-divider" /></li>-->
                            <li><a class="dropdown-item" href="http://localhost:8080/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
        </nav>
        
      <!--  <div id="layoutSidenav_content">-->
            <div id="layoutSidenav">
        <!--    include file navbar.php -->
            <?= $this->include('admin/layout/navbar'); ?>
<!-- INI BAGIAN AKHIR HEADER    -->

                <!-- INI BAGIAN ISINYA (CONTENT)    -->
                <?= $this->renderSection('content'); ?>

                <!-- AWAL FOOTER    -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="justify-content-between small">
                            <div class="text-muted">Copyright &copy; PT. Quantum HRMI 2022</div>                  
                        </div>
                    </div>
                </footer>
                <!-- AKHIR  FOOTER    -->

            </div>
        
        </div>
               
        <script src="<?= base_url('asset-admin'); ?>/js/scripts.js"></script>
   
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= base_url('asset-admin'); ?>/js/datatables-simple-demo.js"></script>

        <!-- JQuery start     -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- JQuery end     -->
    <!-- Script untuk upload file -->
        <script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
            function clearImage() {
                document.getElementById('pasfoto').value = null;
                frame.src = "";
            }
        </script>
       <script>
            $('#tombolSimpan').on('click', function () {
                /*  alert('Saya di klik');
               
                var $nama = $('inputNama').val();
                    */
                $.ajax({
                    url: "<?php echo site_url("/Admin/Dashboard/simpan1") ?>",
                    type: "POST",
                    success: function(hasil) {
                        alert(hasil);
                    }
                });
            });
           

       </script>
          
    <!--  Script untuk upload file    -->

    <!-- Start ckEditor -->
 <!--   <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>-->
  <!--  <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/decoupled-document/ckeditor.js"></script>-->
 
    <!--    End ckEditor -->
    
</body>
</html>
<!-- INI BAGIAN AKHIR FOOTER    -->