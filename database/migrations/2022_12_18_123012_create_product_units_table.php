<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_units', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string("unit_id");
            $table->foreign("unit_id")->references("id")->on("units");
            $table->string("product_id");
            $table->foreign("product_id")->references("id")->on("products");
            $table->unsignedFloat("amount",20,10);
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
        Schema::dropIfExists('product_units');
    }
};
