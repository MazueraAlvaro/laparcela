<?php

use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = ProductElements::getProductImages();
        foreach ($images as $image){
            $imageObj = new \App\Models\ProductImage();
            $imageObj->file_name = $image["filename"];
            $product = \App\Models\Product::where("sku", $image['product'])->first();
            $imageObj->product()->associate($product);
            $imageObj->save();
        }
    }
}
