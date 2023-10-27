<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OTPreview extends Controller
{
  public function index()
  {
    return view('content.apps.app-ot-preview');
  }
}
