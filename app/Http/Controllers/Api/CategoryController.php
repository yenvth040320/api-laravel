<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Category\CategoryService;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getCategories();
    
        return response()->json([$categories], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request);
        return response()->json(['category' => $category, 'msg' => 'Thêm danh mục thành công!'], 200);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryService->updateCategory($id, $request);
        return response()->json(['category' => $category, 'msg' => 'Cập nhật danh mục thành công!'], 200);
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['msg' => 'Xóa danh mục thành công!'], 200);
    }
}
