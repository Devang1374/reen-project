<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class storePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tamppath;
    public function __construct(
        string $tamppath
    )
    {
        $this->tamppath = $tamppath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if(!Storage::disk('local')->exists($this->tamppath)){
            return;
        }

        $fileContents = Storage::disk('local')->get($this->tamppath);
        $fileName = basename($this->tamppath);

        Storage::disk('public')->put('files' . $fileName, $fileContents);

        Storage::disk('local')->delete('tamp-file',$this->tamppath);
    }
}
