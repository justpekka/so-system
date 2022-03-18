<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Items\ItemLists;
use App\Models\Items\ItemIns;
use App\Models\Items\ItemOuts;
use Symfony\Component\HttpFoundation\Response;

class Items extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = json_decode(
            ItemLists::select(['id', 'item_code', 'item_name', 'item_description', 'item_category'])->get()
        );

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

            // Remove uniqId
            // unset($value->id);

            /** @var Int $item_count must return a positive number */
            $item_count = $item_in - $item_out;
            // if( $item_count < 0 ) $item_count = "error";
            $result[$key]->item_status = ["inStock" => $item_count, "itemIn" => $item_in, "itemOut" => $item_out];
        }

        $response = [
            'message' => 'Data table found.',
            'result' => $result
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'item_code' => 'required',
            'item_name' => 'required',
            'item_description' => 'required',
            'item_category' => 'required',
        ]);

        if( !$validate ) return response("error.");

        // $result = ItemLists::insert([
        // ]);

        $response = [
            'message' => 'Item created successfully!',
            'result' => $request->all(),
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $result = ItemLists::where("item_code", $code)->firstOrFail();

        $result->item_in = ItemLists::where('item_lists.id', $result->id)
            ->join('item_ins', 'item_lists.id', 'item_id')
            ->select('item_in_quantity', 'item_in_date')
            ->get();

        $result->item_out = ItemLists::where('item_lists.id', $result->id)
            ->join('item_outs', 'item_lists.id', 'item_id')
            ->select('item_out_quantity', 'item_out_date')
            ->get();
        
        // Remove uniqId
        // unset($result['id']);

        $response = [
            'message' => 'Data detail found.',
            'result' => $result
        ];

        return response()->json($response, Response::HTTP_OK);
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
