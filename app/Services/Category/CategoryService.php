<?php 

namespace App\Services\Category;

use App\Services\BaseService;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    protected $categoryRepo;
    
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getRepository()
    {

    }

    public function getCategories()
    {
        return $this->categoryRepo->getCategories();
    }

    public function createCategory($request) 
    {
        return $this->categoryRepo->createCategory($request);
    }

    public function findCategory($id)
    {
        return $this->categoryRepo->findCategory($id);
    }

    public function updateCategory($id, $request) 
    {
        return $this->categoryRepo->updateCategory($id, $request);
    }

    public function deleteCategory($id) 
    {
        return $this->categoryRepo->deleteCategory($id);
    }
}