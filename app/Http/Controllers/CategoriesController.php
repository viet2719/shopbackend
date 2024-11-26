<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categoriesService;
    public function __construct( CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->categoriesService->getCategories();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->categoriesService->storeCategory($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id): \Illuminate\Http\JsonResponse
    {
        return $this->categoriesService->showCategory($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->categoriesService->updateCategory($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id): \Illuminate\Http\JsonResponse
    {
        return $this->categoriesService->deleteCategory($id);
    }
}
