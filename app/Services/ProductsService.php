<?php
namespace App\Services;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductsService {
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function getProducts($param, $limit): JsonResponse
    {
        $query = Product::query();
        if (!empty($param)) {
            $query->where(function ($subQuery) use ($param) {
                $subQuery->where('name', 'like', '%' . $param['name'] . '%');
            });
        }
        $products = $query->paginate($limit);
        return response()->json([
            'message' => 'Products fetched successfully!',
            'products' => ProductsResource::collection($products),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ],200);
    }

    public function storeProduct($param)
    {
        $validatedData = $param->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'origin' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|integer',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'files' => 'required'
        ]);
        $product = Product::create($validatedData);
        $this->fileUploadService->uploadFiles($param, $product);
        return response()->json([
            'message' => 'Product created successfully!',
            'product' => new ProductsResource($product),
        ], 201);
    }
    public function updateProduct($id, $param)
    {
        try{
            $product = Product::findOrFail($id);
            $product->update($param->all());
            $product->refresh();
            return new ProductsResource($product);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Products not found',
            ], 404);
        }

    }
    public function deleteProduct($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $paths = $product->file()->pluck('path')->toArray();
            $this->fileUploadService->deleteFile($paths);
            $product->file()->delete();
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully!',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Product delete falied',
            ], 404);
        }
    }
    public function showProduct($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json([
                'message' => 'Product retrieved successfully!',
                'product' => new ProductsResource($product),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }
    }

}
