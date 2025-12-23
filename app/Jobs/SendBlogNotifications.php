<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Blog;
use App\Models\Subscription;
use App\Mail\NewBlogNotification;
use Mail;

class SendBlogNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function handle()
    {
        $blog = Blog::with(['category'])->find($this->blog->id);
        
        $subscribers = Subscription::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->send(new NewBlogNotification($blog));
        }
    }
} 