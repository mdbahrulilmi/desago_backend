<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\SocialMedia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadGoogleAvatarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 20;

    public function __construct(
        public string $avatarUrl,
        public int $userId,
        public int $socialId
    ) {}

    public function handle(): void
    {
        // 1. Download avatar dari Google
        $response = Http::timeout(10)->get($this->avatarUrl);
        if (!$response->successful()) {
            return;
        }

        // 2. Resize & kompres (hemat storage)
        $manager = new ImageManager(new Driver());

        $image = $manager
            ->read($response->body())
            ->cover(256, 256)
            ->toWebp(60);

        $path = 'avatar/google_' . $this->userId . '.webp';

        // 3. Upload ke Supabase
        Storage::disk('supabase')->put(
            $path,
            (string) $image,
            'public'
        );

        // 4. Update user & social account
        User::where('id', $this->userId)->update([
            'avatar' => $path
        ]);

        SocialMedia::where('id', $this->socialId)->update([
            'avatar' => $path
        ]);
    }
}
