<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaloController extends Controller
{
    // public function index()
    // {
    //     return '<h1>Halo dari controller</h1>';
    // }

    public function coba(){

    $nama = "pazel";
    $data = ['nama' => $nama];
    return view('coba.halo',$data);
    }
}

