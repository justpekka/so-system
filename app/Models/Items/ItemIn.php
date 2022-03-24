<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemIn extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["item_id", "item_in_quantity", "item_in_date"];
}
