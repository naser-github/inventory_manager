<?php

namespace App\Models;

use App\Models\Setting\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseInboundItem extends Model
{
    use HasFactory;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function purchaseInbound(): BelongsTo
    {
        return $this->belongsTo(PurchaseInbound::class, 'purchase_inbound_id', 'id');
    }

}
