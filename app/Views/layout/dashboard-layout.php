<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="<?= csrf_token()?>" content="<?=csrf_hash()?>" class="csrf">
  <title><?= (isset($judul)) ? $judul : '' ?></title>
  <link rel="icon" href="img/logo.jpg">

  <!-- ################### CodeIgniter 4.2.10  ############ --------------->
  
  <!-- ################### Dashboard Admin LTE 2.4.2 memakai Data Table With Full Features ############ --------------->

  <!-- !!!!!!!!!!! File-file yang diperlukan untuk dashboard dari Admin LTE 2.4.2 di dalam folder bower_components !!!!!!!!!!!!!!!!!-->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/old-font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- !!!!!!!!!!! File-file yang diperlukan untuk dashboard dari Admin LTE 2.4.2 di dalam folder bower_components !!!!!!!!!!!!!!!!!-->
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
  <!------------------------Fontawesome------------------------------------------------------------------>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-----------------------Fontawesome------------------------------------------------------------------>

  <!-- ################### Dashboard Admin LTE 2.4.2 memakai Data Table With Full Features ############ --------------->

  <!--JQuery Autocomplete > dari W3Schools (https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_autocomplete) --> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   
  </head>
<body class="hold-transition skin-blue sidebar-mini" data-rsssl=1>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Quantum</b>HRMI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../../dist/img/usr.png" class="user-image" alt="User Image">
                
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../../dist/img/usr.png" class="img-circle" alt="User Image">

                </li>
                
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Help -->
            <li>
              <a href="/ta/help" title='Help' >?</a>
            </li>
            <!-- Help -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
         
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color:burlywood">MENU UTAMA</li>
        <li>
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>       
        <li class="treeview">
          <a href="/ta">
          <i class="fa-solid fa-user-graduate"></i><span>Tenaga Ahli</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/ta"><i class="fa-solid fa-users"></i>Daftar Tenaga Ahli</a></li>
            <!--  Mencetak detil & rekap intermitten untuk urutan yang berdekatan (pada halaman yang sama) -->
            <li><a href="/imt" title="Banyak Halaman"><i class="fa-solid fa-print"></i>Cetak Intermitten (n)</a></li>
            <!--  Mencetak detil & rekap  intermitten untuk urutan yang (jaraknya) berjauhan (hanya 1 halaman) -->
            <li><a href="/imt2" title="Satu Halaman"><i class="fa-solid fa-print" title="Satu Halaman"></i>Cetak Intermitten (1)</a></li>
            <!--  Mencetak rekap intermitten untuk urutan yang (jaraknya) berjauhan (hanya 1 halaman) -->
            <li><a href="/cv" title="Satu Halaman"><i class="fa-solid fa-print" title="Satu Halaman"></i>Cetak Rekap Intermitten(1)</a></li>
            <li><a href="/lampiran" title="Lampiran"><i class="fa-solid fa-image"></i>Lampiran</a></li>
            <li><a href="/water" title="Lampiran"><i class="fa-solid fa-image"></i>Water</a></li>
          </ul>

          <a href="/pengalaman">
          <i class="fa-solid fa-building-shield"></i><span>Pengalaman Tenaga Ahli</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/pengalaman"><i class="fa-sharp fa-solid fa-city"></i>Daftar Proyek</a></li>
            <li><a href="/ta-exp"><i class="fa-sharp fa-solid fa-building-user"></i>Daftar Pengalaman</a></li>
            <li><a href="/sertifikat"><i class="fa-sharp fa-solid fa-certificate"></i></i>Sertifikat</a></li>
            <li><a href="/bahasa"><i class="fa-sharp fa-solid fa-earth-asia"></i></i>Bahasa</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
          <i class="fa-solid fa-building"></i> <span>Tender</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/tender"><i class="fa-sharp fa-solid fa-list-check"></i>Daftar Tender</a></li>
            <li class="treeview">
              <a href="#"><i class="fa-sharp fa-solid fa-file-pdf"></i>Dokumen Tender
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/akta"><i class="fa-sharp fa-solid fa-file-lines"></i>Akta</a></li>
                <li><a href="/ijin"><i class="fa-sharp fa-solid fa-file-lines"></i>Ijin Usaha</a></li>
                <li><a href="/pajak"><i class="fa-sharp fa-solid fa-file-lines"></i>Pajak</a></li>
               <!--
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i>Ijin Usaha
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                 
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    </ul>
                </li>-->
              </ul>
            </li>
            
          </ul><!-- class="treeview-menu"-->
        </li>
        <li class="header" style="color:burlywood">MENU TAMBAHAN</li>
        <li>dropdown
            <a href="/posisi"><i class="fa-sharp fa-solid fa-users"></i><span>Posisi</span></a>
            <a href="/kategori"><i class="fa-sharp fa-solid fa-layer-group"></i><span>Kategori</span></a>
          <!--   <a href="/proses"><i class="fa-sharp fa-solid fa-users"></i><span>Progress</span></a>
           <li><a href="/ajak">Novinaldi</a></li>
          //  <li><a href="/ta/ssp">Server Side</a></li>
          //  <li><a href="/ta/show">Show Server Side</a></li>-->
            
        </li>
      </ul>
    </section><!--class="sidebar"-->
    <!-- /.sidebar -->
  </aside>


      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
            <!--/////Awal Render///////-->
            <?php $this->rendersection('content'); ?>
            <!--///////Akhir Render//////-->
    </div>
            <!-- /.content-wrapper -->


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">PT. Quantum HRMI </a>All rights reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

 <!-- Bootstrap------------------------------------------------------------------------------------------------------------->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap------------------------------------------------------------------------------------------------------------->
<?= $this->rendersection('scripts');?>
  </body>

</html>
