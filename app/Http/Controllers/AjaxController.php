<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class AjaxController extends Controller
{
  public function queue()
  {
    try {
      $mnow = date('Y-m-d H:i:s');
      Artisan::call('queue:work --stop-when-empty');
      Log::info('queue berhasil dijalankan pada waktu : ' . $mnow . ' dari controller.');
      $status = true;
    } catch (\Throwable $th) {
      $status = false;
    }
    $alert = [
      'status' => $status
    ];
    return response()->json($alert);
  }
}
