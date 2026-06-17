<?php

namespace App\Services\Importers;

use App\Models\Income;

class IncomeImporter extends BaseImporter
{
    protected function endpoint(): string {
        return 'incomes';
    }

    protected function save(array $data): void {
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
