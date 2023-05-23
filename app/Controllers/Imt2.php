<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Base;
use App\Models\rhModel;
use App\Models\posisiModel;
use App\Models\bhsModel;
use App\Models\sertModel;
use App\Models\proyekTAModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;

class Imt2 extends BaseController
{
    protected $rhModel;
    protected $posisiModel; //  Untuk mencetak riwayat hidup
    protected $bhsModel;//  Untuk mencetak riwayat hidup
    protected $sertModel;//  Untuk mencetak riwayat hidup
    protected $base;
    protected $proyekTAModel;

    public function __construct()
    {
        $rh = $this->rhModel = new rhModel();
        $posisi = $this->posisiModel = new posisiModel();
        $bhs = $this->bhsModel = new bhsModel();
        $sertifikat = $this->sertModel = new sertModel();
        $proyekTAModel = $this->proyekTAModel = new proyekTAModel();
    }
    public function index()
    {
        //d($this->request->getVar('keyword'));
        $result = $this->rhModel->getCVwithKode();
        //$pager = $this->rhModel->pager;
        $data = ['rh' => $result, 'judul' => 'Riwayat Hidup Tenaga Ahli'];
        return view('imt2/index', $data);
    }
    public function cetakCV($kode = null)
    {
        $dompdf = new Dompdf();
        $options =  new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isPHPEnabled', true);
        $dompdf->setOptions($options);

        //  Ini memanggil fungsi dari Base.php
        //  Memanggil fungsi getBulan() untuk mencetak nama-nama bulan 
        $this->base = new Base();

        $imageku = $this->base->base64('uploads/tt.png', 'png');

        $result = $this->rhModel->getCVwithKode($kode);
        $proyekTAModel = $this->proyekTAModel->getViewCV($kode);
        $sertifikat = $this->sertModel->getLaporanCV($kode);
        $skrg = date('d-M-Y');
        $tgl = isset($result['tgl']) ? $result['tgl'] : '';
        if ($tgl != '0000-00-00' && $tgl != null && $tgl != '') {
            $tgl = substr($result['tgl'], 8, 2);
            $bln = substr($result['tgl'], 5, 2);
            //  Ini memanggil fungsi dari Base.php
            //  Memanggil fungsi getBulan() untuk mencetak nama-nama bulan 
            // $this->base = new Base();
            $bulan = $this->base->getBulan((int)$bln);
            $thn = substr($result['tgl'], 0, 4);
            $tanggal = $tgl . ' ' . $bulan . ' ' . $thn;
        } else {
            $tanggal = '';
        }
        $bhs = $this->bhsModel->getLaporanCV($kode);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>DAFTAR RIWAYAT HIDUP</title>         
        </head>';

        //@page { margin: 100px 30px 50px 30px; } berarti margin (halaman) atas 100px, kanan 30px, bawah 50px, kiri 30px 
        $html .= '
        <style>
            @page { margin: 100px 30px 50px 30px; }
            #header { position: fixed; left: 0px; top: -70px; right: 0px; height: 70px; background-color: green; text-align: center; color: white}
            div .sert {
                word-wrap: break-word;
            .thn {  background-color:#9dfc03" }
            .dir { text-indent: -8em; }
            .pernyataan { text-indent: 30em; }
            .Surabaya { text-indent: 34em; }
            .name { text-alignment: rigth; }
            .Pribadiyono { width: 50em; max-width: 100%; }
            .Pribadiyono p { display: inline-block; max-width: 90%; }
            .Pribadiyono p:nth-child(1) { float:left; }
            .Pribadiyono p:nth-child(2) { float:right; }
            .Mengetahui { width: 35em; max-width: 100%; }
            .Mengetahui p { display: inline-block; max-width: 100%; }
            .Mengetahui p:nth-child(1) { float:left; }
            .Mengetahui p:nth-child(2) { float:right; }

            footer {
                position: fixed; 
                bottom: -40px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                color: black;
                text-align: left;
                line-height: 35px;
            }
        </style>
        <body>';
        $html .= '<div id="header">
                    <h2>DAFTAR RIWAYAT HIDUP</h2>
                </div>';

        $html .= '
        <footer>
            Copyright &copy; PT. Quantum HRM Internasional  
        </footer>
        ';

        ////////////////////////////////////////////////////AWAL TABEL PERTAMA//////////////////////////////////////////////////////////////         
        $html .= '
        <table>
            <tbody>
                <br>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">1. Posisi yang diusulkan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['posisi'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">2. Nama perusahaan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['perusahaan'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">3. Nama personil</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['nama'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">4. Tempat lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['kota'] . '</td>                    
                </tr>
                
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">5. Tanggal lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $tanggal . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">6. No. NPWP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['no_npwp'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">7. No. Telp.</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['no_telp'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">8. No. HP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['no_hp'] . '</td>                    
                </tr>
           ';

        $html .= '<p colspan="3" style = "width:100%;font-size:14px;font-family: "Times New Roman">9. Pendidikan Formal       : </p>';

        $html .= '
                <tr>
                   <td style = "width:20%;font-size:14px;font-family: "Times New Roman"><b>S1 :</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['ijazahS1'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman", Times, serif;">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman", Times, serif;">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman", Times, serif;">' . $result['s1_univ'] . '</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $result['s1_thn'] . '</td>                    
                </tr>';
        $ijazahS2 = isset($result['ijazahS2']) ? $result['ijazahS2'] : '';
        if ($ijazahS2 != '' && $ijazahS2 != null) {
            $S2 = $result['ijazahS2'];
            $PT_S2 = $result['s2_univ'];
            $S2_Lulus_Tahun = $result['s2_thn'];
            $html .= '
                        <tr>
                            <td style = "width:100%;font-size:14px;font-family: "Times New Roman"><b>' . 'S2 :' . '</b></td>
                        </tr>
                        <tr>
                            <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                            <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                            <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $S2 . '</td>                    
                        </tr>
                        <tr>
                            <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                            <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                            <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $PT_S2 . '</td>                    
                        </tr>
                        <tr>
                            <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                            <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                            <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $S2_Lulus_Tahun . '</td>                    
                        </tr>
                    ';
        }
        $ijazahS3 = isset($result['ijazahS3']) ? $result['ijazahS3'] : '';
        if ($ijazahS3 != '' && $ijazahS3 != null) {
            $S3 = $result['ijazahS3'];
            $PT_S3 = $result['s3_univ'];
            $S3_Lulus_Tahun = $result['s3_thn'];
            $html .= '
                    <tr>
                        <td style = "width:20%;font-size:14px;font-family: "Times New Roman"><b>' . 'S3 :' . '</b></td>
                    </tr>
                    <tr>
                        <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                        <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                        <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $S3 . '</td>                    
                    </tr>
                    <tr>
                        <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                        <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                        <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $PT_S3 . '</td>                    
                    </tr>
                    <tr>
                        <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                        <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                        <td style = "width:75%;font-size:14px;font-family: "Times New Roman">' . $S3_Lulus_Tahun . '</td>                    
                    </tr>
                    ';
        }
        $html .= '
            </tbody>
        </table> <br>';
        ////////////////////////////////////////////////////AKHIR TABEL PERTAMA//////////////////////////////////////////////////////////////
        $html .= '<div class="sert"> <p style = "width:100%;font-size:14px;font-family: "Times New Roman">10. Pendidikan Non Formal       : </p></div>';
        ////////////////////////////////////////////////////AWAL TABEL KEDUA//////////////////////////////////////////////////////////////        
        $html .= '
        <table>
            <tbody>';

        foreach ($sertifikat as $v) {
            $SertTgl = isset($v['tgl_kadaluarsa']) ? $v['tgl_kadaluarsa'] : '';
            if ($SertTgl != '0000-00-00' && $SertTgl != null && $SertTgl != '') {
                $tgl = substr($SertTgl, 8, 2);
                $bln = substr($SertTgl, 5, 2);
                //  Ini memanggil fungsi dari Base.php
                //  Memanggil fungsi getBulan() untuk mencetak nama-nama bulan 
                $this->base = new Base();
                $bulan = $this->base->getBulan((int)$bln);
                $thn = substr($SertTgl, 0, 4);
                $tanggalKadaluarsa = $tgl . ' ' . $bulan . ' ' . $thn;
            } else {
                $tanggalKadaluarsa = '';
            }

            $html .= '
                <tr>
                   
                    <td style = "width:90%;font-size:14px;font-family: "Times New Roman">' . $v['sertifikat'] . '</td>  
                </tr>
                <tr>
                    <td style = "width:90%;font-size:14px;font-family: "Times New Roman">Nomor : ' . $v['nomor_sert'] . ', tanggal kadaluarsa ' . $tanggalKadaluarsa . '</td>            
                </tr>
                
                ';
        }
        $html .= '
            </tbody>
        </table><br>';
        ////////////////////////////////////////////////////AKHIR TABEL KEDUA////////////////////////////////////////////////////////////// 
        $html .= '<p style = "width:100%;font-size:14px;font-family: "Times New Roman">11. Penguasaan Bahasa  :  </p>';
        '';
        ////////////////////////////////////////////////////AWAL TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '
        <table>
            <tbody>';

        foreach ($bhs as $v) {
            $html .= '        
                <tr>
                    <td style = "width:120px;font-size:14px;font-family: "Times New Roman">Bahasa Indonesia</td> 
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman"> : </td>
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman">' . $v['nilai_bhs_indo'] . ',</td>    
                               
                </tr>
                <tr>
                    <td style = "width:120px;font-size:14px;font-family: "Times New Roman">Bahasa Inggris</td>
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman"> : </td>
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman">' . $v['nilai_bhs_inggris'] . ',</td> 
                </tr>     
                <tr>  
                    <td style = "width:120px;font-size:14px;font-family: "Times New Roman">Bahasa setempat</td>
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman"> : </td>    
                    <td style = "width:5px;font-size:14px;font-family: "Times New Roman">' . $v['nilai_bhs_setempat'] . '.</td> 
                </tr>
                ';
        }
        $html .= '<br>
            </tbody>
        </table>';
        ////////////////////////////////////////////////////AKHIR TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '<p style = "font-size:14px;font-family: "Times New Roman";>12. Pengalaman Kerja  :</p>';
        ////////////////////////////////////////////////////AWAL TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '
        <table>
            <tbody>';

        foreach ($proyekTAModel as $val) {

            $html .= '
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b>Tahun ' . $val['tahun'] . '   </b> </td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"></td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b></b></td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; text-align: justify;">a. Nama Kegiatan (Pekerjaan)</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; text-align: justify;">' . $val['pekerjaan'] . '</td>  
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman">b. Lokasi Kegiatan</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family: "Times New Roman";>' . $val['lokasi'] . '</td>         
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>c. Pengguna Jasa</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">' . $val['instansi'] . '</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>d. Nama Perusahaan</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">' . $val['perusahaan'] . '</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; float:top; text-align:top; padding: 0px;" >e. Uraian Tugas </td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                </tr>';

            $html .= '<tr>
                    <td class="uraian" colspan="4" style = "width:700px;font-size:14px;font-family:Times New Roman";>' . $val['uraiantugas'] . '<br></td>
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">f. Waktu Pelaksanaan</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">';

            $tglmulai = isset($val['mulai']) ? $val['mulai'] : '';
            if ($tglmulai != '0000-00-00' && $tglmulai != ''  && $tglmulai != null) {
                $tglmulai = substr($val['mulai'], 8, 2);
                $blnmulai = substr($val['mulai'], 5, 2);
                $thnmulai = substr($val['mulai'], 0, 4);
                $tanggalmulai = $tglmulai . '/' . $blnmulai . '/' . $thnmulai;
            } else {
                $tanggalmulai = '';
            }
            $html .= $tanggalmulai;
            $html .= ' - ';
            $tglselesai = isset($val['selesai']) ? $val['selesai'] : '';
            if ($tglselesai != '0000-00-00' && $tglselesai != null && $tglselesai != '') {
                $tglselesai = substr($val['selesai'], 8, 2);
                $blnselesai = substr($val['selesai'], 5, 2);
                $thnselesai = substr($val['selesai'], 0, 4);
                $tanggalselesai = $tglselesai . '/' . $blnselesai . '/' . $thnselesai;
            } else {
                $tanggalselesai = '';
            }
            $html .= $tanggalselesai;
            $html .= ' ';
            $html .= $val['inter'] . '</td>   
                </tr>
       
                <tr>
                    <td style = "width:40%;font-size:14px">g. Posisi Penugasan</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>  
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">' . $val['posisitugas'] . '</td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">h. Status Kepegawaian</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td> 
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">' . $val['status'] . '</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">i. Surat Referensi</td>
                    <td style = "width:5px;font-size:14px;font-family:Times New Roman">:</td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">' . $val['referensi'] . '</td>   
                </tr>';
        }
        $html .= '
            </tbody>
        </table>';
        /* ------------------------------------- Untuk mencegah pemotongan di tengah-tengah paragraf penutup, -------------------------*/
        /*------dipisah ke dalam satu section, kemudian memakai div dengan style="page-break-inside: avoid;--------------------------*/
        $html .= '
        <section>     
            <div style="page-break-inside: avoid;">';
        $html .=
            '
            <p style = "font-size:14px;font-family:Times New Roman">Pernyataan :</p>
            <ol style = "font-size:14px;font-family:Times New Roman">
                <li>Daftar riwayat hidup ini sesuai dengan kualifikasi dan pengalaman saya</li>
                <li style = "text-align: justify;">Saya akan melaksanakan penugasan sesuai dengan waktu yang telah dijadwalkan 
                    dalam proposal penawaran, kecuali terdapat permasalahan kesehatan yang mengakibatkan saya tidak bisa melaksanakan tugas</li>
                <li>Saya berjanji melaksanakan semua penugasan</li>
                <li>Saya bukan merupakan bagian dari tim yang menyusun Kerangka Acuan Kerja</li>
                <li>Saya akan memenuhi semua ketentuan Klausul 4 dan 5 pada IKP</li>
            </ol>
            <p style="text-align:justify;font-size:14px;font-family:Times New Roman">Jika terdapat pengungkapan keterangan yang tidak benar secara sengaja atau sepatutnya diduga 
            maka saya siap untuk digugurkan dari proses seleksi atau dikeluarkan jika sudah dipekerjakan.</p><br>

            <p class="Surabaya" style="font-size:14px; font-family:Times New Roman;">Surabaya, ' . $skrg . '</p>
            <div class="Mengetahui">
                <p style="font-size:14px; font-family:Times New Roman">Mengetahui,</p>
            </div>
            <div style="font-size:14px; font-family:Times New Roman"><p class="pernyataan">Yang membuat pernyataan</p></div>';
        $html .= '<img src="' . $imageku . '">';
        $html .= '
            <br>
            <br>
            <br>
            <div class="Pribadiyono">
                <p style="font-size:14px; font-family:Times New Roman">Pribadiyono Prof. Dr., Ir., MS.</p>

                <p class="name" style="font-size:14px; font-family:Times New Roman">' . $result['nama'] . '</p>
            </div><br>
            <p class="dir" style="font-size:14px; font-family:Times New Roman">Direktur</p>
        </section>';
        /* ------------------------------------- untuk mencegah pemotongan di tengah-tengah paragraf penutup-------------------------*/
        $html .= ' 
   
            </body>
            </html>
            ';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $canvas = $dompdf->getCanvas();
        $fontMetrics = new FontMetrics($canvas, $options);
        $w = $canvas->get_width();
        $h = $canvas->get_height();
        $font = $fontMetrics->getFont('times');
        $text = 'Quantum';
        $txtHeight = $fontMetrics->getFontHeight($font, 75);
        $txtWidth = $fontMetrics->getTextWidth($text, $font, 75);
        $canvas->set_opacity(.2);
        $x = (($w - $txtWidth) / 2);
        $y = (($w - $txtHeight) / 3);
        $canvas->text($x, $y, $text, $font, 75, array(255, 0, 0), '', '', 20);


        //  Mencetak nomor halaman (awal)
        //  https://stackoverflow.com/questions/52818205/dompdf-how-to-add-page-number
        $x          = 505;
        $y          = 810;
        $text       = "Halaman {PAGE_NUM}";
        $font       = $dompdf->getFontMetrics()->getfont('Helvetica', 'normal');
        $size       = 9;
        $color      = array(0, 0, 0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;
        $dompdf->getCanvas()->page_text(
            $x,
            $y,
            $text,
            $font,
            $size,
            $color,
            $word_space,
            $char_space,
            $angle
        );
        //  Mencetak nomor halaman  (akhir)

        $dompdf->stream($result['nama'], array("Attachment" => false));
    }
   
    /*  Mencetak semua intermitten (REKAP & DETIL) yang terpilih pada check box     */
    public function intermitten_detil()
    {
        //dd($_GET['intmt']);
        if (isset($_GET['intmt'])) {
   
            if (!empty($this->request->getVar('ckval'))) {
                //dd($this->request->getVar('ckval'));
                $check = $this->request->getVar('ckval');
               // $this->base = new Base();
               $pengalaman = array();
               $n=0;
                //  Untuk semua tenaga ahli
                foreach ($check as $brs) {
                    $result = $this->rhModel->getCVwithKode($brs);
                    // Cetak detil pengalaman
                    
                    $pengalaman[$n] = $this->proyekTAModel->getIntermitten($brs);
                    $n++;
                   //dd($pengalaman);
                }
              //  dd($pengalaman);
                $data = ['pengalaman' => $pengalaman, 'judul' => 'Total Intermitten (Detil) Tenaga Ahli'];
                return view('imt2/intermitten', $data);
            } else {
                echo '<script type="text/javascript">';
                echo ' alert("Pilih minimal satu kotak check box")';  //not showing an alert box.
                echo '</script>';
                return redirect()->to(base_url('/imt2'))->with('gagal-semua-intermitten', 'Pilih minimal satu kotak check box');
            }
        }
    }
}
