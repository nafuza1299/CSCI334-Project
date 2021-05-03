<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class NewsController extends Controller
{
    public function index()
    {
        $news_api_key = env('NEWS_API_KEY', "");
        if($news_api_key != ""){
            $response = Http::withHeaders([
                'X-API-Key' => $news_api_key,
            ])->get('https://newsapi.org/v2/everything?q=Covid-19+Australia');
            
            if($response->ok()){
                $news_data = json_decode($response->body(), true);
            
                return view('news', compact('news_data'));
            }

            else{
                return view('errors.500');
            }
        }
        else{
            return view('errors.500');
        }
        
    }
    
}
