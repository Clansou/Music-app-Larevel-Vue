<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Inertia\Inertia;
use Illuminate\Support\Str;


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
        return Inertia::render('Track/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:255','min:5','string'],
            'artist' => ['required', 'max:255', 'min:5', 'string'],
            'image' => ['required','image','max:10000'],
            'music' => ['required','file','mimes:mp3,mav,wav','max:10000'], 
            'isPrivate' => ['required','boolean'],
        ]);

        $imageExtension = $request->image->extension();
        $musicExtension = $request->music->extension();
        $uuid = 'trk-'. Str::uuid();
        $trackData = [
            'uuid' => $uuid,
            'title' =>  $request->title,
            'artist' => $request->artist,
            'image' => basename($request->image->storeAs('/images', $uuid.'.'.$imageExtension)),
            'music' => basename($request->music->storeAs('/musics', $uuid.'.'.$musicExtension)),
            'isPrivate' => $request->isPrivate,
        ];
        Track::create($trackData);
        return redirect()->back();
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
