<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Items\ItemList;
use App\Models\Items\ItemIn;
use App\Models\Items\ItemOut;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Database\QueryException;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ItemList::get();

        foreach($result as $key => $value)
        {
            $result[$key]["itemIn"] = ItemIn::where('item_id', $value->id)->sum('item_ins.item_in_quantity');
            $result[$key]["itemOut"] = ItemOut::where('item_id', $value->id)->sum('item_outs.item_out_quantity');
            $result[$key]["inStock"] = $result[$key]["itemIn"] - $result[$key]["itemOut"];
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
        $result = ItemList::where("item_code", $code)->firstOrFail();
        
        $result->item_in = ItemIn::where('item_id', $result->id)->get();
        $result->item_out = ItemOut::where('item_id', $result->id)->get();
        
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

        $item = $validator->validated();
        $item["item_code"] = strtolower($item['item_code']);
        $item['item_category'] = is_array($item['item_category']) == true ? json_encode($item['item_category']) : $item['item_category'];

        try {
            $result = ItemList::create($item);
            
            $response = [
                'message' => 'Item created successfully!',
                'result' => $result,
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
        $item = ItemList::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // 'item_code' => ['required', 'unique:item_lists', 'max:100'],
            'item_code' => ['required', 'max:100'],
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
            return response()->json($response, Response::HTTP_OK);
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
        $item = ItemList::findOrFail($id);

        try {
            $item->update(['item_code' => $item->item_code.':deleted']);
            $item->delete();
            
            $response = [
                'message' => 'Item deleted successfully!',
                'result' => $item,
            ];
            return response()->json($response, Response::HTTP_OK);
            
         } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
         }
    }


   public function stockIn(Request $request, $item = null)
   {
        $validator = Validator::make($request->all(), [
            'item_out_quantity' => ['required', 'integer']
        ]);
        if( $validator->fails() ) return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        $validated = $validator->validated();
        $validated["item_id"] = ItemList::where("item_code", $item)->firstOrFail()['id'];

        try {
            $item = ItemIn::create($validated);
            
            $response = [
                'message' => 'Stock Item taken!',
                'result' => $item,
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
        }
    }

    public function stockOut(Request $request, $item)
    {
        $validator = Validator::make($request->all(), [
            'item_out_quantity' => ['required', 'integer']
        ]);
        if( $validator->fails() ) return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        $validated = $validator->validated();
        $validated["item_id"] = ItemList::where("item_code", $item)->firstOrFail()['id'];

        try {
            $item = ItemOut::create($validated);
            
            $response = [
                'message' => 'Stock Item taken!',
                'result' => $item,
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch(QueryException $e) {
            return response()->json([
                'message' => 'There are some error(s)! ' . $e->errorInfo,
            ]);
        }
    }
}
