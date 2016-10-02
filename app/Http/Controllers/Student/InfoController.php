<?php

namespace App\Http\Controllers\Student;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class InfoController extends BaseController
{
    public function index( Request $request )
    {
        return ['oo'];
    }

}
