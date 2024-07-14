<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 
        'user_id', 
        'name', 
        'key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'uuid';
    }
}
