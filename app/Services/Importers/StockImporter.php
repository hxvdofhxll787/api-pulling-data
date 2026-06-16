<?php

namespace App\Services\Importers;

use App\Models\Stock;
use App\Services\ApiPullingDataClient;

class StockImporter
{
    public function __construct(private ApiPullingDataClient $client)
    {
    }

    public function import(string $dateFrom): void
    {
        $page = 1;
        $lastPage = 1;

        do {
            $response = $this->client->getData(
                'stocks',
                [
                    'dateFrom' => $dateFrom,
                    'page' => $page,
                    'limit' => 500,
                ]
            );

            $data = $response['data'] ?? [];

            $lastPage = $response['meta']['last_page'];

            $this->save($data);

            echo "Page {$page}/{$lastPage} loaded successfully \n";

            sleep(1);

            $page++;

        } while ($page <= $lastPage);
    }

    private function save(array $data): void
    {
        if (empty($data)) {
            return;
        }

        Stock::upsert(
            $data,
            ['sc_code', 'barcode', 'nm_id'],
            [
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'quantity',
                'is_supply',
                'is_realization',
                'quantity_full',
                'warehouse_name',
                'in_way_to_client',
                'in_way_from_client',
                'subject',
                'category',
                'brand',
                'price',
                'discount',
            ],
        );
    }
}
