<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ItemLists;

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
            $result[$key] = 
                json_decode(
                    ItemLists::where('item_lists.item_id', $value->item_id)->join('item_logs', 'item_lists.item_id', '=', 'item_logs.item_id')->select('item_log_quantity')->get()
                );
        }

        echo "<pre>";
        print_r($result);

        return;
    }
}
