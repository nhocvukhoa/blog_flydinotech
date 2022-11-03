<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\User\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Save user comments
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function saveComment(Request $params)
    {
        $validator = Validator::make($params->all(), 
        [
            'content' => 'required'
        ], 
        [
            'content.required' => 'Hãy nhập bình luận'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->commentService->saveComment($params);

            return response()->json([
                'status' => 200, 
                'message' => __('messages.comment.create_success')
            ]);
        }
    }

    /**
     * Delete user's comment
     *
     * @param \App\Models\Post $comment
     * @return void
     */
    public function deteteComment(Comment $comment)
    {
        if ($this->commentService->deteteComment($comment)) {
            return response()->json([
                'status' => 200, 
                'message' => __('messages.comment.delete_success')
            ]);
        } 

        return response()->json([
            'message' => __('messages.comment.delete_error')
        ]);
    }

    /**
     * Update user's comment
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $comment
     * @return void
     */
    public function updateComment(Request $params, Comment $comment)
    {
        $validator = Validator::make($params->all(), 
        [
            'content' => 'required'
        ], 
        [
            'content.required' => 'Hãy nhập bình luận'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->commentService->updateComment($params, $comment);
            
            return response()->json([
                'status' => 200, 
                'message' => __('messages.comment.update_succes')
            ]);
        }
    }

    /**
     * Load more reply comment of user
     *
     * @param \App\Models\Comment $comment
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function loadMoreReplyComment(Comment $comment, Request $request)
    {   
        $replies = $this->commentService->loadMoreReplyComment($comment, $request);

        return response()->json([
            'replies' => CommentResource::collection($replies)
        ]);
    }
}
