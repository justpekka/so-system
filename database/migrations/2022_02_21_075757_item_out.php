<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemOut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable("item_outs")) 
        {
        Schema::create('item_outs', function (Blueprint $table) {
            $table->id('item_out_id');
            $table->bigInteger('item_id', false, true);
            $table->integer('item_out_quantity', false, true);
            $table->timestamp('item_out_date');
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
        // Schema::dropIfExists('item_outs');
    }
}
