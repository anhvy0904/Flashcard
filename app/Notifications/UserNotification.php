<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;


class UserNotification extends Notification
{
    use Queueable;

    private $title;
    private $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->line(new HtmlString($this->content))
            ->action('Xem Thông Báo', url('/notifications'))
            ->line('Cảm ơn bạn đã sử dụng FlashCard Website!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}