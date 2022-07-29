<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentCollection extends Collection
{
    public function toNested()
    {
        $root = $this->where('depth', 0)->values();
        $itemsByParentKey = $this->groupBy('parent_id');

        foreach ($this->items as $item) {
            $item->setRelation(
                'children',
                $itemsByParentKey[$item->id] ?? new static()
            );
        }
        return $root;
    }
}
