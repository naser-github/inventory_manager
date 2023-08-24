<?php

namespace App\Models;

use App\Models\Setting\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseInbound extends Model
{
    use HasFactory;

    public function purchaseInboundItems(): HasMany
    {
        return $this->hasMany(PurchaseInboundItem::class, 'purchase_inbound_id', 'id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
