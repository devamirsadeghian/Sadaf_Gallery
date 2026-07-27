<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $title = "لیست کامنت ها";
        $userComments = Comment::getAllUserComment();
        $adminComments = Comment::getAllAdminComment();
        return view('admin.comment.comments',compact('title','userComments','adminComments'));
    }


    public function accept(Request $request, string $id)
    {
        $comment = Comment::getComment($id);
        $comment->update([
            'status' => CommentStatus::accept,
        ]);

        return redirect()->back()->with('success', __('messages.comment.accepted'));
    }


    public function reject(Request $request, string $id)
    {
        $comment = Comment::getComment($id);
        $comment->update([
            'status' => CommentStatus::reject,
        ]);

        return redirect()->back()->with('success', __('messages.comment.rejected'));
    }

    public function show(string $id)
    {
        $title = "مشاهده کامنت ها";
        $comment = Comment::getComment($id);
        return view('admin.comment.show',compact('title','comment'));
    }

    public function destroy(string $id)
    {
        $user = auth()->user();
        $comment = Comment::query()->findOrFail($id);
        $comment->delete();

        return back()->with('success', __('messages.comment.deleted'));
    }
}
