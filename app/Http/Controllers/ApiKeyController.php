<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKey;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKey::where('user_id', auth()->id())->get();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function create()
    {
        return Inertia::render('ApiKey/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $apiKey = ApiKey::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'key' => Str::random(20), // Assuming you want a random string for the key
        ]);

        return redirect()->route('apikey.index');
    }

    public function destroy(ApiKey $apikey)
    {

        $apikey->delete();

        return redirect()->route('apikey.index');
    }
}