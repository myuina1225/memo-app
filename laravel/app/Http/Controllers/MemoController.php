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

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return response()->json(['message' => 'メモが見つかりません'], 404);
        }

        $memo->content = $request->input('content');
        $memo->save();

        return response()->json($memo);
    }

    public function destroy($id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return response()->json(['message' => 'メモが見つかりません'], 404);
        }

        $memo->delete();

        return response()->json(null, 204);
    }
}