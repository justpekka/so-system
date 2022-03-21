<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLists extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['item_code', 'item_name', 'item_description', 'item_category'];
    public $timestamps = true;
    protected $dateFormat = 'U';
}