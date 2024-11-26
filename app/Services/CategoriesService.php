<?php
namespace App\Services;

use App\Models\Categories;
use App\Http\Resources\CategoriesResource;
class CategoriesService {
    public function getCategories(): \Illuminate\Http\JsonResponse
    {
        $categories = Categories::all();
        return response()->json([
            'message' => 'Categories fetched successfully!',
            'categories' => new CategoriesResource($categories),
        ],200);
    }
    public function storeCategory($param): \Illuminate\Http\JsonResponse
    {
        $category = Categories::create($param->all());
        return response()->json([
            'message' => 'Category created successfully!',
            'category' => new CategoriesResource($category),],
        );
    }
    public function updateCategory($id, $param): \Illuminate\Http\JsonResponse
    {
        $category = Categories::findOrFail($id);
        $category->update($param->all());
        $category->refresh();
        return response()->json([
            'message' => 'Category updated successfully!',
            'category' => new CategoriesResource($category),],
        );
    }
    public function deleteCategory($id): \Illuminate\Http\JsonResponse
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully!',
        ], 200);
    }
    public function showCategory($id): \Illuminate\Http\JsonResponse
    {
        $category = Categories::findOrFail($id);
        return response()->json([
            'message' => 'Category retrieved successfully!',
            'category' => new CategoriesResource($category),
        ], 200);
    }
}
