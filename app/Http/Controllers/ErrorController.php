<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function not_found(){
        return '404: Halaman tidak ditemukan.';
    }
}
