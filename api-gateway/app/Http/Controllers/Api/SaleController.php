<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SaleController extends Controller
{
    public function index()
    {
        $url = env('BASE_ROUTE_SALES') . '/Sale';
        try {
            $data = Http::get($url);
            return $data;
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        $url = env('BASE_ROUTE_SALES') . '/Sale/store';
        try {
            $response = Http::post($url, $request->toArray());
            $responseCode = $response[0]['responseCode'];
            return response()->json(json_decode($response), $responseCode);
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function update(int $id,Request $request)
    {
        $url = env('BASE_ROUTE_SALES') . "/Sale/update/$id";
        $values = $request->toArray();
        unset($values['_method']);
        try {
            $response =  Http::post($url, $values);
            $responseCode = $response[0]['responseCode'];
            return response()->json(json_decode($response), $responseCode);
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    public function show(int $id)
    {
        $url = env('BASE_ROUTE_SALES') . "/Sale/show/$id";
        try {
            $data = Http::get($url);
            return $data;
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
