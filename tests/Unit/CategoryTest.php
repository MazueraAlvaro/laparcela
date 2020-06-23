<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_can_create_category()
    {
        $data = [
            "name" => "La categoria reina",
            "description" => "Esto es una descripción",
        ];
        $this->postJson(route('category.store'), $data)->assertStaus(201)->assertJson($data);

    }
}
