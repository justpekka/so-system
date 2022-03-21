<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Items\ItemLists;
use App\Models\Items\ItemIns;
use App\Models\Items\ItemOuts;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Database\QueryException;

class Items extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ItemLists::get();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_code' => ['required', 'unique:item_lists', 'max:100'],
            'item_name' => ['required'],
            'item_description' => ['nullable'],
            'item_category' => ['nullable'],
        ]);

        if( $validator->fails() ) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $item = ItemLists::insert($validator->validated());
            
            $response = [
                'message' => 'Item created successfully!',
                'result' => $item,
            ];
            return response()->json($response, Response::HTTP_CREATED);
         } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
         }
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
        $item = ItemLists::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'item_code' => ['required', 'unique:item_lists', 'max:100'],
            'item_name' => ['required'],
            'item_description' => ['nullable'],
            'item_category' => ['nullable'],
        ]);

        if( $validator->fails() ) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $item->update($validator->validated());
            
            $response = [
                'message' => 'Item updated successfully!',
                'result' =>  $item,
            ];
            return response()->json($response, Response::HTTP_CREATED);
         } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ItemLists::findOrFail($id);

        try {
            $item->delete();
            
            $response = [
                'message' => 'Item deleted successfully!',
            ];
            return response()->json($response, Response::HTTP_CREATED);
            
         } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
         }
    }
}
