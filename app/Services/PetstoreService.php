<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetstoreService
{
    protected string $baseUrl = 'https://petstore.swagger.io/v2';

    public function getPet(int $id)
    {
        return Http::get("{$this->baseUrl}/pet/{$id}");
    }

    public function findByStatus(string $status)
    {
        return Http::get("{$this->baseUrl}/pet/findByStatus", ['status' => $status]);
    }

    public function createPet(array $data)
    {
        return Http::post("{$this->baseUrl}/pet", $data);
    }

    public function updatePet(array $data)
    {
        return Http::put("{$this->baseUrl}/pet", $data);
    }

    public function deletePet(int $id)
    {
        return Http::delete("{$this->baseUrl}/pet/{$id}");
    }
}
