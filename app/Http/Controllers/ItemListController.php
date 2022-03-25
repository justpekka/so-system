<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Items\ItemIn;
use App\Models\Items\ItemOut;
use App\Models\Items\ItemList;

class ItemListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('items', ["session" => session()->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ItemList::select(['id', 'item_code', 'item_name', 'item_description', 'item_category'])
            ->where("item_code", $id)
            ->first();

        $result->item_in = ItemList::where('item_lists.id', $result->id)
            ->join('item_ins', 'item_lists.id', 'item_id')
            ->select('item_in_quantity', 'item_in_date')
            ->get();

        $result->item_out = ItemList::where('item_lists.id', $result->id)
            ->join('item_outs', 'item_lists.id', 'item_id')
            ->select('item_out_quantity', 'item_out_date')
            ->get();

        return view('items', ["session" => session()->all(), "result" => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
