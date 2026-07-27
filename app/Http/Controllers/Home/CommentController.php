<?php

namespace App\Http\Controllers\Home;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(string $id, CreateCommentRequest $request)
    {
        $user = auth()->user();
        $product = Product::getProduct($id);

        Comment::createUserComment($request,$user,$product);

        return redirect()->back()->with('success', __('messages.comment.submitted'));
    }


    public function reply(Request $request, Comment $comment)
    {
        $admin = auth()->user()->is_admin;

        if (!$admin) {
            abort(403);
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::createAdminComment($request,$admin,$comment);

        return back()->with('success', __('messages.comment.reply_created'));
    }
}
