<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private $units;
    private $categories;
    private $activeStatus;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->loadUnits();
        $this->loadCategories();

        $this->seedProducts();
    }

    private function seedProducts()
    {
        $fruits = ProductElements::getFruitProducts();
        foreach ($fruits as $fruit){
            $this->createProduct($fruit['unit'], "fruits", $fruit['sku'], $fruit['name'], $fruit['description'], $fruit['regularPrice'], NULL);
        }
        $pulps = ProductElements::getPulpFruitProducts();
        foreach ($pulps as $pulp){
            $this->createProduct($pulp['unit'], "pulps", $pulp['sku'], $pulp['name'], $pulp['description'], $pulp['regularPrice'], NULL);
        }
        $vegetables = ProductElements::getVegetableProducts();
        foreach ($vegetables as $vegetable){
            $this->createProduct($vegetable['unit'], "vegetables", $vegetable['sku'], $vegetable['name'], $vegetable['description'], $vegetable['regularPrice'], NULL);
        }
    }



    private function createProduct($unit, $category, $sku, $name, $description, $regularPrice, $discountPrice = null, $taxable = false)
    {
        $product = $this->makeProduct($sku, $name, $description, $regularPrice, $discountPrice, $taxable);
        $product->unit()->associate($this->units[$unit]);
        $product->save();
        $product->categories()->attach($this->categories[$category]);
    }

    /**
     * @param $sku
     * @param $name
     * @param $description
     * @param $regularPrice
     * @param $discountPrice
     * @param bool $taxable
     * @return \App\Models\Product
     */
    private function makeProduct($sku, $name, $description, $regularPrice, $discountPrice, $taxable = false)
    {
        $this->activeStatus = is_null($this->activeStatus) ? \App\Models\ProductStatus::where("rendering", "success")->first() : $this->activeStatus;
        $product = \App\Models\Product::make([
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
        $units = \App\Models\Unit::all();
        foreach ($units  as $unit){
            $this->units[$unit->code] = $unit;
        }
    }

    private function loadCategories()
    {
        $categories = \App\Models\Category::all();
        foreach ($categories  as $category){
            $this->categories[$category->code] = $category;
        }
    }
}
