<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Auth\Controller;
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
        return $this->sendResponse(ProductResource::collection($product), 'product returned');

    }

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

    public function edit(string $id)
    {
        //
    }

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

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->sendResponse([],'deleted');
    }
}
