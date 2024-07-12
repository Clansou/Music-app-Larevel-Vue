<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $user = auth()->user() ;
        $playlists = $user->playlist()->with('tracks')->get(); 
        return Inertia::render('Playlist/Index', [
            'playlists' => $playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tracks = Track::all(); 
        return Inertia::render('Playlist/Create',[
            'tracks' => $tracks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:255','min:5','string'],
            'tracks' =>['required','array'],
            'tracks.*' =>['required','string']
        ]);
        
        $tracks = Track::whereIn('uuid', $request->tracks)->where('isPrivate',false)->get();
        if($tracks->count() !== count($request->tracks)){
            throw validationException::withMessages([
              'tracks' => "une musique n'existe pas"  
            ]);
        }
        $uuid = 'ply-'. Str::uuid();
        $playlistData = [
            'uuid' => $uuid,
            'user_id' => $request->user()->id,
            'title' =>  $request->title,
        ];
        $playlist = Playlist::create($playlistData);
        $playlist->tracks()->attach($tracks->pluck("id"));
        return redirect()->route('playlist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return Inertia::render('Playlist/Show',[
            'playlist' => $playlist,
            'tracks' => $playlist->tracks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        $tracks = Track::all(); 
        return Inertia::render('Playlist/Edit',[
            'playlist' => $playlist,
            'tracks' => $tracks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'title' => ['required','max:255','min:5','string'],
            'tracks' =>['required','array'],
            'tracks.*' =>['required','string']
        ]);
        $playlistData = [
            'title' =>  $request->title,
        ];
        $playlist->update($playlistData);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        // dd($playlist);
        $playlist->delete;
       
        
        return redirect()->back();
    }
}
