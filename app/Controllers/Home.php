<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/header') . 
                view('index') . 
                view('home/footer');
    }

    public function about_us()
    {
        return view('home/header') . 
                view('home/about_us') . 
                view('home/footer');
    }

    public function service_project()
    {
        return view('home/header') . 
                view('home/service_project') . 
                view('home/footer');
    }

    public function project()
    {
        return view('home/header') . 
                view('home/project') . 
                view('home/footer');
    }

    public function project_detail()
    {
        return view('home/header') . 
                view('home/project/project_detail') . 
                view('home/footer');
    }
}
