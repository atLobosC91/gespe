<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/header') . view('index') . view('home/footer');
    }

    public function about_us()
    {
        return view('home/header') . view('home/about_us') . view('home/footer');
    }

    public function services()
    {
        return view('home/header') . view('home/services') . view('home/footer');
    }

    public function project()
    {
        return view('home/header') . view('home/project') . view('home/footer');
    }

    public function detalle_proyecto()
    {
        return view('home/header') . view('home/proyecto/detalle_proyecto') . view('home/footer');
    }
}
