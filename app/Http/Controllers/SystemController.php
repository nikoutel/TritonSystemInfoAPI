<?php

namespace App\Http\Controllers;

use App\CPU;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function cpuRoot(CPU $CPU) {
        $CPU->init('getRoot');
        return new Response($CPU);
    }

    public function cpuInfo(CPU $CPU) {
        $CPU->init('getInfo');
        return new Response($CPU);
    }

    public function cpuLoad(CPU $CPU) {
        $CPU->init('getLoad');
        return new Response($CPU);
    }

}

