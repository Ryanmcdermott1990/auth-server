<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ClientController extends Controller
{
   public function listClients(Request $request) {
   $clients = Http::get('http://auth-server.test/oauth/clients');
   dd($clients);
   }
}
