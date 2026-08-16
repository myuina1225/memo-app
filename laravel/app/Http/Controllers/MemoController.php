<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        return Memo::all();
    }

    public function store(Request $request)
    {
        $memo = Memo::create([
            'content' => $request->input('content'),
        ]);

        return response()->json($memo, 201);
    }
}
