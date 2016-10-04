<?php

namespace App\Http\Controllers;

class DeployController extends Controller
{
    public function github()
    {
        $target = base_path( '/deploy.sh' );
        $result = [];

        exec( "sh $target", $result, $ret );

        return $result;
    }
}
