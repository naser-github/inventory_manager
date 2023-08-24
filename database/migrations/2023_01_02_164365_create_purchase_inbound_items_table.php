<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_inbound_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_inbound_id')->constrained('purchase_inbounds');
            $table->foreignId('item_id')->constrained('items');

            $table->double('quantity', 8, 2)->default(0);
            $table->double('unit_price', 8, 2)->default(0);
            $table->double('sub_total', 8, 2)->default(0);
            $table->double('vat', 8, 2)->default(0);
            $table->double('total', 8, 2)->default(0);
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_inbound_items');
    }
};
