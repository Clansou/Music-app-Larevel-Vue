<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HelloWorld()
    {
        return ('<h1>HelloWorld</h1>');
    }
}
