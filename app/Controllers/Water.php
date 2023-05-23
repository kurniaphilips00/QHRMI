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

class Water extends BaseController
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
        return view('water/index', $data);
    }
}