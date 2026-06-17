<?php

namespace App\Services\Importers;

use App\Services\ApiPullingDataClient;

abstract class BaseImporter
{
    public function __construct(protected ApiPullingDataClient $client) {
    }

    abstract protected function endpoint(): string;

    abstract protected function save(array $data): void;

    protected function requestParams(string $dateFrom, ?string $dateTo, int $page): array {
        return [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => 500,
        ];
    }

    public function import(string $dateFrom, ?string $dateTo = null): void {
        $page = 1;
        $lastPage = 1;

        do {
            $response = $this->client->getData(
                $this->endpoint(),
                $this->requestParams($dateFrom, $dateTo, $page),
            );

            $data = $response['data'] ?? [];

            $lastPage = $response['meta']['last_page'] ?? 1;

            $this->save($data);

            echo "Page {$page}/{$lastPage} loaded successfully \n";

            sleep(1);

            $page++;

        } while ($page <= $lastPage);
    }
}
