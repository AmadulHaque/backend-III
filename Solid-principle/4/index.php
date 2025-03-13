
<?php

abstract class MediaFile {
    protected $fileName;

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    public function getFileName() {
        return $this->fileName;
    }

    abstract public function play();
    abstract public function pause();
    abstract public function stop();
}


class AudioFile extends MediaFile {
    public function play() {
        echo "Playing audio file: " . $this->fileName . "\n";
    }

    public function pause() {
        echo "Pausing audio file: " . $this->fileName . "\n";
    }

    public function stop() {
        echo "Stopping audio file: " . $this->fileName . "\n";
    }
}


interface SubtitledMedia {
    public function enableSubtitles();
    public function disableSubtitles();
}

class VideoFile extends MediaFile implements SubtitledMedia {
    private $subtitlesEnabled = false;

    public function play() {
        echo "Playing video file: " . $this->fileName . "\n";
    }

    public function pause() {
        echo "Pausing video file: " . $this->fileName . "\n";
    }

    public function stop() {
        echo "Stopping video file: " . $this->fileName . "\n";
    }

    public function enableSubtitles() {
        $this->subtitlesEnabled = true;
        echo "Subtitles enabled for: " . $this->fileName . "\n";
    }

    public function disableSubtitles() {
        $this->subtitlesEnabled = false;
        echo "Subtitles disabled for: " . $this->fileName . "\n";
    }
}


class MediaPlayer {
    public function playMedia(MediaFile $mediaFile) {
        $mediaFile->play();
    }

    public function pauseMedia(MediaFile $mediaFile) {
        $mediaFile->pause();
    }

    public function stopMedia(MediaFile $mediaFile) {
        $mediaFile->stop();
    }

    public function enableSubtitlesIfAvailable(MediaFile $mediaFile) {
        if ($mediaFile instanceof SubtitledMedia) {
            $mediaFile->enableSubtitles();
        } else {
            echo "Subtitles not supported for: " . $mediaFile->getFileName() . "\n";
        }
    }
}



// example usage
$audio = new AudioFile("song.mp3");
$video = new VideoFile("movie.mp4");

$player = new MediaPlayer();

// Playing Audio
$player->playMedia($audio);
$player->pauseMedia($audio);
$player->stopMedia($audio);

// Playing Video
$player->playMedia($video);
$player->enableSubtitlesIfAvailable($video);
$player->pauseMedia($video);
$player->stopMedia($video);
