<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function requestToken(Request $request)
    {
        $url = 'http://34.101.235.69/ekatalog/apiv1/request_token';

        $body = [
            'username' => 'admin',
            'password' => 'admin'
        ];

        try {
            $response = Http::post($url, $body);

            if ($response->successful()) {
                $token = $response->json()['token']; 
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'Unable to get token'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getTenagaKerja(Request $request)
    {
        $apiKey = 'admin'; 
        $sessionToken = $request->input('session_token'); 

        $url = 'http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja';

        $headers = [
            'X-DreamFactory-Api-Key' => $apiKey,
            'X-DreamFactory-Session-Token' => $sessionToken,
        ];

        $params = [
            'offset' => 0,
        ];

        try {
            $response = Http::withHeaders($headers)->get($url, $params);

            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json(['error' => 'Unable to fetch data'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function filterData(Request $request)
    {
        $url = 'http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja';
        
        $headers = [
            'X-DreamFactory-Api-Key' => 'admin', 
            'X-DreamFactory-Session-Token' => $request->input('session_token'), 
        ];

        $params = [
            'offset' => 0,
            'search' => 'tenagakerja=sopir'
        ];

        try {
            $response = Http::withHeaders($headers)->get($url, $params);

            if ($response->successful()) {
                $data = $response->json();

                $filteredData = collect($data['resource']) 
                    ->filter(function ($item) {
                        return $item['provinsi_id'] === 11 && 
                               $item['kab_kota_id'] === 1171 && 
                               stripos($item['tenaga_kerja'], 'sopir') !== false; 
                    });

                return view('tenaga_kerja.index', ['tenagaKerja' => $filteredData]);
            } else {
                return response()->json(['error' => 'Unable to fetch data'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    function hargaTenagaKerja($tenagaKerja) {
        usort($tenagaKerja, function($a, $b) {
            return $b['harga_oh'] <=> $a['harga_oh'];
        });
    
        $groupedData = [];
    
        foreach ($tenagaKerja as $item) {
            if (!isset($groupedData[$item['harga_oh']])) {
                $groupedData[$item['harga_oh']] = [];
            }
            $groupedData[$item['harga_oh']][] = [
                'provinsi' => $item['provinsi'],
                'kabkota' => $item['kabkota'],
                'tenagakerja' => $item['tenagakerja'],
            ];
        }
    
        return $groupedData;
    }

    // $tenagaKerjaArray = [
    //     ['provinsi' => 'Aceh', 'kabkota' => 'Banda Aceh', 'tenagakerja' => 'Sopir', 'harga_oh' => 30000],
    //     ['provinsi' => 'Jawa Barat', 'kabkota' => 'Bandung', 'tenagakerja' => 'Tukang', 'harga_oh' => 20000],
    //     ['provinsi' => 'DKI Jakarta', 'kabkota' => 'Jakarta', 'tenagakerja' => 'Sopir', 'harga_oh' => 25000],
    //     ['provinsi' => 'Bali', 'kabkota' => 'Denpasar', 'tenagakerja' => 'Tukang', 'harga_oh' => 35000],
    // ];
}
