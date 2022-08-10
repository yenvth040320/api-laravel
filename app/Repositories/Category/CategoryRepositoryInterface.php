<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategories();

    public function createCategory($request);

    public function findCategory($id);

    public function updateCategory($id, $request);

    public function deleteCategory($id);
}
