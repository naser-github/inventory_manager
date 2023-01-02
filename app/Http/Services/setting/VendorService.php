<?php

namespace App\Http\Services\setting;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;


class VendorService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return Vendor::query()->orderBy('name', 'ASC')->get();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return Vendor::query()
            ->where('id', $payload)
            ->first();
    }


    /**
     * @param $payload
     * @return Vendor
     */
    public function store($payload): Vendor
    {
        $vendor = new Vendor();
        $vendor->name = $payload['name'];
        $vendor->status = $payload['status'];
        $vendor->save();

        return $vendor;
    }

    /**
     * @param $vendor
     * @param $payload
     * @return void
     */
    public function update($vendor, $payload): void
    {
        $vendor->name = $payload['name'];
        $vendor->status = $payload['status'];
        $vendor->save();
    }

}
