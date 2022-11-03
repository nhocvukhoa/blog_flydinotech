<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->whenLoaded('user');
        $post = $this->whenLoaded('post');
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'content' => $this->content,
            'status' => $this->status,
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d/m/Y - H:m A', strtotime($this->created_at)),
            'updated_at' => $this->updated_at,
            'parent_id' => $this->parent_id,
            'user' => new UserResource($user),
            'post' => new PostResource($post),
            'replies' => self::collection($this->whenLoaded('replies')),
            'count_replies' => count($this->replies),
        ];
    }
}
