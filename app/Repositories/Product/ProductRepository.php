<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Purifier;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use StorageImage;
    
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProducts()
    {
        return $this->model->latest()->get();
    }

    public function createProduct($request)
    {
        $dataInsert = [
            'code' => $request->code,
            'name' => $request->name,
            'description' =>  Purifier::clean($request->description),
            'price' => $request->price,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
        ];

        $dataImage = $this->storageUpload($request, 'image_url', 'product');
    
        if(!empty($dataImage)){
            $dataInsert['image_url'] = $dataImage['file_path'];
        }
        $product = $this->model->create($dataInsert);

        // Insert tag

        if(!empty($request->tag)){
            foreach($request->tag as $tag) {
                $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                $tagIds[] = $tagInstance->id;
            }
        }
        $product->tags()->attach($tagIds);
        return $product;
    }

    public function findProduct($id)
    {
        return $this->model->find($id);
    }

    public function updateProduct($id, $request)
    {
        $dataUpdate = [
            'code' => $request->code,
            'name' => $request->name,
            'description' =>  Purifier::clean($request->input('description')),
            'price' => $request->price,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
        ];

        $dataImage = $this->storageUpload($request, 'image_url', 'product');
        if(!empty($dataImage)){
            $dataUpdate['image_url'] = $dataImage['file_path'];
        }
        $product =  $this->model->find($id);
        $product->update($dataUpdate);

        // Insert tag
        if(!empty($request->tag)){
            foreach($request->tag as $tag) {
                $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                $tagIds[] = $tagInstance->id;
            }
        }
        $product->tags()->sync($tagIds);
        return $product;
    }

    public function deleteProduct($id) 
    {
        $product =  $this->model->find($id);
        $product->tags()->detach();
        return $product->delete();
    }

    public function productDetail($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}