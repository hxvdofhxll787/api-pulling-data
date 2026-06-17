<?php

namespace App\Services\Importers;

use App\Models\Sale;

class SaleImporter extends BaseImporter
{
    protected function endpoint(): string {
        return 'sales';
    }

    protected function requestParams(string $dateFrom, ?string $dateTo, int $page): array {
        return [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => 100,
        ];
    }

    protected function save(array $data): void {
        Sale::insert($data);
    }
}
