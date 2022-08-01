<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function store(StoreComment $request)
    {
        $commentData = $request->validated();
        $comment = Comment::create($commentData);
        return response()->json(
            [
                'comment' => $comment,
            ],
            201
        );
    }

    public function getComments($postId, CommentService $commentService)
    {
        $comments = $commentService->getComments($postId);
        count($comments) > 0 ? ($status = 200) : ($status = 204);
        return response()->json(['comments' => $comments], $status);
    }
}
