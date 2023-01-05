<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    public function master_category(): BelongsTo
    {
        return $this->belongsTo(MasterCategory::class, 'master_category_id', 'id');
    }

    public function level_one_category(): BelongsTo
    {
        return $this->belongsTo(LevelOneCategory::class, 'level_one_category_id', 'id');
    }

    public function level_two_category(): BelongsTo
    {
        return $this->belongsTo(LevelTwoCategory::class, 'level_two_category_id', 'id');
    }
}
