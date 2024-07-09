<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('isPrivate', false)->orderBy('artist')->get();

        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }
    public function create()
    {
        return ('<h1>create</h1>');
    }
    public function store()
    {
        return ('<h1>store</h1>');
    }
    public function show()
    {
        return ('<h1>show</h1>');
    }
    public function edit()
    {
        return ('<h1>edit</h1>');
    }
    public function update()
    {
        return ('<h1>update</h1>');
    }
    public function destroy()
    {
        return ('<h1>destroy</h1>');
    }
}
