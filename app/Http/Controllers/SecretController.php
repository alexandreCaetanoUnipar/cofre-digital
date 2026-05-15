<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secret;

class SecretController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'secret_content' => 'required'
        ]);

        $secret = Secret::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'secret_content' => $validated['secret_content']
        ]);

        return response()->json($secret, 201);
    }

    public function show($id)
    {
        $secret = Secret::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$secret) {
            return response()->json([
                'message' => 'Segredo não encontrado'
            ], 404);
        }

        return response()->json($secret);
    }
}