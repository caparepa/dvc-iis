<?php

namespace App\Http\Controllers\Viaticos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ViaticosController extends Controller
{
    public function __construct() { 
        $this->middleware('auth');
        $user = Auth::user();
        view()->share('section', 'dashboard');
        view()->share('sessionUser', $user);
    }
}
