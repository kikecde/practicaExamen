<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoTraslado extends Controller
{
  public function index()
  {
    return view('content.apps.pedido-traslado');
  }
}
