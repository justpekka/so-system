<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['item_code', 'item_name', 'item_description', 'item_category'];

    public function itemIns()
    {
        return $this->hasMany(ItemIns::class, 'item_id');
    }

    public function itemOuts()
    {
        return $this->hasMany(ItemOuts::class, 'item_id');
    }
}