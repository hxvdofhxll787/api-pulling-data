<?php

namespace App\Services\Importers;

use App\Models\Order;
use App\Services\ApiPullingDataClient;

class OrderImporter
{
    public function __construct(private ApiPullingDataClient $client) {
    }

    public function import(string $dateFrom, string $dateTo): void
    {
        $page = 1;
        $lastPage = 1;

        do {

            $response = $this->client->getData(
                'orders',
                [
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
                    'page' => $page,
                    'limit' => 500,
                ]
            );

            $data = $response['data'] ?? [];

            $lastPage = $response['meta']['last_page'] ?? 1;

            $this->save($data);

            echo "Page {$page}/{$lastPage} loaded successfully\n";

            sleep(1);

            $page++;

        } while ($page <= $lastPage);
    }

    private function save(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // НЕ подобрал уникальный ключ, плюс нашел дупликаты, поэтому использую insert
        Order::insert($data);
    }
}
