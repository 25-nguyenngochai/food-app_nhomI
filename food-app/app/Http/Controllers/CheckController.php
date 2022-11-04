<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //
    function checkUserType()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type === 'user') {
                return redirect('index');
            }
            if (Auth::user()->user_type === 'admin') {
                return redirect('admin-index');
            }
        }
    }
}
