
<?= $this->extend('admin/layout/template') ?>
<?= $this->Section('content') ?>
    <div id="layoutSidenav_content">
        <main>
            <ul>
                <li><a href="#login">Login</a> ke sistem</li>

                <li>Memasukkan data tenaga ahli<a href="#entryTA"> ( entry )</a></li>
                <li><a href="#editTA">Edit</a> data tenaga ahli</li>
                <li><a href="#hapusTA">Hapus</a> data tenaga ahli</li>
                <li>Laporan riwayat hidup tenaga ahli</li>
            </ul>  

            <p id="login">Untuk masuk ke sistem(login), ketik nama dan password anda, kemudian klik tombol login</p><img src="<?= base_url('/img/login.png')?>" width = "700px">

            <p id="entryTA">Untuk memulai entry data tenaga ahli, ikuti langkah-langkah berikut :</p>
            <ol>
                <li>klik tombol tambah data di atas ( simbol +, berwarna biru muda )</li>
                <img src="<?= base_url('/img/entri1.png')?>" width = "700px">
                <li>Masukkan data-data tenaga ahli pada layar Form Tambah Data Riwayat Hidup Tenaga Ahli ( perhatikan ada yang harus di-klik, 
                    ada yang harus diketik dan ada yang bisa diklik atau diketik )</li>
                <img src="<?= base_url('/img/entri2.png')?>" width = "700px">
                <li>Klik tombol simpan untuk menyimpan data-data tenaga ahli( tombol berwarna hijau di bawah )</li>
                <img src="<?= base_url('/img/entri3.png')?>" width = "700px">
            </ol>

            <p id="editTA">Untuk mengedit data tenaga ahli, tampilannya sama seperti entry, hanya saja klik tombol <b>edit</b> :</p>
            <ol>
                <li>klik tombol edit data di samping ( simbol pena, berwarna biru )</li>
                <img src="<?= base_url('/img/edit1.png')?>" width = "700px">
                <li>Masukkan data-data tenaga ahli pada layar Form Edit Data Riwayat Hidup Tenaga Ahli ( seperti tambah data, 
                    perhatikan ada yang harus di-klik, 
                    ada yang harus diketik dan ada yang bisa diklik atau diketik )</li>
                <li>Klik tombol Update untuk menyimpan data-data tenaga ahli( tombol berwarna hijau di bawah )</li>
                <img src="<?= base_url('/img/edit2.png')?>" width = "700px">
            </ol>
            <p id="hapusTA">Untuk menghapus data tenaga ahli, klik tombol <b>hapus</b> :</p>
            <ol>
                <li>klik tombol hapus data di samping ( simbol tong sampah, berwarna biru )</li>
                <img src="<?= base_url('/img/hapus1.png')?>" width = "700px">
               
                <li>Saat muncul tombol konfirmasi, klik tombol OK untuk konfirmasi hapus data</li>
                <img src="<?= base_url('/img/hapus2.png')?>" width = "700px">
            </ol>
        </main>

    </div>
<?= $this->endSection(); ?>
 