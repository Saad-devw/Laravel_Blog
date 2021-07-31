<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to index page";

        //return view('pages.index', compact('title', 'subTitle'));
        return view('pages.index') -> with('title', $title);
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        $data = array(
            'title' => 'Welcome to our Services',
            'services' => ['Front-End Design', 'Back-End Dev', 'Logo Design', 'Video Editing', 'Mobile Dev', 'Web Hosting']
        );

        return view('pages.services') -> with($data);
    }
}
