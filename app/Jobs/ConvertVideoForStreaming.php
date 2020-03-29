<?php

namespace App\Jobs;

use App\Lecture;
use App\Video;
use Carbon\Carbon;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;




class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
    public $lecture;
 
    /**
     * Create a new job instance.
     *
     * @param Video $video
     */
    public function __construct(Lecture $lecture)
    {
        $this->lecture = $lecture;
    }
 
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // open and get the duration from the uploaded lecture from the right disk...
        $lectureSeconds = FFMpeg::fromDisk($this->lecture->disk)
            ->open($this->lecture->video_path)
            ->getDurationInSeconds();
 
        $this->lecture->update([
            // 'converted_for_streaming_at' => Carbon::now(),
            // 'processed'     => true,
            // 'stream_path'   => $converted_name,
            'duration_in_seconds'      => $lectureSeconds,
        ]);
    }
 
    private function getCleanFileName($filename){
        return $this->lecture->slug . '.mp4';
    }

    public function resizeVideo()
    {
                    // // add the 'resize' filter...
            // ->addFilter(function ($filters) {
            //     $filters->resize(new \FFMpeg\Coordinate\Dimension(960, 540));
            // })
 
            // // call the 'export' method...
            // ->export()
 
            // // tell the MediaExporter to which disk and in which format we want to export...
            // ->toDisk('public')
            // ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264') )
 
            // // call the 'save' method with a filename...
            // ->save($converted_name);
    }
}