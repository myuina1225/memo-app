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
            'color' => $request->input('color', 'orange'),
        ]);

        return response()->json($memo, 201);
    }

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);

        if (!$memo) {
            return response()->json(['message' => 'メモが見つかりません'], 404);
        }

        if ($request->has('content')) {
            $memo->content = $request->input('content');
        }

        if ($request->has('is_favorite')) {
            $memo->is_favorite = $request->input('is_favorite');
        }

        if ($request->has('color')) {
            $memo->color = $request->input('color');
        }

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
