<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::paginate(10);
        return response()->json([
            'status' => true,
            'items'  => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        return response()->json(['item' => Item::create($request->validated()), 'status' => true, 'message' => 'Item added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Item::find($request->post('id'));
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item not found'
            ], 404);
        }
        return response()->json(['item' => $item, 'status' => true, 'message' => 'Item fetched']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request)
    {
        $item = Item::find($request->post('id'));
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item not found'
            ], 404);
        }
        $item->update($request->validated());
        return response()->json(['item' => $item, 'status' => true, 'message' => 'Item updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Item::find($request->post('id'));
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item not found'
            ], 404);
        }
        $item->delete();
        return response()->json(['status' => true, 'message' => 'Item deleted']);
    }
}
