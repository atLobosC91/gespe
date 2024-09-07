<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('gespe/incluir/header_app') . view('gespe/administrador.php') . view('gespe/incluir/footer_app');
    }
}
