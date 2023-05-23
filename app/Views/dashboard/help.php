<?= $this->extend('layout/dashboard-layout') ?>
<?= $this->Section('content') ?>
<!-- Main content -->
<section class="content">
    <h1>
        <center>Standard Operating Procedure</center>
    </h1>
    <ol>
        <li>Mengolah data <a href="#Posisi">posisi</a></li>
        <li>Mengolah data <a href="#Kategori">kategori</a></li>
        <li>Mengolah data <a href="#Jurusan">jurusan</a></li>
        <li>Mengolah data tenaga <a href="#TA">ahli</a></li>
        <li>Mengolah data <a href="#Pengalaman">pengalaman</a></li>
        <li>Mengolah data <a href="#TA-Pengalaman">ta-pengalaman</a></li>
        <li>Mengolah data <a href="#Sertifikat">sertifikat</a></li>
        <li>Mengolah data <a href="#Bahasa">bahasa</a></li>
        <li>Mengolah data <a href="#Lampiran">lampiran</a></li>
        <li>Mengolah data <a href="#Tender">tender</a></li>
    </ol>

    <ul>
        <h3 id="Posisi">
            <center>Mengolah Data Posisi</center>
        </h3>
        <p>Data posisi merupakan data inisialisasi sebelum kita memasukkan data tenaga ahli - pengalaman,
            jadi kita harus mengisi data posisi dahulu agar nantinya bisa digunakan <br> pada drop down(pilihan) posisi,
            saat klik menu TA - Pengalaman ( pengolahan data TA - Pengalaman )</p>
        <li>Klik menu Posisi</a> pada sisi kiri dashboard</li>
        <img src="<?= base_url('/img/entri_posisi_1.png') ?>" width="200px" height="550">
        <li>klik tombol Tambah</li>
        <img src="<?= base_url('/img/entri_posisi_2.png') ?>" width="500px">
        <li>Masukkan posisi, kemudian ketik uraian tugasnya, setelah itu blok, kemudian klik tombol numbered list atau bulleted list.
            <br>Uraian tugas ini akan akan muncul secara otomatis beserta pilihan daftar angka atau bullet ( numbered atau bulleted list )<br>
            pada saat kita mengisi posisi pada menu pengolahan data TA - Pengalaman.
        </li>

        <img src="<?= base_url('/img/entri_posisi_3.png') ?>" width="750px" height="450px">
        <li>Klik tombol simpan</li>
        <img src="<?= base_url('/img/entri_posisi_4.png') ?>" width="200px" height="200px">
    </ul>

    <ul>
        <h3 id="Kategori">
            <center>Mengolah Data Kategori</center>
        </h3>
        <p>Data kategori merupakan data inisialisasi sebelum kita memasukkan data tenaga ahli,
            jadi kita harus mengisi data kategori dahulu agar nantinya bisa digunakan <br> pada drop down(pilihan) kategori,
            saat klik menu Dashboard ( pengolahan data Tenaga Ahli )</p>
        <li>Klik menu Kategori</a> pada sisi kiri dashboard</li>
        <img src="<?= base_url('/img/entri_kategori_1.png') ?>" width="200px" height="550">
        <li>klik tombol Tambah</li>
        <img src="<?= base_url('/img/entri_kategori_2.png') ?>" width="500px" height="250px">
        <li>Masukkan kategori, kemudian Klik tombol simpan</li>
        <img src="<?= base_url('/img/entri_kategori_3.png') ?>" width="500px" height="150px">
        <li>Untuk menghapus kategori, klik tombol hapus ( icon tong sampah ) pada baris kategori yang akan dihapus</li>
        <img src="<?= base_url('/img/hapus_kategori_1.png') ?>" width="500px" height="150px">
        <li>Klik Ok untuk konfirmasi</li>
        <img src="<?= base_url('/img/hapus_kategori_2.png') ?>" width="500px" height="150px">
    </ul>

    <ul>
        <h3 id="Jurusan">
            <center>Mengolah Data Jurusan</center>
        </h3>
        <p>Data jurusan merupakan data inisialisasi sebelum kita memasukkan data tenaga ahli,
            jadi kita harus mengisi data jurusan dahulu agar nantinya bisa digunakan <br> pada drop down(pilihan) jurusan,
            saat klik menu Dashboard ( pengolahan data Tenaga Ahli )</p>
        <li>Klik menu Jurusan</a> pada sisi kiri dashboard</li>
        <img src="<?= base_url('/img/entri_jurusan_1.png') ?>" width="200px" height="550">
        <li>klik tombol Tambah</li>
        <img src="<?= base_url('/img/entri_jurusan_2.png') ?>" width="500px" height="250px">
        <li>Masukkan jurusan, kemudian Klik tombol simpan</li>
        <img src="<?= base_url('/img/entri_jurusan_3.png') ?>" width="600px" height="150px">
        <li>Untuk menghapus jurusan, klik tombol hapus ( icon tong sampah ) pada baris jurusan yang akan dihapus</li>
        <img src="<?= base_url('/img/hapus_jurusan_1.png') ?>" width="600px">
        <li>Klik Ok untuk konfirmasi</li>
        <img src="<?= base_url('/img/hapus_jurusan_2.png') ?>" width="500px" height="150px">
    </ul>

    <ul>
        <h3 id="TA">
            <center>Mengolah Data Tenaga Ahli</center>
        </h3>
        <li>Memasukkan data tenaga ahli<a href="#entryTA"> ( entry )</a></li>
        <li><a href="#editTA">Edit</a> data tenaga ahli</li>
        <li><a href="#hapusTA">Hapus</a> data tenaga ahli</li>
        <li>Laporan <a href="#cv">riwayat hidup</a> tenaga ahli</li>
        <li>Menyaring <a href="#filter">(filter)</a> bisa berdasarkan usia, jurusan sarjana, jurusan S2 atau S3</li>
        <li>Untuk export atau import ke Excel klik tombol-tombol <a href="#exim">
                <bold>exim</bold>
            </a> berikut</li>
    </ul>

    <!-- <p id="login">Untuk masuk ke sistem(login), ketik nama dan password anda, kemudian klik tombol login</p><img src= -->
    <br>
    <p id="entryTA">Untuk memulai entry data tenaga ahli, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/entri1.png') ?>" width="500px">
        <li>Masukkan data-data tenaga ahli pada layar Form Tambah Data Tenaga Ahli ( perhatikan ada yang harus di-klik,
            ada yang harus diketik dan ada yang bisa diklik atau diketik )</li>
        <img src="<?= base_url('/img/entri2.png') ?>" width="500px">

        <li>Jangan lupa memasukkan nama personil dan nama perusahaan, karena jika kosong akan muncul error</li>
        <img src="<?= base_url('/img/entri2b.png') ?>" width="500px">


        <li>Klik tombol simpan untuk menyimpan data-data tenaga ahli( tombol berwarna hijau di bawah )</li>
        <img src="<?= base_url('/img/entri3.png') ?>" width="500px">
    </ol>

    <p id="editTA">Untuk mengedit data tenaga ahli, tampilannya sama seperti entry, hanya saja klik tombol <b>edit</b> :</p>
    <ol>
        <li>klik tombol edit data di samping ( simbol pena, berwarna biru )</li>
        <img src="<?= base_url('/img/edit1.png') ?>" width="500px">
        <li>Masukkan data-data tenaga ahli pada layar Form Edit Data Tenaga Ahli ( seperti tambah data,
            perhatikan ada yang harus di-klik,
            ada yang harus diketik dan ada yang bisa diklik atau diketik )</li>
        <li>Klik tombol Update untuk menyimpan data-data tenaga ahli( tombol berwarna hijau di bawah )</li>
        <img src="<?= base_url('/img/edit2.png') ?>" width="500px">
    </ol>
    <p id="hapusTA">Untuk menghapus data tenaga ahli, klik tombol <b>hapus</b> :</p>
    <ol>
        <li>klik tombol hapus data di samping ( simbol tong sampah, berwarna biru )</li>
        <img src="<?= base_url('/img/hapus1.png') ?>" width="200px" height="300px">

        <li>Saat muncul tombol konfirmasi, klik tombol OK untuk konfirmasi hapus data</li>
        <img src="<?= base_url('/img/hapus2.png') ?>" width="500px">
    </ol>
    <p id="cv">Untuk mencetak riwayat hidup,
        klik tombol dengan simbol printer pada baris tenaga ahli yang akan dicetak</p>
    <ul><img src="<?= base_url('/img/cv.png') ?>" width="500px"></ul>
    <br>
    <p id="filter">Untuk filter klik tombol-tombol berikut sesuai pilihan filter</p>
    <ul><img src="<?= base_url('/img/filter.png') ?>" width="300px"></ul>
    <br>
    <p id="exim">Tombol-tombol berikut untuk export/import ke Excel</p>
    <ul><img src="<?= base_url('/img/exim.png') ?>" width="500px"></ul>

    <ul>
        <h3 id="Pengalaman">
            <center>Mengolah Data Pengalaman</center>
        </h3>
        <li>Memasukkan data pengalaman<a href="#entryExperiences"> ( entry )</a></li>
        <li><a href="#editExperiences">Edit</a> data pengalaman</li>
        <li><a href="#hapusExperiences">Hapus</a> data pengalaman</li>
        <li>Tambah tenaga <a href="#addExpert">ahli</a> untuk satu pengalaman ( project )</li>
    </ul>

    <!-- <p id="login">Untuk masuk ke sistem(login), ketik nama dan password anda, kemudian klik tombol login</p><img src= -->
    <br>
    <p id="entryExperiences">Untuk memulai entry data pengalaman ( atau proyek/pekerjaan ), ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/entri_exp1.png') ?>" width="500px">
        <li>Masukkan data-data pengalaman ( perhatikan tahun, pekerjaan/kegiatan, dan instansi harus diisi,
            jika tidak akan muncul error )</li>
        <img src="<?= base_url('/img/entri_exp2a.png') ?>" width="500px">

        <li>Jika data-data pengalaman (atau pekerjaan/kegiatan/proyek ) sudah lengkap, klik tombol simpan untuk menyimpan</li>
        <img src="<?= base_url('/img/entri_exp2b.png') ?>" width="500px">
    </ol>

    <p id="editExperiences">Untuk mengedit data pengalaman, tampilannya sama seperti entry,
        hanya saja klik tombol <b>edit</b> :</p>
    <ol>
        <li>klik tombol edit data di samping ( simbol pena, berwarna biru )</li>
        <img src="<?= base_url('/img/edit_exp1.png') ?>" width="500px">
        <li>Masukkan data-data pengalaman pada layar Form Edit Data Pengalaman ( seperti tambah data,
            perhatikan ada yang harus di-klik,
            ada yang harus diketik )</li>
        <li>Klik tombol Update untuk menyimpan data-data tenaga ahli( tombol berwarna hijau di bawah )</li>
        <img src="<?= base_url('/img/edit_exp2.png') ?>" width="500px">
    </ol>

    <p id="hapusExperiences">Untuk menghapus data pengalaman, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>Klik tombol hapus data di samping ( simbol tong sampah, berwarna biru )</li>
        <img src="<?= base_url('/img/hapus1.png') ?>" width="200px" height="300px">

        <li>Saat muncul tombol konfirmasi, klik tombol OK untuk konfirmasi hapus data</li>
        <img src="<?= base_url('/img/hapus2.png') ?>" width="500px">
    </ol>

    <p id="addExpert">Untuk memulai entry data tenaga ahli dari pengalaman, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol Tambah TA di atas ( +, berwarna biru muda )</li>
        <img src="<?= base_url('/img/add_expert1.png') ?>" width="600px">
        <li>Untuk memasukkan pekerjaan(proyek) bisa memakai dropdown ID ( jika ingat ID ),<br>
            <img src="<?= base_url('/img/add_expert3.png') ?>" width="600px"><br>
            bisa juga dari dropdown nama pekerjaan/proyek ( jika ingat nama pekerjaan/proyek )<br>
            <img src="<?= base_url('/img/add_expert4.png') ?>" width="600px">
        </li>
        <li>Demikian juga untuk tenaga ahli, bisa dipilih dari dropdown ID atau dropdown nama tenaga ahli<br>
            <img src="<?= base_url('/img/add_expert4b.png') ?>" width="750px" height="100px">
        </li>
        <li>Untuk memasukkan posisi, pilih drop down posisi, otomatis akan terisi uraian tugas beserta bulleted atau numbered list-nya.
            Tampilan bulleted atau numbered list ini tergantung pilihan saat kita entry data posisi<br></li>
        <img src="<?= base_url('/img/add_expert5.png') ?>" width="600px">
        </li>
        <li>Jika data sudah terisi lengkap, klik tombol simpan</li>
        <img src="<?= base_url('/img/add_expert6.png') ?>" width="300px">
    </ol>
    <p id="TA-Pengalaman">Untuk menambah Tenaga Ahli Pengalaman sama seperti
        <a href="#addExpert"> menambah tenaga ahli </a>
        pada pengalaman di atas
    </p>
    <ul>
        <h3 id="Sertifikat">
            <center>Mengolah Data Sertifikat</center>
        </h3>
        <li>Memanggil <a href="#menuSertifikat"> menu </a> sertifikat</li>
        <li>Memasukkan data sertifikat<a href="#entrySertifikat"> ( entry )</a></li>
        <li><a href="#editSertifikat">Edit</a> data sertifikat</li>
        <li><a href="#hapusSertifikat">Hapus</a> data sertifikat</li>
    </ul>

    <p id="menuSertifikat">Untuk memanggil menu sertifikat, klik sertifikat di sebelah kiri dashboard :</p>
    <ol><img src="<?= base_url('/img/menu_sert.png') ?>" width="200px" height="600px"></ol>

    <p id="entrySertifikat">Untuk memulai entry data sertifikat, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/add_sert1.png') ?>" width="500px">
        <li>Masukkan data-data sertifikat</li>
        <img src="<?= base_url('/img/add_sert2.png') ?>" width="500px">
        <li>Klik tombol simpan untuk menyimpan data sertifikat</li>
        <img src="<?= base_url('/img/add_sert3.png') ?>" width="500px">
    </ol>

    <p id="editSertifikat">Untuk mengedit data sertifikat, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol edit pada baris yang akan di-edit</li>
        <img src="<?= base_url('/img/edit_sert1.png') ?>" width="500px">
        <li>Masukkan data-data yang akan diedit</li>
        <img src="<?= base_url('/img/edit_sert2.png') ?>" width="500px">
        <li>Klik tombol update untuk menyimpan data sertifikat</li>
        <img src="<?= base_url('/img/edit_sert3.png') ?>" width="200px" height="150px">
    </ol>

    <ul>
        <h3 id="Bahasa">
            <center>Mengolah Data Bahasa</center>
        </h3>
        <li>Memanggil <a href="#menuBahasa"> menu </a> Bahasa</li>
        <li>Memasukkan data Bahasa<a href="#entryBahasa"> ( entry )</a></li>
        <li><a href="#editBahasa">Edit</a> data Bahasa</li>
        <li><a href="#hapusBahasa">Hapus</a> data Bahasa</li>
    </ul>
    <ol id="menuBahasa">Untuk memanggil menu Bahasa, klik Bahasa di sebelah kiri dashboard :</ol>
    <ol><img src="<?= base_url('/img/menu_bahasa.png') ?>" width="200px" height="400px"></ol>

    <p id="entryBahasa">Untuk memulai entry data Bahasa, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/add_bahasa1.png') ?>" width="500px">
        <li>Masukkan data-data Bahasa</li>
        <img src="<?= base_url('/img/add_bahasa2.png') ?>" width="500px">
        <li>Klik tombol simpan untuk menyimpan data Bahasa</li>
        <img src="<?= base_url('/img/add_bahasa3.png') ?>" width="500px">
    </ol>

    <p id="editBahasa">Untuk mengedit data Bahasa, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol edit pada baris yang akan di-edit</li>
        <img src="<?= base_url('/img/edit_bahasa1.png') ?>" width="500px">
        <li>Masukkan data-data yang akan diedit</li>
        <img src="<?= base_url('/img/edit_bahasa2.png') ?>" width="500px">
        <li>Klik tombol update untuk menyimpan data Bahasa</li>
        <img src="<?= base_url('/img/edit_bahasa3.png') ?>" width="200px" height="150px">
    </ol>

    <ul>
        <h3 id="Lampiran">
            <center>Mengolah Data Lampiran</center>
        </h3>
        <li>Memanggil <a href="#menuLampiran"> menu </a> Lampiran</li>
        <li>Memasukkan data Lampiran<a href="#entryLampiran"> ( entry )</a></li>
        <li><a href="#hapusLampiran">Hapus</a> data Lampiran</li>
    </ul>
    <ol id="menuLampiran">Untuk memanggil menu Lampiran, klik Lampiran di sebelah kiri dashboard :</ol>
    <ol><img src="<?= base_url('/img/menu_lampiran.png') ?>" width="200px" height="400px"></ol>

    <p id="entryLampiran">Untuk memulai entry data Lampiran, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/add_lampiran1.png') ?>" width="500px">
        <li>Masukkan data-data Lampiran</li>
        <img src="<?= base_url('/img/add_lampiran2.png') ?>" width="500px">
        <li>Klik drop down untuk memilih jenis lampiran, kemudian klik tombol simpan untuk menyimpan data Lampiran</li>
        <img src="<?= base_url('/img/add_lampiran3.png') ?>" width="500px">
    </ol>

    <p id="hapusLampiran">Untuk menghapus data Lampiran :</p>
    <ol>
        <li>Klik tombol sampah</li>
        <img src="<?= base_url('/img/hapus_lampiran1.png') ?>" width="500px">
        <li>Klik tombol Ok untuk konfirmasi</li>
        <img src="<?= base_url('/img/hapus_lampiran2.png') ?>" width="500px">
    </ol>

    <ul>
        <h3 id="Tender">
            <center>Mengolah Data Tender</center>
        </h3>
        <li>Memasukkan data tender<a href="#entryTender"> ( entry )</a></li>
        <li><a href="#editTender">Edit</a> data tender</li>
        <li><a href="#hapusTender">Hapus</a> data tender</li>
    </ul>


    <br>
    <p id="entryTender">Untuk memulai entry data tender, ikuti langkah-langkah berikut :</p>
    <ol>
        <li>klik tombol tambah data di atas ( +, berwarna biru )</li>
        <img src="<?= base_url('/img/add_tender1.png') ?>" width="500px">
        <li>Masukkan data-data tender ( perhatikan ada yang harus di-klik,
            ada yang harus diketik ), ...</li>
        <img src="<?= base_url('/img/add_tender2.png') ?>" width="500px">
        <li>Pastikan memasukkan kode dan nama tender, jika tidak akan muncul error...</li>
        <img src="<?= base_url('/img/add_tender3.png') ?>" width="500px">
        <li>Klik tombol simpan untuk menyimpan data tender.</li>
        <img src="<?= base_url('/img/add_tender4.png') ?>" width="200px" height="200px">
    </ol>

    <p id="editTender">Untuk mengedit data tender, ikuti langkah-langkah berikut :</p>

    <ol>
        <li>klik tombol edit data di samping ( simbol pena, berwarna biru )</li>
        <img src="<?= base_url('/img/edit_tender1.png') ?>" width="500px">
        <li>Masukkan data-data tender pada layar Form Edit Data Tender ( seperti tambah data,
            perhatikan ada yang harus di-klik,
            ada yang harus diketik )</li>
        <li>Klik tombol Update untuk menyimpan data-data tender ( tombol berwarna hijau di bawah )</li>
        <img src="<?= base_url('/img/edit_tender2.png') ?>" width="500px">
    </ol>

    <p id="hapusTender">Untuk menghapus data tender, ikuti langkah-langkah berikut :</p>

    <ol>
        <li>klik tombol hapus data di samping ( simbol tong sampah )</li>
        <img src="<?= base_url('/img/del_tender1.png') ?>" width="500px">
        <li>Konfirmasi dengan klik tombol Ok</li>
        <img src="<?= base_url('/img/del_tender2.png') ?>" width="500px">
    </ol>

</section>
<?= $this->endSection(); ?>