<?php

namespace App\Http\Controllers\Student;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Xu42\Qznjw2014\Qznjw2014;

class PasswordController extends BaseController
{
    public function reset( Request $request )
    {
        $userId = $request->input( 'userId', null );
        $idCard = $request->header( 'idCard', null );

        $modelStudent = (new \App\Library\Student)->getById( $userId );

        $eduSystem = new Qznjw2014( $modelStudent->username, $modelStudent->password );

        $result = $eduSystem->passwordReset( $modelStudent->username, $idCard );

        if ( $result ) {
            return response()->json( ['message' => 'Success, Password is the last six digits of the idCard'], 200 );
        } else {
            return response()->json( ['message' => 'Error, Wrong parameters'], 403 );
        }
    }

    public function update( Request $request )
    {
        $userId = $request->input( 'userId', null );
        $new    = $request->header( 'new', '123456' );

        $modelStudent = (new \App\Library\Student)->getById( $userId );

        $eduSystem = new Qznjw2014( $modelStudent->username, $modelStudent->password );

        if ( !$eduSystem->isValid() ) {
            return response()->json( ['message' => 'Error, Wrong parameters, username or password'], 403 );
        }

        $result = $eduSystem->passwordUpdate( $modelStudent->password, $new );

        $libraryStudent = new \App\Library\Student;
        $libraryStudent->setPassword( $userId, $new );

        if ( $result ) {
            return response()->json( ['message' => 'Success, Password is the given or 123456'], 200 );
        } else {
            return response()->json( ['message' => 'Error, Wrong parameters'], 403 );
        }
    }

}
