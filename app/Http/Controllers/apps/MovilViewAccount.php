<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovilViewAccount extends Controller
{
  public function index()
  {
    return view('content.apps.app-Movil-view-account');
  }
}
