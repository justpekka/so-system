<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use ItemLists;

class ItemOuts extends Model
{
    use HasFactory;

    protected $table = "item_outs";

    // public function itemWithStock()
    // {
    //     $this->join('item_lists', );

    // }
}
