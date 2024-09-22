<?php

namespace App\Controllers;

class Gespe extends BaseController
{
    public function gerente()
    {
        return view('gespe/gerente');
    }

    public function administrador()
    {
        return view('gespe/administrador');
    }

    public function supervisor()
    {
        return view('gespe/supervisor');
    }

    public function operativo()
    {
        return view('gespe/operativo');
    }
}
