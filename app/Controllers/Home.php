<?php

namespace App\Controllers;
use App\Models\rhModel;
use App\Models\proyekModel;
class Home extends BaseController
{
    protected $rhModel;
    protected $proyekModel;
    public function __construct()
    {
        $prj = $this->proyekModel = new proyekModel();
    }
    public function index()
    {
       
        $proyek = $this->proyekModel->getProyek();
        return view('dashboard/dashb', ['proyek' => $proyek]);
       // return view('welcome_message');
    }
}
