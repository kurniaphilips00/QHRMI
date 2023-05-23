<?php

namespace App\Controllers;

use App\Models\proyekTAModel;
use Dompdf\Dompdf;

class Base extends BaseController
{

    protected $proyekTAModel;
    protected $base;
    public function __construct()
    {

        $proyekTA = $this->proyekTAModel = new proyekTAModel();
    }
    public function  getBulan($bln)
    {
        switch ($bln) {
            case  1:
                return  "Januari";
                break;
            case  2:
                return  "Februari";
                break;
            case  3:
                return  "Maret";
                break;
            case  4:
                return  "April";
                break;
            case  5:
                return  "Mei";
                break;
            case  6:
                return  "Juni";
                break;
            case  7:
                return  "Juli";
                break;
            case  8:
                return  "Agustus";
                break;
            case  9:
                return  "September";
                break;
            case  10:
                return  "Oktober";
                break;
            case  11:
                return  "November";
                break;
            case  12:
                return  "Desember";
                break;
        }
    }
    public function hitung_intermitten($tg1, $tg2)
    {
        $inter = "( ";
        $diff = strtotime($tg2) - strtotime($tg1);
        $days = abs(round($diff / 86400));
        if ($days > 30) {
            $months = floor($days / 30);
            $inter .= $months;
            $inter .= " bulan ";
            $hari = fmod($days, 30);
            $inter .= $hari;
            $inter .= " hari ";
        } else {
            $inter .= $days;
            $inter .= " hari ";
        }
        $inter .= " )";
        return $inter;
    }

    public function base64( $img_path = false, $img_type = 'png' ){
        if( $img_path ){
           // dd($img_path);
            //convert image into Binary data
            $img_data = fopen ( $img_path, 'rb' );
            $img_size = filesize ( $img_path );
            $binary_image = fread ( $img_data, $img_size );
            fclose ( $img_data );
    
            //Build the src string to place inside your img tag
            $img_src = "data:image/".$img_type.";base64,".str_replace ("\n", "", base64_encode($binary_image));
    
            return $img_src;
        }
    
        return false;
    }
    public function hitung_bulan($tg1, $tg2)
    {
        //let awal = document.getElementById('tgl_awal').value;

        $tglawal = strtotime($tg1);
        $tglakhir = strtotime($tg2);
        //     $tglawal = date_create($tg1);
        //     $tglakhir = date_create($tg2);
        $diff = abs($tglakhir - $tglawal);
        $years = floor($diff / (365 * 60 * 60 * 24));
        // To get the month, subtract it with years and
        // divide the resultant date into
        // total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        return  $months;
    }
    function printIntermitten($kode = null)
    {
        $dompdf = new Dompdf();
        $pengalaman = $this->proyekTAModel->getIntermitten($kode);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Daftar Pengalaman Tenaga Ahli</title>         
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
                                        
                                        <th scope="col" style = "width:30%; text-align:center; border: 1px solid;">Kegiatan</th>
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Thn</th>    
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Durasi</th>        
                                        <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Bln</th>  
                                    </tr>
                                </thead>';
        $html .= '<tbody>';
        $i = 1;
        $totbln = 0;
        foreach ($pengalaman as $v) {
            $html .= '
                    <tr>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $i . '</td>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $v['nama'] . '</td>
                        <td style = "width:30%; border: 1px solid;">' . $v['pekerjaan'] . '</td>   
                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['tahun'] . '</td>   
                        <td style = "width:5%; border: 1px solid;">' . $v['inter'] . '</td>   
                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['jml_bln'] . '</td>
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
        $dompdf->stream($pengalaman[0]['nama'], array("Attachment" => false));
    }
/*
   
    function cetakIntermitten($kode = null)
    {
        $dompdf = new Dompdf();
//$pengalaman = $this->proyekTAModel->getIntermitten($kode);
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Daftar Pengalaman Tenaga Ahli</title>         
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
                                
                                <th scope="col" style = "width:30%; text-align:center; border: 1px solid;">Kegiatan</th>
                                <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Thn</th>    
                                <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Durasi</th>        
                                <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Bln</th>  
                            </tr>
                        </thead>';
        $html .= '<tbody>';
        foreach($kode as $brs) {
            $pengalaman = $this->proyekTAModel->getIntermitten($brs);
            $i = 1;
            $totbln = 0;
            foreach ($pengalaman as $v) {
                $html .= '
                    <tr>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $i . '</td>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $v['nama'] . '</td>
                        <td style = "width:30%; border: 1px solid;">' . $v['pekerjaan'] . '</td>   
                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['tahun'] . '</td>   
                        <td style = "width:5%; border: 1px solid;">' . $v['inter'] . '</td>   
                        <td style = "width:5%; text-align:center; border: 1px solid;">' . $v['jml_bln'] . '</td>
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
            $JmlThn = 0;
            $totbln = 0;
            $sisabln = 0;
            $html .= '
                                    </p>
                                    <bold>
                                </div>
                            </div>
                </div>';
        }
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($pengalaman['nama'], array("Attachment" => false));
    }*/

//NewPrintIntermitten
    function NewPrintIntermitten($kode = null) {
        $dompdf = new Dompdf();
        $html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Daftar Pengalaman Tenaga Ahli</title>         
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
                                  
                                <th scope="col" style = "width:5%; text-align:center; border: 1px solid;">Bln</th>  
                            </tr>
                        </thead>';
                $html .= '<tbody>';
                foreach($kode as $brs) {
                    $i = 1;
                    $pengalaman = $this->proyekTAModel->getIntermitten($brs);
                    //$nama = $pengalaman['nama'];
                    $nama = $pengalaman[0]['nama'];
                    $this->base = new Base();
                    $totbln = $this->base->HitungTotalPengalaman($pengalaman);
                    if ($totbln > 0) {
                        $JmlThn = floor($totbln / 12);
                        if ($JmlThn > 0) {
                            $html .= ' = ';
                            $sisabln = $totbln % 12;
                        }
                    }
                    else {
                        
                    }
                    $html .= '
                    <tr>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $i . '</td>
                        <td style = "widht:5%; text-align:center; border: 1px solid;">' . $nama . '</td>
                        <td style = "width:5%; border: 1px solid;">' . $totbln . '</td>
                    </tr>';
                    $html .= '</tbody>
                            </table>
                    </div>
                </div>
            </div>';
           
                
                }
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($pengalaman[0]['nama'], array("Attachment" => false));

    }

    function HitungTotalPengalaman($kode) {
        $totbln = 0;
       
        $pengalaman = $this->proyekTAModel->getPengalaman($kode);
     
        foreach ($pengalaman as $v) {
            $totbln += $v['jml_bln'];
        }
      //  dd($totbln);
        return $totbln;
    }
}
