<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return $this->sendResponse(ProductResources::collection($product), 'product returned');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if ($validator->fails())
            return $this->sendError('validator error', $validator->errors());
        $product = Product::create($input);
        return $this->sendResponse(new ProductResource($product), 'product is created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $val = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if ($val->fails())
            return $this->sendError('validation error', $val->errors());
        $product = Product::create($input);
        return $this->sendResponse(new ProductResource($val), 'created');
    }

    public function show(string $id): JsonResponse
    {
        $product = Product::find($id);
        if (is_null($product))
            return $this->sendError('not found');
        return $this->sendResponse(new ProductResource($product), 'returned');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $input = $request->all();
        $val = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if ($val->fails())
            return $this->sendError('validation error', $val->errors());
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();
        return $this->sendResponse(new ProductResource($product), 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->sendResponse([],'deleted');
    }
}
