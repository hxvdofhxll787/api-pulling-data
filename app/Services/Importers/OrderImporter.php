<?php

namespace App\Services\Importers;

use App\Models\Order;

class OrderImporter extends BaseImporter
{
    protected function endpoint(): string {
        return 'orders';
    }

    protected function save(array $data): void
    {
        // НЕ подобрал уникальный ключ, плюс нашел дупликаты, поэтому использую insert
        Order::insert($data);
    }
}
