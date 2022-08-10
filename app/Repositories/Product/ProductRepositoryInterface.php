<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getProducts();

    public function createProduct($request);

    public function findProduct($id);

    public function updateProduct($id, $request);

    public function deleteProduct($id);

    public function productDetail($slug);

}