<?php

namespace App\Http\Services\setting;

use App\Models\Setting\Location;
use Illuminate\Database\Eloquent\Collection;


class LocationService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return Location::query()->orderBy('name', 'ASC')->get();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return Location::query()->where('id', $payload)->first();
    }


    /**
     * @param $payload
     * @return Location
     */
    public function store($payload): Location
    {
        $location = new Location();
        $location->name = $payload['name'];
        $location->description = $payload['description'];
        $location->status = $payload['status'];
        $location->save();

        return $location;
    }

    /**
     * @param $location
     * @param $payload
     * @return void
     */
    public function update($location, $payload): void
    {
        $location->name = $payload['name'];
        $location->description = $payload['description'];
        $location->status = $payload['status'];
        $location->save();
    }

}
