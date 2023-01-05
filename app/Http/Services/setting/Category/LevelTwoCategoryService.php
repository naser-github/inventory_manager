<?php

namespace App\Http\Services\setting\Category;

use App\Models\Setting\LevelTwoCategory;
use Illuminate\Database\Eloquent\Collection;


class LevelTwoCategoryService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return LevelTwoCategory::query()
            ->with(['master_category','level_one_category'])
            ->orderBy('name', 'ASC')
            ->get();
    }

    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return LevelTwoCategory::query()->where('id', $payload)->first();
    }

    /**
     * @param $payload
     * @return void
     */
    public function store($payload): void
    {
        $level_two_category = new LevelTwoCategory();
        $level_two_category->name = $payload['name'];
        $level_two_category->status = $payload['status'];
        $level_two_category->master_category_id = $payload['master_category'];
        $level_two_category->level_one_category_id = $payload['level_one_category'];
        $level_two_category->save();
    }

    /**
     * @param $level_two_category
     * @param $payload
     * @return void
     */
    public function update($level_two_category, $payload): void
    {
        $level_two_category->name = $payload['name'];
        $level_two_category->status = $payload['status'];
        $level_two_category->master_category_id = $payload['master_category'];
        $level_two_category->level_one_category_id = $payload['level_one_category'];
        $level_two_category->save();
    }

    /**
     * @param $payload
     * @return void
     */
    public function destroy($payload): void
    {
        LevelTwoCategory::query()->where('id', $payload)->delete();
    }

    /**
     * @return Collection
     */
    public function levelTwoCategoryList(): Collection
    {
        return LevelTwoCategory::query()
            ->where('status', '=', 1)
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();
    }

}
