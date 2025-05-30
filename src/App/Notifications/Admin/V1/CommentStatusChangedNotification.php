<?php

namespace Callmeaf\Comment\App\Notifications\Admin\V1;

use Callmeaf\Comment\App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentStatusChangedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @var Comment $comment
     */
    public function __construct(public $comment)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Determine which queues should be used for each notification channel.
     *
     * @return array<string, string>
     */
    public function viaQueues(): array
    {
        return [
//            'mail' => 'notifications',
        ];
    }

    /**
     * Determine which connections should be used for each notification channel.
     *
     * @return array<string, string>
     */
    public function viaConnections(): array
    {
        return [
            'database' => 'sync',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail(object $notifiable): MailMessage
//    {
//        return (new MailMessage)->subject(
//            __('callmeaf-comment::admin_v1.mail.approved.subject', [
//                'comment_name' => $this->comment->name,
//            ])
//        )->markdown('callmeaf-comment::admin.v1.mail.strategies.approved',[
//            'url' => explode(',',config('app.frontend_url'))[0],
//            'comment_name' => $this->comment->name,
//        ]);
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "subject" => __('callmeaf-comment::admin_v1.mail.status_changed.notification_subject'),
            'payload' => __('callmeaf-comment::admin_v1.mail.status_changed.notification_payload',[
                'status_text' => $this->comment->statusText,
                'commentable_title' => $this->comment->commentable->commentableTitle,
                'comment_excerpt' => $this->comment->excerptContent(),
            ]),
        ];
    }
}
