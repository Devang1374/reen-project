<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\heroBanner;


class storeHeroBanner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $title,
        protected $caption,
        protected $btnText,
        protected $btnUrl,
        protected $path,

    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        heroBanner::create([
            'title'=>$this->title,
            'caption'=>$this->caption,
            'btn-text'=>$this->btnText,
            'btn-url'=>$this->btnUrl,
            'file-path'=>$this->path
        ]);

        dispatch('banner-updated');
    }
}
