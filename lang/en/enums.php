<?php

use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Enums\CommentType;

return [
    CommentStatus::class => [
        CommentStatus::ACTIVE->name => 'Approved',
        CommentStatus::INACTIVE->name => 'Rejected',
        CommentStatus::PENDING->name => 'Pending',
    ],
    CommentType::class => [
        CommentType::SURVEY->name => 'Survey',
        CommentType::USER_EXPERIENCE->name => 'User Exp'
    ],
];
