<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLists extends Model
{
    use HasFactory;

    protected $id = 'item_id';

    public function getItems()
    {
        $result = json_decode(ItemLists::get());

        foreach($result as $key => $value)
        {
            $result[$key]->item_log = [
                "item_in" => ItemLists::find($value->id)
                    ->join('item_ins', 'item_lists.id', '=', 'item_id')
                    ->select('item_in_quantity', 'item_in_date')
                    ->sum('item_in_quantity'),
                "item_out" => ItemLists::find($value->id)
                    ->join('item_outs', 'item_lists.id', '=', 'item_id')
                    ->select('item_out_quantity', 'item_out_date')
                    ->sum('item_out_quantity')
            ];
        };
    }
    
}
