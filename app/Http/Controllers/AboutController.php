<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    public function privacy(): View
    {
        return view('about.privacy');
    }

    public function terms(): View
    {
        return view('about.terms');
    }
}

