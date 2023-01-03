<?php

namespace App\Http\Services\setting\Category;


use App\Models\Setting\MasterCategory;
use Illuminate\Database\Eloquent\Collection;


class MasterCategoryService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return MasterCategory::query()->orderBy('name', 'ASC')->get();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return MasterCategory::query()->where('id', $payload)->first();
    }


    /**
     * @param $payload
     * @return void
     */
    public function store($payload): void
    {
        $master_category = new MasterCategory();
        $master_category->name = $payload['name'];
        $master_category->status = $payload['status'];
        $master_category->save();
    }

    /**
     * @param $master_category
     * @param $payload
     * @return void
     */
    public function update($master_category, $payload): void
    {
        $master_category->name = $payload['name'];
        $master_category->status = $payload['status'];
        $master_category->save();
    }

    /**
     * @param $payload
     * @return void
     */
    public function destroy($payload): void
    {
        MasterCategory::query()->where('id', $payload)->delete();
    }

}
