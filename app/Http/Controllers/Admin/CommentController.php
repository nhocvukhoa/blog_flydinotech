<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Admin\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $this->commentService->listComment($post->id);

        return view('admin.comment.detail', compact('post', 'comments'));
    }

    /**
     * Update the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return boolean
     */
    public function statusComment(Comment $comment)
    {
        if ($this->commentService->statusComment($comment)) {
            return redirect()->back()->with('success', __('messages.comment.change_success'));
        }
        
        return redirect()->back()->with('error', __('messages.comment.change_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($this->commentService->deleteComment($comment)) {
            return redirect()->back()->with('success', __('messages.comment.delete_success'));
        }

        return redirect()->back()->with('error', __('messages.comment.delete_error'));
    }
}
