<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Http\Resources\ProductsResource;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

#[AllowDynamicProperties]
class ProductsController extends Controller
{
    public function __construct( ProductsService $productService)
    {
       return  $this->productService = $productService;
    }
    public function index(Request $request)
    {
      return $this->productService->getProducts($request->all(), $request->page ?? 10) ;
    }

    public function store(Request $request): JsonResponse
    {
        return $this->productService->storeProduct($request);
    }
    public function update($id, Request $request): JsonResponse
    {
        $productResource = $this->productService->updateProduct($id, $request);
        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $productResource,
        ], 200);
    }
    public function destroy($id): JsonResponse
    {
        return $this->productService->deleteProduct($id);
    }
    public function show($id): JsonResponse
    {
        return $this->productService->showProduct($id);
    }
}
