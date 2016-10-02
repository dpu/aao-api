<?php

namespace App\Http\Controllers\Student;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Xu42\Qznjw2014\Qznjw2014;

class ExamInfoController extends BaseController
{
    public function get( Request $request )
    {
        $userId   = $request->input( 'userId', null );
        $semester = $request->header( 'semester', null );

        if ( is_null( $semester ) ) {
            return response()->json( ['message' => 'Error, Missing parameters'], 404 );
        }

        $modelStudent = (new \App\Library\Student)->getById( $userId );

        $eduSystem = new Qznjw2014( $modelStudent->username, $modelStudent->password );

        return response()->json( ['message' => 'Success', 'data' => $eduSystem->examsinfo( $semester )], 200 );
    }

}
