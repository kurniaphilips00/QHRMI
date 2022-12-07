<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\rhModel;
use App\Models\posisiModel;

use App\Models\expModel;
use App\Models\sertModel;
use App\Models\bhsModel;

use Dompdf\Dompdf;

class PrintController extends BaseController
{

    protected $rhModel;
    protected $posisiModel;
    protected $expModel;
    protected $sertModel;
    protected $bhsModel;
    
    public function __construct()
    {
        $rh = $this->rhModel = new rhModel();    
        $posisi = $this->posisiModel = new posisiModel();      
        $expModel = $this->expModel = new expModel();    
        $sertModel = $this->sertModel = new sertModel();    
        $bhsModel = $this->bhsModel = new bhsModel();   
    }
    
    public function cetak($id = null)
    {            
       
        $dompdf = new Dompdf();
        $result=$this->rhModel->getCV($id);
        $pengalaman=$this->expModel->getLaporan($id);
        $sertifikat=$this->sertModel->getLaporan($id);
        $skrg = date('d-M-Y');
        if ($result['tgl'] != '0000-00-00') {
            $tgl = substr($result['tgl'],8,2);
            $bln = substr($result['tgl'],5,2);
            $thn = substr($result['tgl'],0,4);
            $tanggal=$tgl.'/'. $bln.'/'.$thn;
        }
        else {
            $tanggal = '';
        } 
      //  dd($tanggal);
        $bahasa=$this->bhsModel->getLaporan($id);     
        $html='
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>DAFTAR RIWAYAT HIDUP</title>         
        </head>';
        $html .= '
        <style>
          
            @page { margin: 100px 50px 30px; }
            #header { position: fixed; left: 0px; top: -70px; right: 0px; height: 50px; background-color: green; text-align: center; color: white}
            #footer { font-size:10px; position: fixed; left: 0px; bottom: 0px; right: -10px; height: 50px; }
            #footer .page:after { content: counter(page, upper); }
            div .sert {
                word-wrap: break-word;
            .thn {  background-color:#9dfc03" }
            .one { text-indent: -10.5em; }
            .a { text-indent: 32em; }
            .s { text-indent: 32em; }
            .name { text-indent: 32em; }
            .two { width: 50em; max-width: 100%; }
            .two p { display: inline-block; max-width: 90%; }
            .two p:nth-child(1) { float:left; }
            .two p:nth-child(2) { float:right; }

           
            .sby { width: 35em; max-width: 100%; }
            .sby p { display: inline-block; max-width: 100%; }
            .sby p:nth-child(1) { float:left; }
            .sby p:nth-child(2) { float:right; }

        </style>
        <body>';
        $html .= '<div id="header">
                    <h3>DAFTAR RIWAYAT HIDUP</h3>
                </div>';
   
        ////////////////////////////////////////////////////AWAL TABEL PERTAMA//////////////////////////////////////////////////////////////         
        $html .= '
        <table>
            <tbody>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">1. Posisi yang diusulkan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['posisi'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">2. Nama perusahaan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['perusahaan'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">3. Nama personil</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['nama'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">4. Tempat lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['kota'].'</td>                    
                </tr>
                
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">5. Tanggal lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$tanggal.'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">6. No. NPWP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['no_npwp'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">7. No. Telp.</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['no_telp'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">8. No. HP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['no_hp'].'</td>                    
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
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS1'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman", Times, serif;">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman", Times, serif;">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman", Times, serif;">'.$result['s1_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s1_thn'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:100%;font-size:14px;font-family: "Times New Roman"><b>'.'S2 :'.'</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS2'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s2_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s2_thn'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman"><b>'.'S3 :'.'</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS3'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s3_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s3_thn'].'</td>                    
                </tr>
            </tbody>
        </table> <br>';
        ////////////////////////////////////////////////////AKHIR TABEL PERTAMA//////////////////////////////////////////////////////////////
        $html .= '<div class="sert"> <p style = "width:100%;font-size:14px;font-family: "Times New Roman">10. Pendidikan Non Formal       : </p></div>';
        ////////////////////////////////////////////////////AWAL TABEL KEDUA//////////////////////////////////////////////////////////////        
        $html .= '
        <table>
            <tbody>';
            foreach ( $sertifikat as $v ) {
                $html .= '
                <tr>
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">-</td>
                    <td style = "width:90%;font-size:14px;font-family: "Times New Roman">' .$v->sertifikat. '</td>
                </tr>';
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
            foreach ( $bahasa as $v ) {
                $html .= '        
                <tr>
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">-</td>  
                    <td style = "width:25%;font-size:14px;font-family: "Times New Roman">Bahasa ' .$v->bahasa. '</td>    
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">:</td>    
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">'.$v->nilai.'</td>          
                </tr>';
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
            foreach ( $pengalaman as $val ) {
                $html .= '
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b>Tahun '.$val['tahun'].'   </b> </td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b></b></td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; text-align: justify;">a. Nama Kegiatan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; text-align: justify;">'.$val['kegiatan'].'</td>  
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman">b. Lokasi Kegiatan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family: "Times New Roman";>'.$val['lokasi'].'</td>         
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>c. Pengguna Jasa</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['pengguna'].'</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>d. Nama Perusahaan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['pers'].'</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; float:top; text-align:top; padding: 0px;" >e. Uraian Tugas </td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                </tr>
                <tr>
                    <td class="uraian" colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman";>'.$val['uraian'].'<br></td>
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">f. Waktu Pelaksanaan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">';
                    
                    if ($val['mulai'] != '0000-00-00') {
                        $tglmulai = substr($val['mulai'],8,2);
                        $blnmulai = substr($val['mulai'],5,2);
                        $thnmulai = substr($val['mulai'],0,4);
                        $tanggalmulai=$tglmulai.'/'. $blnmulai.'/'.$thnmulai;
                    }
                    else {
                        $tanggalmulai = '';
                    } 
                    $html .=$tanggalmulai;   
                    $html .=' - ';                    
                    if ($val['selesai'] != '0000-00-00' && $val['selesai'] != null) {
                        $tglselesai = substr($val['selesai'],8,2);
                        $blnselesai = substr($val['selesai'],5,2);
                        $thnselesai = substr($val['selesai'],0,4);
                        $tanggalselesai=$tglselesai.'/'. $blnselesai.'/'.$thnselesai;
                    }
                    else {
                        $tanggalselesai = '';
                    } 
                    $html .=$tanggalselesai;
                    $html .=' ';
                    $html .=$val['inter'].'</td>   
                </tr>
       
                <tr>
                    <td style = "width:40%;font-size:14px">g. Posisi Penugasan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>  
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['posisitugas'].'</td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">h. Status Kepegawaian</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td> 
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['statuse'].'</td>   
                </tr>

                <tr>
                    <td style = "width:40%;font-size:14px">i. Surat Referensi</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['referensi'].'</td>   
                </tr>';
            }
            $html .= '
            </tbody>
        </table>';
        ////////////////////////////////////////////////////AKHIR TABEL KETIGA//////////////////////////////////////////////////////////////
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
            maka saya siap untuk digugurkan dari proses seleksi atau dikeluarkan jika sudah dipekerjakan.</p>

            
            <div class="sby">
                <p style="font-size:14px; font-family:Times New Roman">Mengetahui,</p>
                
            </div>
            <br><br>
            <div style="font-size:14px; font-family:Times New Roman">
               <br>
               PT. Quantum HRM Internasional
            </div>
            <div style="font-size:14px; font-family:Times New Roman">
                    <p class="s" style="font-size:14px; font-family:Times New Roman">Surabaya, '.$skrg.'</p>
                    <p class="a">Yang membuat pernyataan</p>
            </div>

            <br>

            <div class="two">
                <p style="font-size:14px; font-family:Times New Roman">Prof. Dr. Pribadiyono Ir., MS.</p>
                
            </div><br>
            <p class="one" style="font-size:14px; font-family:Times New Roman">Direktur</p>
            <p class="name" style="font-size:14px; font-family:Times New Roman">'.$result['nama'].'.'.'</p>
         

            <div id="footer">
            <bold> <pre>
                <p  class="page">Copyright &copy; 2022 by PT. Quantum HRMI                                                                          hal.<?php $PAGE_NUM ?></p>
                </pre>
            </div>
        
            </body>
            </html>
            ';
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream($result['nama'],array("Attachment"=>false));
    }

    public function cetaklaporanIntermitten($id = null) {
        $dompdf = new Dompdf();
        $pengalaman=$this->expModel->getLaporan($id);
        $html='
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>DAFTAR RIWAYAT HIDUP</title>         
        </head>';
        $html .= '
            <div class="container-fluid px-4">
                <center>
                    <h3 class="mt-4">Pengalaman Tenaga Ahli</h3>
                <center>
                <div class="card mb-4">
                    <div class="card-body">
                        <table style="border: 1px solid;">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 10%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 5%;">
                                                      
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">No.</th>
                                        <th scope="col" style = "width:20%; text-align:center; border: 1px solid;">Tenaga Ahli</th> 
                                        <th scope="col" style = "width:10%; text-align:center; border: 1px solid;">Jabatan</th> 
                                        <th scope="col" style = "width:30%; text-align:center; border: 1px solid;">Kegiatan</th>
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Thn</th>    
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Durasi</th>        
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Bln</th>  
                                    </tr>
                                </thead>';
                            $html .= '<tbody>';
                                $i = 1; 
                                $totbln = 0;
                                foreach ( $pengalaman as $v ) {
                                    $html .= '
                                    <tr>
                                        <td style = "widht:5%; text-align:center; border: 1px solid;">'.$i.'</td>
                                        <td style = "width:20%; border: 1px solid;">'.$v['nama_ta'].'</td>  
                                        <td style = "width:10%; border: 1px solid;">'.$v['posisitugas'].'</td> 
                                        <td style = "width:30%; border: 1px solid;">'.$v['kegiatan'].'</td>   
                                        <td style = "width:5%; text-align:center; border: 1px solid;">'.$v['tahun'].'</td>   
                                        <td style = "width:5%; border: 1px solid;">'.$v['inter'].'</td>   
                                        <td style = "width:5%; text-align:center; border: 1px solid;">'.$v['jml_bln'].'</td>
                                    </tr>';     
                                    $totbln += $v['jml_bln'];
                                    $i++;
                                }
                            $html .= '</tbody>
                        </table>';
                        $html .= '
                        </div><!--"card-body"-->
                            <div class="card-footer">
                                <bold>
                                <P style = "text-align : right; margin-right: 50px; background-color: #0c486e; 
                                width : 100%; color: white; font-weight: bold;">   Total pengalaman  '; 
                                $html .= $totbln; 
                                $html .= '  bulan';
                                $JmlThn = floor($totbln / 12);
                                if ($JmlThn > 0) {
                                    $html .= ' = ';
                                    $sisabln = $totbln % 12;
                                    $html .= $JmlThn;
                                    $html .= ' tahun ';
                                    $html .= $sisabln;
                                    $html .= ' bulan';
                                }
                                $html .= '
                                </p>
                                <bold>
                            </div>
                        </div>
            </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($pengalaman[0]['nama_ta'],array("Attachment"=>false));
    }
    public function cetak2($id = null)
    {        
        $dompdf = new Dompdf();
        $result=$this->rhModel->getCV($id);
        $pengalaman=$this->expModel->getLaporan($id);
        $sertifikat=$this->sertModel->getLaporan($id);
        $skrg = date('d-M-Y');
        if ($result['tgl'] != '0000-00-00') {
            $tgl = substr($result['tgl'],8,2);
            $bln = substr($result['tgl'],5,2);
            $thn = substr($result['tgl'],0,4);
            $tanggal=$tgl.'/'. $bln.'/'.$thn;
        }
        else {
            $tanggal = '';
        } 
       
        $bahasa=$this->bhsModel->getLaporan($id);     
        $html='
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>DAFTAR RIWAYAT HIDUP</title>         
        </head>';
        $html .= '
        <style>
          
            @page { margin: 100px 50px 30px; }
            #header { position: fixed; left: 0px; top: -70px; right: 0px; height: 50px; background-color: green; text-align: center; color: white}
            #footer { font-size:10px; position: fixed; left: 0px; bottom: 0px; right: -10px; height: 50px; }
            #footer .page:after { content: counter(page, upper); }
            div .sert {
                word-wrap: break-word;
       
            .thn {  background-color:#9dfc03" }
            .one { text-indent: -10.5em; }
            .a { text-indent: 32em; }
            .s { text-indent: 32em; }
            .name { text-indent: 32em; }
            .two { width: 50em; max-width: 100%; }
            .two p { display: inline-block; max-width: 90%; }
            .two p:nth-child(1) { float:left; }
            .two p:nth-child(2) { float:right; }
            .sby { width: 35em; max-width: 100%; }
            .sby p { display: inline-block; max-width: 100%; }
            .sby p:nth-child(1) { float:left; }
            .sby p:nth-child(2) { float:right; }

        </style>
        <body>';
        $html .= '<div id="header">
                    <h3>DAFTAR RIWAYAT HIDUP</h3>
                </div>';
   
        ////////////////////////////////////////////////////AWAL TABEL PERTAMA//////////////////////////////////////////////////////////////         
        $html .= '
        <table>
            <tbody>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">1. Posisi yang diusulkan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['posisi'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">2. Nama perusahaan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['perusahaan'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">3. Nama personil</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['nama'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">4. Tempat lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['kota'].'</td>                    
                </tr>
                
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">5. Tanggal lahir</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$tanggal.'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">6. No. NPWP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['no_npwp'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">7. No. Telp./HP</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['no_telp'].'</td>                    
                </tr>
           ';
      
        $html .= '<p colspan="3" style = "width:100%;font-size:14px;font-family: "Times New Roman">8. Pendidikan Formal       : </p>';
       
        $html .= '
       
                <tr>
                   <td style = "width:20%;font-size:14px;font-family: "Times New Roman"><b>S1 :</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS1'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman", Times, serif;">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman", Times, serif;">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman", Times, serif;">'.$result['s1_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s1_thn'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:100%;font-size:14px;font-family: "Times New Roman"><b>'.'S2 :'.'</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS2'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s2_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s2_thn'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman"><b>'.'S3 :'.'</b></td>
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Jurusan</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['ijazahS3'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Universitas</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s3_univ'].'</td>                    
                </tr>
                <tr>
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">Tahun lulus</td>
                    <td style = "width:1%;font-size:14px;font-family: "Times New Roman">:</td>
                    <td style = "width:75%;font-size:14px;font-family: "Times New Roman">'.$result['s3_thn'].'</td>                    
                </tr>
            </tbody>
        </table> <br>';
        ////////////////////////////////////////////////////AKHIR TABEL PERTAMA//////////////////////////////////////////////////////////////
        $html .= '<div class="sert"> <p style = "width:100%;font-size:14px;font-family: "Times New Roman">9. Pendidikan Non Formal       : </p></div>';
        ////////////////////////////////////////////////////AWAL TABEL KEDUA//////////////////////////////////////////////////////////////        
        $html .= '
        <table>
            <tbody>';
            foreach ( $sertifikat as $v ) {
                $html .= '
                <tr>
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">-</td>
                    <td style = "width:90%;font-size:14px;font-family: "Times New Roman">' .$v->sertifikat. '</td>
                </tr>';
            }
            $html .= '
            </tbody>
        </table><br>';
        ////////////////////////////////////////////////////AKHIR TABEL KEDUA////////////////////////////////////////////////////////////// 
        $html .= '<p style = "width:100%;font-size:14px;font-family: "Times New Roman">10. Penguasaan Bahasa  :  </p>';
        '';
        ////////////////////////////////////////////////////AWAL TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '
        <table>
            <tbody>';
            foreach ( $bahasa as $v ) {
                $html .= '        
                <tr>
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">-</td>  
                    <td style = "width:25%;font-size:14px;font-family: "Times New Roman">Bahasa ' .$v->bahasa. '</td>    
                    <td style = "width:2%;font-size:14px;font-family: "Times New Roman">:</td>    
                    <td style = "width:20%;font-size:14px;font-family: "Times New Roman">'.$v->nilai.'</td>          
                </tr>';
            }
            $html .= '<br>
            </tbody>
        </table>';
        ////////////////////////////////////////////////////AKHIR TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '<p style = "font-size:14px;font-family: "Times New Roman";>11. Pengalaman Kerja  :</p>';
        ////////////////////////////////////////////////////AWAL TABEL KETIGA////////////////////////////////////////////////////////////// 
        $html .= '
        <table>
            <tbody>';
            foreach ( $pengalaman as $val ) {
                $html .= '
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b>Tahun '.$val['tahun'].'   </b> </td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; background-color: lightblue; line-height: 9px;"> <br> <b></b></td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; text-align: justify;">a. Nama Kegiatan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman; text-align: justify;">'.$val['kegiatan'].'</td>  
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman">b. Lokasi Kegiatan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family: "Times New Roman";>'.$val['lokasi'].'</td>         
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>c. Pengguna Jasa</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['pengguna'].'</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman";>d. Nama Perusahaan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['pers'].'</td>   
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px;font-family:Times New Roman; float:top; text-align:top; padding: 0px;" >e. Uraian Tugas </td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                </tr>
                <tr>
                    <td class="uraian" colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman";>'.$val['uraian'].'<br></td>
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">f. Waktu Pelaksanaan </td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">';
                    
                    if ($val['mulai'] != '0000-00-00') {
                        $tglmulai = substr($val['mulai'],8,2);
                        $blnmulai = substr($val['mulai'],5,2);
                        $thnmulai = substr($val['mulai'],0,4);
                        $tanggalmulai=$tglmulai.'/'. $blnmulai.'/'.$thnmulai;
                    }
                    else {
                        $tanggalmulai = '';
                    } 
                    $html .=$tanggalmulai;   
                    $html .=' - ';
                     
                    if ($val['selesai'] != '0000-00-00') {
                        $tglselesai = substr($val['selesai'],8,2);
                        $blnselesai = substr($val['selesai'],5,2);
                        $thnselesai = substr($val['selesai'],0,4);
                        $tanggalselesai=$tglselesai.'/'. $blnselesai.'/'.$thnselesai;
                    }
                    else {
                        $tanggalselesai = '';
                    } 

                    $html .=$tanggalselesai;
                    $html .=' ';
                    $html .=$val['inter'].'</td>   
                    
                </tr>
        
                <tr>
                    <td style = "width:40%;font-size:14px">g. Posisi Penugasan</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>  
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['posisitugas'].'</td>               
                </tr>
                <tr>
                    <td style = "width:40%;font-size:14px">h. Status Kepegawaian</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td> 
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['statuse'].'</td>   
                </tr>

                <tr>
                    <td style = "width:40%;font-size:14px">i. Surat Referensi</td>
                    <td style = "width:3%;font-size:14px;font-family:Times New Roman"> : </td>
                    <td colspan="3" style = "width:100%;font-size:14px;font-family:Times New Roman">'.$val['referensi'].'</td>   
                </tr>';
    
            }
            $html .= '
            </tbody>
        </table>';
        ////////////////////////////////////////////////////AKHIR TABEL KETIGA//////////////////////////////////////////////////////////////
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
            maka saya siap untuk digugurkan dari proses seleksi atau dikeluarkan jika sudah dipekerjakan.</p>

            
            <div class="sby">
                <p style="font-size:14px; font-family:Times New Roman">Mengetahui,</p>
                
            </div>
            <br><br>
            <div style="font-size:14px; font-family:Times New Roman">
               <br>
               PT. Quantum HRM Internasional
            </div>
            <div style="font-size:14px; font-family:Times New Roman">
                    <p class="s" style="font-size:14px; font-family:Times New Roman">Surabaya, '.$skrg.'</p>
                    <p class="a">Yang membuat pernyataan</p>
            </div>

            <br>

            <div class="two">
                <p style="font-size:14px; font-family:Times New Roman">Prof. Dr. Pribadiyono Ir., MS.</p>
                
            </div><br>
            <p class="one" style="font-size:14px; font-family:Times New Roman">Direktur</p>
            <p class="name" style="font-size:14px; font-family:Times New Roman">'.$result['nama'].'.'.'</p>
         

            <div id="footer">
            <bold> <pre>
                <p  class="page">Copyright &copy; 2022 by PT. Quantum HRMI                                                                          hal.<?php $PAGE_NUM ?></p>
                </pre>
            </div>
        
            </body>
            </html>
            ';
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream($result['nama']);
    }
}
?>   