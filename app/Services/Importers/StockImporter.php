<?php

namespace App\Services\Importers;

use App\Models\Stock;

class StockImporter extends BaseImporter
{
    protected function endpoint(): string {
        return 'stocks';
    }

    protected function requestParams(string $dateFrom, ?string $dateTo, int $page): array {
        return [
            'dateFrom' => $dateFrom,
            'page' => $page,
            'limit' => 500,
        ];
    }

    protected function save(array $data): void {
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
