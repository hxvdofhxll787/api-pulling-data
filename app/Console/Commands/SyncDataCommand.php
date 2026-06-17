<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Services\Importers\IncomeImporter;
use App\Services\Importers\OrderImporter;
use App\Services\Importers\SaleImporter;
use App\Services\Importers\StockImporter;

#[Signature('app:sync-data')]
#[Description('Import all data from API')]
class SyncDataCommand extends Command
{
    public function handle(
        IncomeImporter $incomeImporter,
        OrderImporter $orderImporter,
        SaleImporter $saleImporter,
        StockImporter $stockImporter,
    ): int {
        $this->info('Start importing incomes:');
        $incomeImporter->import('2020-01-01', '2026-12-31');


        $this->info('Start importing orders:');
        $orderImporter->import('2020-01-01', '2026-12-31');


        $this->info('Start importing sales:');
        $saleImporter->import('2020-01-01', '2026-12-31');


        $this->info('Start importing stocks:');
        $stockImporter->import(now()->format('Y-m-d'));

        $this->info('Finished importing data');

        return self::SUCCESS;
    }
}
