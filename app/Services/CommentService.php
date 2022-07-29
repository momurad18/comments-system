<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    protected $perPage;
    protected $type;

    public function __construct()
    {
        $this->perPage = env('MIX_COMMENT_PER_PAGE', 5);
        $this->type = env('COMMENT_SYSTEM', 'CTE');
    }

    public function getComments($postId)
    {
        if ($this->type === 'CTE') {
            return $this->getByUsingCTE($postId);
        } else {
            return $this->getByUsingNested($postId);
        }
    }

    private function getByUsingCTE($postId)
    {
        return Comment::nested($postId)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toNested();
    }
    private function getByUsingNested($postId)
    {
        return Comment::topLevel($postId)
            ->with('children')
            ->orderBy('updated_at', 'desc')
            ->limit($this->perPage)
            ->get();
    }
}
