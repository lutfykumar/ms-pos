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
  public function scrap()
  {
    $data = [];
    try {
      $data = $this->engine_scrap('shopee');
    } catch (\Throwable $th) {
      dd('gagal');
    }
    dd($data);
    return 'DONE';
  }

  private function engine_scrap($platform = 'shopee')
  {
    // $client = new \GuzzleHttp\Client();
    // $client->setDefaultOption('user-agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36');
    // $request = $client->get('https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=xiaomi&limit=60&newest=0&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2&view_session_id=956d4c20-1784-49c6-9ad0-f76646067979');
    // $response = $request->getBody();

    // dd($response);

    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
      'Access-Control-Allow-Origin: "*"'
    ));
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, 'user-agent : Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36');
    curl_setopt($cURLConnection, CURLOPT_URL, 'https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=xiaomi&limit=60&newest=0&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2&view_session_id=956d4c20-1784-49c6-9ad0-f76646067979');
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $data['data'] = $data;

    echo 'DONE';
  }
}
