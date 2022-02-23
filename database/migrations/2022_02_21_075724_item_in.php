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
            $table->id('id');
            $table->foreignId('item_id')->constrained('items', 'id');
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
