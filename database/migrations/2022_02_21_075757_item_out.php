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
                $table->id('id');
                $table->foreignId('item_id')->constrained('items', 'id');
                $table->integer('item_out_quantity', false, true);
                $table->timestamp('item_out_date');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
