<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);

        Comment::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('products.detail', $product->id)->with('success', 'Bình luận của bạn đã được thêm.');
    }
}
