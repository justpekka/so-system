<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable("item_lists")) 
        {
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('item_code', 100)->unique();
            $table->string('item_name', 255);
            $table->text('item_description')->nullable(true);
            $table->json('item_category')->nullable(true);
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
        // Schema::dropIfExists('item_lists');
    }
}
