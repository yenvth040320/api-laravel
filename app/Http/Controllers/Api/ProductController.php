<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getProducts();
        return response()->json(['products' => $products], 200);
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request);
        return response()->json(['product' => $product, 'msg' => 'Thêm sản phẩm thành công!'], 200);
    }

    public function show($id)
    {
        $product = $this->productService->findProduct($id);
        return response()->json(['product' => $product], 200);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request);
        return response()->json(['product' => $product, 'msg' => 'Cập nhật sản phẩm thành công!'], 200);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['msg' => 'Xóa sản phẩm thành công!'], 200);
    }
}
