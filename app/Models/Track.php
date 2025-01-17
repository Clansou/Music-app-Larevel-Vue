<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Playlist;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'artist',
        'image',
        'music',
        'isPrivate',
        'playCount',
    ];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_music');
    }

    public function getRouteKeyName(){
        return 'uuid';
    }
}
