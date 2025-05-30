<?php

namespace Callmeaf\Comment\App\Listeners\Admin\V1;



use Callmeaf\Comment\App\Events\Api\V1\CommentStatusUpdated;
use Callmeaf\Comment\App\Notifications\Admin\V1\CommentStatusChangedNotification;

class NotifyAuthorOfCommentStatusChanged
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentStatusUpdated $event): void
    {
        $comment = $event->comment;
        if($comment->wasChanged(['status'])) {
            $comment->author->notify(new CommentStatusChangedNotification(comment: $comment));
        }
    }
}
