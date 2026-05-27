<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVideoProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'keyword' => ['required', 'string', 'max:120'],
            'content_brief' => ['nullable', 'string', 'max:2000'],
            'tone' => ['required', 'string', Rule::in(array_keys(self::toneOptions()))],
            'duration_seconds' => ['required', 'integer', Rule::in(array_keys(self::durationOptions()))],
            'platform' => ['required', 'string', Rule::in(array_keys(self::platformOptions()))],
            'language' => ['required', 'string', Rule::in(array_keys(self::languageOptions()))],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function platformOptions(): array
    {
        return [
            'tiktok' => 'TikTok',
            'youtube_shorts' => 'YouTube Shorts',
            'facebook_reels' => 'Facebook Reels',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function toneOptions(): array
    {
        return [
            'educational' => 'Educational',
            'funny' => 'Funny',
            'inspiring' => 'Inspiring',
            'neutral' => 'Neutral',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function languageOptions(): array
    {
        return [
            'vi' => 'Vietnamese',
            'en' => 'English',
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function durationOptions(): array
    {
        return [
            15 => '15 seconds',
            30 => '30 seconds',
            45 => '45 seconds',
            60 => '60 seconds',
        ];
    }
}
