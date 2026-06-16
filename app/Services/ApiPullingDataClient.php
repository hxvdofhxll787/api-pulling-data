<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiPullingDataClient
{
    public function getData(string $endpoint, array $params = []): array
    {
        $response = Http::retry(5, 5000)->get(
            config('services.pulling_data.url') . '/' . $endpoint,
            array_merge(
                $params,
                ['key' => config('services.pulling_data.key'),],
            )
        );

        $response->throw();

        return $response->json();
    }
}
