<?php

namespace App\Http\Services\setting\Category;

use App\Models\Setting\LevelOneCategory;
use Illuminate\Database\Eloquent\Collection;


class LevelOneCategoryService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return LevelOneCategory::query()
            ->with(['master_category'])
            ->orderBy('name', 'ASC')
            ->get();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return LevelOneCategory::query()->where('id', $payload)->first();
    }


    /**
     * @param $payload
     * @return void
     */
    public function store($payload): void
    {
        $level_one_category = new LevelOneCategory();
        $level_one_category->name = $payload['name'];
        $level_one_category->status = $payload['status'];
        $level_one_category->master_category_id = $payload['master_category'];
        $level_one_category->save();
    }

    /**
     * @param $level_one_category
     * @param $payload
     * @return void
     */
    public function update($level_one_category, $payload): void
    {
        $level_one_category->name = $payload['name'];
        $level_one_category->status = $payload['status'];
        $level_one_category->master_category_id = $payload['master_category'];
        $level_one_category->save();
    }

    /**
     * @param $payload
     * @return void
     */
    public function destroy($payload): void
    {
        LevelOneCategory::query()->where('id', $payload)->delete();
    }

    /**
     * @return Collection
     */
    public function levelOneCategoryList(): Collection
    {
        return LevelOneCategory::query()
            ->where('status', '=', 1)
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
    }

}
