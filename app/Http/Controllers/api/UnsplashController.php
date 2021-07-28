<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnsplashSearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class UnsplashController extends Controller
{
    public function search(UnsplashSearchRequest $request)
    {
        $response = Http::get('https://api.unsplash.com/search/photos', [
            'client_id' => config('unsplash.client_id'),
            'query' => $request->search,
            'page' => $request->page ?? 1,
            'per_page' => $$request->perPage ?? 30
        ]);

        if($response->failed()) {
            $response->throw()->json();
        }

        return Response::json($response->json(), 200);
    }
}
