<?php

namespace App\Services\Importers;

use App\Models\Sale;
use App\Services\ApiPullingDataClient;

class SaleImporter
{
    public function __construct(private ApiPullingDataClient $client) {
    }

    public function import(string $dateFrom, string $dateTo): void
    {
        $page = 1;
        $lastPage = 1;

        do {
            $response = $this->client->getData(
                'sales',
                [
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
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
    private function save(array $data): void {
        if (empty($data)) {
            return;
        }

        Sale::upsert(
            $data,
            ['sale_id'],
            [
                'g_number',
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'barcode',
                'total_price',
                'discount_percent',
                'is_supply',
                'is_realization',
                'promo_code_discount',
                'warehouse_name',
                'country_name',
                'oblast_okrug_name',
                'region_name',
                'income_id',
                'odid',
                'spp',
                'for_pay',
                'finished_price',
                'price_with_disc',
                'nm_id',
                'subject',
                'category',
                'brand',
                'is_storno',
            ],
        );
    }
}
