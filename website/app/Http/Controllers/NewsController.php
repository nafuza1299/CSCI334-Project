<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $response = Http::get('https://newsapi.org/v2/everything?q=Covid-19+Australia&apiKey=');
        $news_data = json_decode($response->body(), true);
        
        
        return view('news', compact('news_data'));
        
    }
    
}
