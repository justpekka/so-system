<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use ItemLists;

class Items extends Model
{
    use HasFactory;

    protected $table = "item_logs";

    // public function itemWithStock()
    // {
    //     $this->join('item_lists', );

    // }
}
