<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private $units;
    private $categories;
    private $activeStatus;
    private $tags;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->loadUnits();
        $this->loadCategories();
        $this->loadTags();
        $this->seedProducts();
    }

    private function seedProducts()
    {
        $fruits = ProductElements::getFruitProducts();
        foreach ($fruits as $fruit){
            $this->createProduct($fruit['tags'] ,$fruit['unit'], "fruits", $fruit['sku'], $fruit['name'], $fruit['description'], $fruit['regularPrice'], NULL);
        }
        $pulps = ProductElements::getPulpFruitProducts();
        foreach ($pulps as $pulp){
            $this->createProduct($pulp['tags'] ,$pulp['unit'], "pulps", $pulp['sku'], $pulp['name'], $pulp['description'], $pulp['regularPrice'], NULL);
        }
        $vegetables = ProductElements::getVegetableProducts();
        foreach ($vegetables as $vegetable){
            $this->createProduct($vegetable['tags'] ,$vegetable['unit'], "vegetables", $vegetable['sku'], $vegetable['name'], $vegetable['description'], $vegetable['regularPrice'], NULL);
        }
    }



    private function createProduct($tags, $unit, $category, $sku, $name, $description, $regularPrice, $discountPrice = null, $taxable = false)
    {
        if(!isset($this->units[$unit]))
            return false;
        $product = $this->makeProduct($sku, $name, $description, $regularPrice, $discountPrice, $taxable);
        $product->unit()->associate($this->units[$unit]);
        $product->save();
        if(isset($this->categories[$category]))
            $product->categories()->attach($this->categories[$category]);
        foreach ($tags as $tag){
            if(isset($this->tags[$tag])){
                $product->tags()->attach($this->tags[$tag]);
            }
        }
    }

    /**
     * @param $sku
     * @param $name
     * @param $description
     * @param $regularPrice
     * @param $discountPrice
     * @param bool $taxable
     * @return Product
     */
    private function makeProduct($sku, $name, $description, $regularPrice, $discountPrice, $taxable = false)
    {
        $this->activeStatus = is_null($this->activeStatus) ? ProductStatus::where("rendering", "success")->first() : $this->activeStatus;
        $product = Product::make([
            'sku' => $sku,
            'name' => $name,
            'description' => $description,
            'regular_price' => $regularPrice,
            'discount_price' => $discountPrice,
            'taxable' => $taxable
        ]);
        $product->status()->associate($this->activeStatus);
        return $product;
    }

    private function loadUnits()
    {
        $units = Unit::all();
        foreach ($units  as $unit){
            $this->units[$unit->code] = $unit;
        }
    }

    private function loadCategories()
    {
        $categories = Category::all();
        foreach ($categories  as $category){
            $this->categories[$category->code] = $category;
        }
    }

    private function loadTags()
    {
        $tags = Tag::all();
        foreach ($tags  as $tag){
            $this->tags[$tag->name] = $tag;
        }
    }
}
