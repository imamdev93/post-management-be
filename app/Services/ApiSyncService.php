<?php

namespace App\Services;

use App\Models\Post;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ApiSyncService
{

    public function syncData()
    {
        try {
            $apiUrl = config('app.external_api_url');

            $response = Http::get($apiUrl);

            if ($response === null) {
                throw new \Exception('HTTP client returned null response');
            }

            if (!$response->successful()) {
                throw new \Exception('API request failed');
            }

            $data = $response->json();
            $syncedCount = 0;
            $categories = ['Technology', 'Business', 'Entertainment', 'Science', 'Sports'];

            foreach ($data as $item) {
                $category = $categories[$item['id'] % count($categories)];
                $releaseDate = Carbon::now()->subDays(rand(1, 365))->format('Y-m-d');

                Post::updateOrCreate(
                    ['external_id' => $item['id']],
                    [
                        'user_id' => $item['userId'],
                        'title' => $item['title'],
                        'body' => $item['body'],
                        'category' => $category,
                        'release_date' => $releaseDate,
                        'last_synced_at' => now()
                    ]
                );

                $syncedCount++;
            }

            SyncLog::create([
                'synced_at' => now(),
                'records_synced' => $syncedCount,
                'status' => 'success'
            ]);

            return [
                'success' => true,
                'message' => "Successfully synced {$syncedCount} records",
                'synced_at' => now(),
                'records_synced' => $syncedCount
            ];
        } catch (\Exception $e) {
            SyncLog::create([
                'synced_at' => now(),
                'records_synced' => 0,
                'status' => 'failed'
            ]);

            return [
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ];
        }
    }

    public function getLastSync()
    {
        return SyncLog::latest('synced_at')->first();
    }
}
