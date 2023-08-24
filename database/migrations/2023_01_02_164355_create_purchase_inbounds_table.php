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
        Schema::create('purchase_inbounds', function (Blueprint $table) {
            $table->id();
            $table->date('raised_date')->nullable();
            $table->string('purchase_inbound_number');
            $table->string('reference_invoice_number');
            $table->double('sub_total', 10, 2)->default(0);
            $table->double('others', 10, 2)->default(0);
            $table->double('grand_total', 10, 2)->default(0);
            $table->string('remarks')->nullable();

            $table->foreignId('location_id')->constrained('locations');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('vendor_id')->constrained('vendors');

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
        Schema::dropIfExists('purchase_inbounds');
    }
};
