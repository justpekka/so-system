<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable("item_ins")) 
        {
        Schema::create('item_ins', function (Blueprint $table) {
            $table->id('item_in_id');
            $table->bigInteger('item_id', false, true);
            $table->integer('item_in_quantity', false, true);
            $table->timestamp('item_in_date');
            $table->timestamps();
            $table->softDeletes();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('item_ins');
    }
}
