<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesControllers extends Controller
{
    public function index() {
        $title='welcome to the first page ';
        return view('pages.index')->with('title',$title); 
    }

    public function about() {
        return view('pages.about'); 
    }

    public function services() {   
        $data = array(
            'title' => 'services' ,
            'services' => ['web design' , 'seo' , 'mobile']
        );
        return view('pages.services')->with($data); 
    }
}
