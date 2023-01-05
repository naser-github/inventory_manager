<?php

namespace App\Http\Services\setting;

use App\Models\Setting\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return Item::query()->orderBy('name', 'ASC')->get();
    }


    public function findById($payload): object|null
    {
        return Item::query()->where('id', $payload)->first();
    }


    /**
     * @param $payload
     * @return Item
     */
    public function store($payload): Item
    {
        $item = new Item();
        $item->name = $payload['name'];
        $item->status = $payload['status'];
        $item->master_category_id = $payload['master_category'];
        $item->level_one_category_id = $payload['level_one_category'];
        $item->level_two_category_id = $payload['level_two_category'];
        $item->save();

        return $item;
    }

    public function update($item, $payload): void
    {
        $item->name = $payload['name'];
        $item->status = $payload['status'];
        $item->master_category_id = $payload['master_category'];
        $item->level_one_category_id = $payload['level_one_category'];
        $item->level_two_category_id = $payload['level_two_category'];
        $item->save();
    }

    public function destroy($payload){
        $payload->delete();
    }

}
