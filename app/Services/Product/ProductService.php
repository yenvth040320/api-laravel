<?php 

namespace App\Services\Product;

use App\Services\BaseService;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductService extends BaseService
{
    protected $productRepo;
    
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getRepository()
    {

    }

    public function getProducts()
    {
        return $this->productRepo->getProducts();
    }

    public function getAll()
    {
        return $this->productRepo->getAll();
    }

    public function createProduct($request) 
    {
        return $this->productRepo->createProduct($request);
    }

    public function findProduct($id)
    {
        return $this->productRepo->findProduct($id);
    }

    public function updateProduct($id, $request) 
    {
        return $this->productRepo->updateProduct($id, $request);
    }

    public function deleteProduct($id) 
    {
        return $this->productRepo->deleteProduct($id);
    }

    public function productDetail($slug)
    {
        return $this->productRepo->productDetail($slug);
    }
}