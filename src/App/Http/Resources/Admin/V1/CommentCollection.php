<?php

namespace Callmeaf\Comment\App\Http\Resources\Admin\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @extends ResourceCollection<CommentResource>
 */
class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, CommentResource>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
