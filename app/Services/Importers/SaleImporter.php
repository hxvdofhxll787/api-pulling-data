<?php

namespace App\Services\Importers;

use App\Models\Sale;

class SaleImporter extends BaseImporter
{
    protected function endpoint(): string {
        return 'sales';
    }

    protected function save(array $data): void {
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
