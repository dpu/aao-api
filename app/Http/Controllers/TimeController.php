<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TimeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function get( Request $request )
    {
        return response()->json( [
            'message' => 'Success',
            'time'    => time()
        ] )->setCallback( $request->input( 'callback' ) );
    }
}
