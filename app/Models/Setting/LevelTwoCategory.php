<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelTwoCategory extends Model
{
    use HasFactory;

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'level_one_category_id', 'id');
    }}
