<?php

use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Enums\CommentType;

return [
    CommentStatus::class => [
        CommentStatus::ACTIVE->name => 'تایید شده',
        CommentStatus::INACTIVE->name => 'رد شده',
        CommentStatus::PENDING->name => 'در انتظار تایید',
    ],
    CommentType::class => [
        CommentType::SURVEY->name => 'نظرسنجی',
        CommentType::USER_EXPERIENCE->name => 'تجربه کاربری'
    ],
];
