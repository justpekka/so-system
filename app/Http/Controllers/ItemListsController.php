<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Items\ItemLists;
use App\Models\Items\ItemIns;
use App\Models\Items\ItemOuts;

class ItemListsController extends Controller
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        return $this->index();
    }

    public function index()
    {
        $result = json_decode(ItemLists::get());

        foreach($result as $key => $value)
        {
            $result[$key]->item_log = [
                "item_in" => json_decode(
                    ItemLists::where('item_lists.item_id', $value->item_id)
                    ->join('item_ins', 'item_lists.item_id', '=', 'item_ins.item_id')
                    ->select('item_in_quantity', 'item_in_date')
                    ->sum('item_in_quantity')
                ),
                "item_out" => json_decode(
                    ItemLists::where('item_lists.item_id', $value->item_id)
                    ->join('item_outs', 'item_lists.item_id', '=', 'item_outs.item_id')
                    ->select('item_out_quantity', 'item_out_date')
                    ->sum('item_out_quantity')
            )];
        }

        echo "<pre>";
        print_r($result);

        return;
    }
}
