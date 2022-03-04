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

    public function __invoke(Request $request)
    {
        return $this->index($request);
    }

    public function index(Request $request)
    {
        $result = json_decode(ItemLists::get());


        foreach($result as $key => $value)
        {
            $item_in = ItemLists::where('item_lists.id', $value->id)
                ->join('item_ins', 'item_lists.id', '=', 'item_id')
                ->select('item_in_quantity', 'item_in_date')
                ->sum('item_ins.item_in_quantity');
            $item_out = ItemLists::where('item_lists.id', $value->id)
                ->join('item_outs', 'item_lists.id', '=', 'item_id')
                ->select('item_out_quantity', 'item_out_date')
                ->sum('item_outs.item_out_quantity');

            /** @var Int $item_count must return a positive number */
            $item_count = $item_in - $item_out;
            // if( $item_count < 0 ) $item_count = "error";
            $result[$key]->item_status = ["inStock" => $item_count, "itemIn" => $item_in, "itemOut" => $item_out];
        }

        echo "<pre>";
        print_r($result);

        return;
    }

    public function detail(Request $request, $code = null)
    {
        $result = ItemLists::where("item_code", $code)->first();
        $result->item_in = ItemLists::where('item_lists.id', $result->id)
            ->join('item_ins', 'item_lists.id', 'item_id')
            ->select('item_in_quantity', 'item_in_date')
            ->get();
        $result->item_out = ItemLists::where('item_lists.id', $result->id)
            ->join('item_outs', 'item_lists.id', 'item_id')
            ->select('item_out_quantity', 'item_out_date')
            ->get();

        return response(["session" => session()->all(), "result" => $result], 200, ['content-type' => 'application/json']);
    }
}
