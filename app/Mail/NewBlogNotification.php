<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Blog;

class NewBlogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function build()
    {
        return $this->subject('New Blog Post: ' . $this->blog->name)
                    ->view('emails.new-blog-notification');
    }
} 