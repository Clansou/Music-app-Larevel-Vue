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
    public function edit(Track $track)
    {
        return Inertia::render('Track/Edit',[
            'track' => $track,
        ]);
    }
    public function update(Request $request, Track $track)
    {
        
        $request->validate([
            'title' => ['required','max:255','min:5','string'],
            'artist' => ['required', 'max:255', 'min:5', 'string'],
            'isPrivate' => ['required','boolean'],
        ]);
        $trackData = [
            'title' =>  $request->title,
            'artist' => $request->artist,
            'isPrivate' => $request->isPrivate,
        ];
        $track->update($trackData);

        return redirect()->route('tracks.index');

    }
    public function destroy(Track $track)
    {
        $track->delete;
        
        return redirect()->back();
    }
}
