<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Items\ItemLists;
use App\Models\Items\ItemIns;
use App\Models\Items\ItemOuts;

class ItemLogsController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, $code = null)
    {
        return $this->index($request, $code);
    }

    public function index(Request $request, $code = null)
    {
        $result = json_decode(ItemLists::where("item_code", $code)->first());
        $result->item_in = json_decode(
            ItemLists::where('item_lists.id', $result->id)
            ->join('item_ins', 'item_lists.id', '=', 'item_id')
            ->select('item_in_quantity', 'item_in_date')
            ->get()
        );
        $result->item_out = json_decode(
            ItemLists::where('item_lists.id', $result->id)
            ->join('item_outs', 'item_lists.id', '=', 'item_id')
            ->select('item_out_quantity', 'item_out_date')
            ->get()
        );

        return response(["session" => session()->all(), "result" => $result], 200, ['content-type' => 'application/json']);
    }
}
