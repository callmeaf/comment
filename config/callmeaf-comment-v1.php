<?php

use Callmeaf\Base\App\Enums\RequestType;

return [
    'model' => \Callmeaf\Comment\App\Models\Comment::class,
    'route_key_name' => 'id',
    'repo' => \Callmeaf\Comment\App\Repo\V1\CommentRepo::class,
    'resources' => [
        RequestType::API->value => [
            'resource' => \Callmeaf\Comment\App\Http\Resources\Api\V1\CommentResource::class,
            'resource_collection' => \Callmeaf\Comment\App\Http\Resources\Api\V1\CommentCollection::class,
        ],
        RequestType::WEB->value => [
            'resource' => \Callmeaf\Comment\App\Http\Resources\Web\V1\CommentResource::class,
            'resource_collection' => \Callmeaf\Comment\App\Http\Resources\Web\V1\CommentCollection::class,
        ],
        RequestType::ADMIN->value => [
            'resource' => \Callmeaf\Comment\App\Http\Resources\Admin\V1\CommentResource::class,
            'resource_collection' => \Callmeaf\Comment\App\Http\Resources\Admin\V1\CommentCollection::class,
        ],
    ],
    'events' => [
        RequestType::API->value => [
            \Callmeaf\Comment\App\Events\Api\V1\CommentIndexed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentCreated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentShowed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentUpdated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentDeleted::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentStatusUpdated::class => [
                \Callmeaf\Comment\App\Listeners\Api\V1\NotifyAuthorOfCommentStatusChanged::class,
            ],
            \Callmeaf\Comment\App\Events\Api\V1\CommentTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::WEB->value => [
            \Callmeaf\Comment\App\Events\Web\V1\CommentIndexed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentCreated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentShowed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentUpdated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentDeleted::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Web\V1\CommentTypeUpdated::class => [
                // listeners
            ],
        ],
        RequestType::ADMIN->value => [
            \Callmeaf\Comment\App\Events\Admin\V1\CommentIndexed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentCreated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentShowed::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentUpdated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentDeleted::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentStatusUpdated::class => [
                // listeners
            ],
            \Callmeaf\Comment\App\Events\Admin\V1\CommentTypeUpdated::class => [
                // listeners
            ],
        ],
    ],
    'requests' => [
        RequestType::API->value => [
            'index' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentIndexRequest::class,
            'store' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentStoreRequest::class,
            'show' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentShowRequest::class,
            'update' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentUpdateRequest::class,
            'destroy' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Comment\App\Http\Requests\Api\V1\CommentTypeUpdateRequest::class,
        ],
        RequestType::WEB->value => [
            'index' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentIndexRequest::class,
            'create' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentCreateRequest::class,
            'store' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentStoreRequest::class,
            'show' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentShowRequest::class,
            'edit' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentEditRequest::class,
            'update' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentUpdateRequest::class,
            'destroy' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Comment\App\Http\Requests\Web\V1\CommentTypeUpdateRequest::class,
        ],
        RequestType::ADMIN->value => [
            'index' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentIndexRequest::class,
            'store' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentStoreRequest::class,
            'show' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentShowRequest::class,
            'update' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentUpdateRequest::class,
            'destroy' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentDestroyRequest::class,
            'statusUpdate' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentStatusUpdateRequest::class,
            'typeUpdate' => \Callmeaf\Comment\App\Http\Requests\Admin\V1\CommentTypeUpdateRequest::class,
        ],
    ],
    'controllers' => [
        RequestType::API->value => [
            'comment' => \Callmeaf\Comment\App\Http\Controllers\Api\V1\CommentController::class,
        ],
        RequestType::WEB->value => [
            'comment' => \Callmeaf\Comment\App\Http\Controllers\Web\V1\CommentController::class,
        ],
        RequestType::ADMIN->value => [
            'comment' => \Callmeaf\Comment\App\Http\Controllers\Admin\V1\CommentController::class,
        ],
    ],
    'routes' => [
        RequestType::API->value => [
            'prefix' => 'comments',
            'as' => 'comments.',
            'middleware' => [
                "auth:sanctum"
            ],
        ],
        RequestType::WEB->value => [
            'prefix' => 'comments',
            'as' => 'comments.',
            'middleware' => [
                "route_status:" . \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND,
            ],
        ],
        RequestType::ADMIN->value => [
            'prefix' => 'comments',
            'as' => 'comments.',
            'middleware' => [
                "auth:sanctum",
                "role:" . \Callmeaf\Role\App\Enums\RoleName::SUPER_ADMIN->value,
            ],
        ],
    ],
    'enums' => [
         'status' => \Callmeaf\Comment\App\Enums\CommentStatus::class,
         'type' => \Callmeaf\Comment\App\Enums\CommentType::class,
    ],
     'exports' => [
        RequestType::API->value => [
            'excel' => \Callmeaf\Comment\App\Exports\Api\V1\CommentsExport::class,
        ],
        RequestType::WEB->value => [
            'excel' => \Callmeaf\Comment\App\Exports\Web\V1\CommentsExport::class,
        ],
        RequestType::ADMIN->value => [
            'excel' => \Callmeaf\Comment\App\Exports\Admin\V1\CommentsExport::class,
        ],
     ],
     'imports' => [
         RequestType::API->value => [
             'excel' => \Callmeaf\Comment\App\Imports\Api\V1\CommentsImport::class,
         ],
         RequestType::WEB->value => [
             'excel' => \Callmeaf\Comment\App\Imports\Web\V1\CommentsImport::class,
         ],
         RequestType::ADMIN->value => [
             'excel' => \Callmeaf\Comment\App\Imports\Admin\V1\CommentsImport::class,
         ],
     ],
];
