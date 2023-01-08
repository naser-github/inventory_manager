<?php

namespace App\Http\Services\setting;

use App\Models\Setting\Vendor;
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
        return Vendor::query()->where('id', $payload)->first();
    }


    /**
     * @param $payload
     * @return void
     */
    public function store($payload): void
    {
        $vendor = new Vendor();
        $vendor->name = $payload['name'];
        $vendor->status = $payload['status'];
        $vendor->save();
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

    /**
     * @param $payload
     * @return void
     */
    public function destroy($payload): void
    {
        Vendor::query()->where('id', $payload)->delete();
    }

    /**
     * @return Collection|array
     */
    public function vendorList(): Collection|array
    {
        return Vendor::query()
            ->select('id', 'name')
            ->where('status', true)
            ->get();
    }

}
