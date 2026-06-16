<?php

namespace App\Services\Importers;

use App\Models\Income;
use App\Services\ApiPullingDataClient;

class IncomeImporter
{
    public function __construct(private ApiPullingDataClient $client) {
    }

    public function import(string $dateFrom, string $dateTo): void
    {
        $page = 1;
        $lastPage = 1;

        do {
            $response = $this->client->getData(
                'incomes',
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

            $page++;

        } while ($page <= $lastPage);
    }
    private function save(array $data): void {
        if (empty($data)) {
            return;
        }

        Income::upsert(
            $data,
            ['income_id', 'barcode', 'nm_id'],
            [
                'number',
                'date',
                'last_change_date',
                'supplier_article',
                'tech_size',
                'quantity',
                'total_price',
                'date_close',
                'warehouse_name',
            ],
        );
    }
}
