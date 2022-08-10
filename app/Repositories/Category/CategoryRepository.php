<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategories()
    {
        return $this->model->all();
    }

    public function createCategory($request)
    {
        return $this->model->create([
            'name' => $request->name
        ]);
    }

    public function findCategory($id)
    {
        return $this->model->find($id);
    }

    public function updateCategory($id, $request)
    {
        $category = $this->model->find($id);
        $category->name = $request->name;
        $category->save();
        return $category;
    }

    public function deleteCategory($id) 
    {
        $category = $this->model->find($id);
        return $category->delete();
    }
}