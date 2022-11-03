<?php

namespace App\Services\Admin;

use App\Models\Comment;

class CommentService
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of comment.
     *
     * @return void
     */
    public function listComment($postId)
    {
        return $this->model->where('post_id', $postId)->paginate(config('api.pagination.per_page'));
    }

    /**
     * Update the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return boolean
     */
    public function statusComment($comment)
    {
        $comment['status'] == 0 ? $data = ['status' => 1] : $data = ['status' => 0];
        if ($comment->update($data)) {
            return true;
        }
        
        return false;
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\Comment $comment
     * @return boolean
     */
    public function deleteComment($comment)
    {
        if ($comment->delete()) {
            return true;
        }

        return false;
    }
}
