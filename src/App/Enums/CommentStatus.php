<?php

namespace Callmeaf\Comment\App\Enums;


use Callmeaf\Base\App\Enums\BaseStatus;

enum CommentStatus: string
{
    case ACTIVE = BaseStatus::ACTIVE->value;
    case INACTIVE = BaseStatus::INACTIVE->value;
    case PENDING = BaseStatus::PENDING->value;
}
