<?php

namespace Callmeaf\Comment\App\Repo\Contracts;

use Callmeaf\Base\App\Repo\Contracts\BaseRepoInterface;
use Callmeaf\Comment\App\Models\Comment;
use Callmeaf\Comment\App\Http\Resources\Api\V1\CommentCollection;
use Callmeaf\Comment\App\Http\Resources\Api\V1\CommentResource;

/**
 * @extends BaseRepoInterface<Comment,CommentResource,CommentCollection>
 */
interface CommentRepoInterface extends BaseRepoInterface
{

}
