<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class DemoAudioTrackService
{
    /**
     * @param array<int, int> $frequencies
     * @return array{disk: string, path: string, duration_seconds: float, mime_type: string, sample_rate: int, channels: int}
     */
    public function createAudibleWav(
        int $projectId,
        int $durationSeconds,
        array $frequencies = [],
        ?string $narrationText = null,
    ): array {
        if (! app()->runningUnitTests() && $narrationText && $this->systemSayIsAvailable()) {
            $narration = $this->createSystemNarration($projectId, $durationSeconds, $narrationText);

            if ($narration !== null) {
                return $narration;
            }
        }

        return $this->createToneWav($projectId, $durationSeconds, $frequencies);
    }

    /**
     * @param array<int, int> $frequencies
     * @return array{disk: string, path: string, duration_seconds: float, mime_type: string, sample_rate: int, channels: int, mode: string}
     */
    private function createToneWav(int $projectId, int $durationSeconds, array $frequencies = []): array
    {
        $disk = (string) config('video_pipeline.storage.output_disk');
        $path = "videos/video-projects/{$projectId}/xianxia-review/generated-voice.wav";
        $absolutePath = Storage::disk($disk)->path($path);
        $directory = dirname($absolutePath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $sampleRate = 22050;
        $channels = 1;
        $bitsPerSample = 16;
        $totalSamples = $durationSeconds * $sampleRate;
        $frequencies = $frequencies ?: [196, 247, 294, 330, 392, 494];

        $handle = fopen($absolutePath, 'wb');

        if ($handle === false) {
            throw new \RuntimeException('Unable to create demo audio file.');
        }

        $dataBytes = $totalSamples * $channels * (int) ($bitsPerSample / 8);
        fwrite($handle, $this->wavHeader($sampleRate, $channels, $bitsPerSample, $dataBytes));

        $sceneLength = max(1, (int) floor($totalSamples / count($frequencies)));
        $buffer = [];
        $bufferSize = 4096;

        for ($sample = 0; $sample < $totalSamples; $sample++) {
            $sceneIndex = min((int) floor($sample / $sceneLength), count($frequencies) - 1);
            $frequency = $frequencies[$sceneIndex];
            $time = $sample / $sampleRate;
            $sceneProgress = ($sample % $sceneLength) / $sceneLength;
            $envelope = 0.35 + (0.25 * sin(2 * M_PI * $sceneProgress));
            $carrier = sin(2 * M_PI * $frequency * $time);
            $overtone = 0.35 * sin(2 * M_PI * ($frequency * 1.5) * $time);
            $value = (int) round(($carrier + $overtone) * $envelope * 8200);

            $buffer[] = $this->signedToUnsigned16($value);

            if (count($buffer) >= $bufferSize) {
                fwrite($handle, pack('v*', ...$buffer));
                $buffer = [];
            }
        }

        if ($buffer !== []) {
            fwrite($handle, pack('v*', ...$buffer));
        }

        fclose($handle);

        return [
            'disk' => $disk,
            'path' => $path,
            'duration_seconds' => (float) $durationSeconds,
            'mime_type' => 'audio/wav',
            'sample_rate' => $sampleRate,
            'channels' => $channels,
            'mode' => 'generated_tone',
        ];
    }

    /**
     * @return array{disk: string, path: string, duration_seconds: float, mime_type: string, sample_rate: int, channels: int, mode: string}|null
     */
    private function createSystemNarration(int $projectId, int $durationSeconds, string $narrationText): ?array
    {
        $disk = (string) config('video_pipeline.storage.output_disk');
        $path = "videos/video-projects/{$projectId}/xianxia-review/generated-voice.aiff";
        $absolutePath = Storage::disk($disk)->path($path);
        $directory = dirname($absolutePath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $text = $this->repeatNarrationForDuration($narrationText, $durationSeconds);
        $process = new Process(['/usr/bin/say', '-o', $absolutePath, $text]);
        $process->setTimeout(120);
        $process->run();

        if (! $process->isSuccessful() || ! is_file($absolutePath)) {
            return null;
        }

        return [
            'disk' => $disk,
            'path' => $path,
            'duration_seconds' => (float) $durationSeconds,
            'mime_type' => 'audio/aiff',
            'sample_rate' => 22050,
            'channels' => 1,
            'mode' => 'system_narration',
        ];
    }

    private function systemSayIsAvailable(): bool
    {
        return is_executable('/usr/bin/say');
    }

    private function repeatNarrationForDuration(string $text, int $durationSeconds): string
    {
        $cleanText = trim(preg_replace('/\s+/', ' ', $text) ?? $text);
        $targetCharacters = max(1200, $durationSeconds * 24);
        $parts = [];

        while (mb_strlen(implode(' ', $parts)) < $targetCharacters) {
            $parts[] = $cleanText;
        }

        return implode(' ', $parts);
    }

    private function wavHeader(int $sampleRate, int $channels, int $bitsPerSample, int $dataBytes): string
    {
        $byteRate = $sampleRate * $channels * (int) ($bitsPerSample / 8);
        $blockAlign = $channels * (int) ($bitsPerSample / 8);

        return 'RIFF'
            .pack('V', 36 + $dataBytes)
            .'WAVE'
            .'fmt '
            .pack('V', 16)
            .pack('v', 1)
            .pack('v', $channels)
            .pack('V', $sampleRate)
            .pack('V', $byteRate)
            .pack('v', $blockAlign)
            .pack('v', $bitsPerSample)
            .'data'
            .pack('V', $dataBytes);
    }

    private function signedToUnsigned16(int $value): int
    {
        return $value < 0 ? $value + 65536 : $value;
    }
}
