<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{

    public function index()
    {
        return view('index');
    }

    //
    public function search(Request $request)
    {
        $baseUrl = 'https://api.github.com';
        $query = $request->input('search');
        $sort = $request->input('sort');

        try {
            $url = $baseUrl . '/search/repositories?q=' . $query . '&page=1&per_page=10&sort=' . $sort;
            $response = Http::get($url);

            return view('index', [
                'items' => $response->json()['items'],
                'search' => $query,
                'sort' => $sort,
            ]);
        } catch (\Throwable $th) {
            return view('index', [
                'error' => $th->getMessage(),
                'search' => $query,
                'sort' => $sort,
            ]);
        }
    }
}
