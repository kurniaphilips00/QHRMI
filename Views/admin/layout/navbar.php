<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
           <!--     <div class="sb-sidenav-menu">Kategori</div> -->
           <!-- <?php //if (in_groups("administrator")) : ?>-->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i>
                       <!-- <i class="fas fa-columns"></i></div>-->
                       Kualifikasi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('pengalaman') ?>">Pengalaman</a>
                        <a class="nav-link" href="<?= base_url('sertifikat') ?>">Sertifikat</a>
                        <a class="nav-link" href="<?= base_url('bahasa') ?>">Bahasa</a>
                    </nav>
                </div>
           <!-- <?php// endif; ?>-->
           
                <a class="nav-link" href="proyek" ><i class="fa-solid fa-building-user"></i>Proyek</a>
        
                <a class="nav-link" href="kategori" ><i class="fa-solid fa-people-group"></i></i>Kategori</a>
           
                <a class="nav-link" href="position" ><i class="fa-sharp fa-solid fa-address-book"></i></i>Posisi</a>
           
                <a class="nav-link" href="jurusan" ><i class="fa-solid fa-marker"></i></i>Jurusan</a>
          
            
          
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-face-smile"></i>              
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="akun">User</a>
                        <a class="nav-link" href="http://localhost:8080/login">Login</a>
                        <a class="nav-link" href="http://localhost:8080/logout">Logout</a>
                    </nav>
                </div>
           


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Login sebagai :</div>
          
        </div>
    </nav>
   
</div>
