<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getRouteKeyName(){
        return 'uuid';
    }
}
