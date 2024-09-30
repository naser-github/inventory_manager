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
        return Item::query()
            ->with(['master_category', 'level_one_category', 'level_two_category'])
            ->orderBy('name', 'ASC')
            ->get();
    }


    /**
     * @param $payload
     * @return object|null
     */
    public function findById($payload): object|null
    {
        return Item::query()->where('id', $payload)->first();
    }

    /**
     * @param $payload
     * @return object|null
     * WMLL means with master category, Level One Category, Level Two Category,
     */
    public function findByIdWMLL($payload): object|null
    {
        return Item::query()
            ->with(['master_category', 'level_one_category', 'level_two_category'])
            ->where('id', $payload)
            ->first();
    }

    /**
     * @param $payload
     * @return Item
     */
    public function store($payload): Item
    {
        $item = new Item();
        $item->name = $payload['name'];
        $item->unit = $payload['unit_name'];
        $item->status = $payload['status'];
        $item->master_category_id = $payload['master_category'];
        $item->level_one_category_id = $payload['level_one_category'];
//        $item->level_two_category_id = $payload['level_two_category'];
        $item->save();

        return $item;
    }

    public function update($item, $payload): void
    {
        $item->name = $payload['name'];
        $item->unit = $payload['unit_name'];
        $item->status = $payload['status'];
        $item->master_category_id = $payload['master_category'];
        $item->level_one_category_id = $payload['level_one_category'];
        $item->level_two_category_id = $payload['level_two_category'];
        $item->save();
    }

    /**
     * @param $payload
     * @return void
     */
    public function destroy($payload): void
    {
        $payload->delete();
    }

    /**
     * @return Collection|array
     */
    public function itemList(): Collection|array
    {
        return Item::query()
            ->select('id', 'name', 'unit')
            ->where('status', true)
            ->get();
    }

}
