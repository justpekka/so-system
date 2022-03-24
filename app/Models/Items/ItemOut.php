<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemOut extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ["item_id", "item_out_quantity", "item_out_date"];
}
