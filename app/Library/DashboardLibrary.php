<?php

namespace App\Library;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DashboardLibrary
{

    #### Atılacak isteklerin hepsi buradan yapılmaktadır.
    public static function httpRequest($url, $token, $data)
    {

        $response = Http::withHeaders(['Authorization' => $token])->post($url, $data);
        return $response;
    }

}
