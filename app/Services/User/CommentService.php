<?php

namespace App\Services\User;

use App\Enums\CommentStatus;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class CommentService
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    /**
     * Save user comment
     *
     * @param \App\Http\Requests\User\CommentRequest $request
     * @return boolean
     */
    public function saveComment($request)
    {
        try {
            $this->model->create([
                'user_id' => Auth::guard('user')->user()->id,
                'post_id' => $request->post_id,
                'content' => $request->content,
                'parent_id' => $request->parent_id,
                'status' => CommentStatus::ACTIVE
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Delete user's comment
     *
     * @param \App\Models\Comment $comment
     * @return void
     */
    public function deteteComment($comment)
    {
        try {
            $this->model->where('parent_id', $comment->id)->delete();
            $comment->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update user's comment
     *
     * @param \App\Http\Requests\User\CommentRequest $request
     * @param \App\Models\Comment $comment
     * @return void
     */
    public function updateComment($request, $comment)
    {
        try {
            $comment->update([
                'content' => $request->content
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Load more reply comment
     *
     * @param \App\Models\Comment $comment
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function loadMoreReplyComment($comment, $request)
    {
        $replies = $this->model->query();

        $replies->with('replies.user.userProfile')
            ->with('user.userProfile')
            ->where('parent_id', $comment->id)
            ->where('status', CommentStatus::ACTIVE)
            ->orderBy('id', 'asc');

        if (!$request->countReplies) {
            $replies->take(2);
        }

        return $replies->get();
    }
}
