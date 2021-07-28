<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        Inertia::share([
            'unsplashSearch' => route('unsplash_search'),
            'image' => route('image'),
            'imageShow' => route('image_show'),
            'imageDestroy' => route('image_destroy', ':id'),
            'imageHighlight' => route('image_highlight', ':id')
        ]);
        
    }

    public function searchPage()
    {
        return Inertia::render('searchPage',[
            'data' => 'test'
        ]);
    }
    public function mediaLibrary()
    {
        return Inertia::render('mediaLibrary',[
            'data' => 'test'
        ]);
    }
    public function home()
    {
        
        return Inertia::render('home',[
            'data' => 'test',
            'search' => [
                'click' => false,
                'data' => null,
            ]  
        ]);
    }

   

}
