<?php

namespace App\Http\Controllers\Website;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DynamicPageController extends Controller
{
    public function showDynamicPage($slug){
        $page = Page::where('slug' , $slug)->first();

        if(!$page){
            abort(404);
        }

        return view('website.dynamic-page' , compact('page'));
    }
}
