<?php

namespace App\Models;

use App\Support\CommentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Comment extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $fillable = ['name', 'body', 'level', 'parent_id', 'post_id'];
    /**
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    /**
     * @return hasMany
     * Nested relationship
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('children');
    }

    public function scopeTopLevel(Builder $query, $postId,)
    {
        return $query->whereNull('parent_id')->where('post_id', $postId);
    }
    public function scopeNested(Builder $query, $postId, $maxDepth = null)
    {
        $constraint = function (Builder $query) use ($postId) {
            $query
                ->whereNull('parent_id')
                ->where('post_id', $postId)
                ->limit(env('MIX_COMMENT_PER_PAGE', 5))
                ->orderBy('updated_at', 'desc');
        };

        return $query->treeOf($constraint, $maxDepth);
    }

    public function getDepthName()
    {
        return 'depth';
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }
}
