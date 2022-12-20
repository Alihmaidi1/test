<?php

namespace Tests\Feature\TaskOne;

use Tests\Feature\BaseTest;
use Tests\TestCase;

class ProductUnitTest extends BaseTest
{


    public function test_adding_product_inventory()
    {
        $product1=$this->createProduct(['name' => 'Flour']);
        $unit1=$this->createUnit([
            'name' => 'Gram',
            'modifier' => 1,
        ]);
        $unit2=$this->createUnit([
            'name' => 'Kilo Gram',
            'modifier' => 1000,
        ]);
        $productUnit = [
            'product_id' => $product1->json("id"),
            'unit_id' => $unit1->json("id"),
            'amount' => 1,
        ];
        $response = $this->post('inventories', $productUnit);
        $this->assertDatabaseHas('product_units', $productUnit);
        $response->assertStatus(200);
    }

    public function test_inventory_1()
    {
        $product1=$this->createProduct(['name' => 'Flour']);
        $unit1=$this->createUnit([
            'name' => 'Gram',
            'modifier' => 1,
        ]);
        $unit2=$this->createUnit([
            'name' => 'Centi Gram',
            'modifier' => 1/100,
        ]);
        $unit3=$this->createUnit([
            'name' => 'Kilo Gram',
            'modifier' => 1000,
        ]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit1->json("id"), 'amount' => 25]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit2->json("id"), 'amount' => 50]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit3->json("id"), 'amount' => 2]);

        $response = $this->get('products/'.$product1->json("id"));
        $response->assertOk();
        $this->assertEquals(25+0.5+2000, $response->json('total_quantity'));

        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit1->json("id"), 'amount' => +50,]);

        $response = $this->get('products/'.$product1->json("id"));
        $response->assertOk();
        $this->assertEquals(25+0.5+2000+50, $response->json('total_quantity'));

        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit2->json("id"), 'amount' => 230]);

        $response = $this->get('products/'.$product1->json("id"));
        $response->assertOk();
        $this->assertEquals(25+0.5+2000+50+2.3, $response->json('total_quantity'));
    }

    public function test_inventory_2()
    {
        $product1=$this->createProduct(['name' => 'Flour']);
        $unit1=$this->createUnit(['name' => 'Gram', 'modifier' => 1]);
        $unit2=$this->createUnit(['name' => 'Pound', 'modifier' => 453.59237]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit1->json("id"), 'amount' => 50]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit2->json("id"), 'amount' => 1]);
        $response = $this->get('products/'.$product1->json("id"));
        $response->assertOk();
        $this->assertEquals(453.59237 + 50, $response->json('total_quantity'));
    }

    public function test_get_quantity_by_unit()
    {
        $product1=$this->createProduct(['name' => 'Flour']);
        $unit1=$this->createUnit(['name' => 'Gram', 'modifier' => 1]);
        $unit2=$this->createUnit(['name' => 'Pound', 'modifier' => 453.59237]);
        $unit3=$this->createUnit(['name' => 'Kilo Gram', 'modifier' => 1000]);
        $unit4=$this->createUnit(['name' => 'Ton', 'modifier' => 1000000]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit1->json("id"), 'amount' => 50]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit2->json("id"), 'amount' => 1]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit3->json("id"), 'amount' => 24]);
        $this->post('inventories', ['product_id' => $product1->json("id"), 'unit_id' => $unit4->json("id"), 'amount' => 3]);

        $response = $this->get('products/'.$product1->json("id").'?unit_id='.$unit2->json("id"));
        $response->assertOk();
        $this->assertEquals(453.59237, $response->json('total_quantity_by_unit_id'));
        $response = $this->get('products/'.$product1->json("id").'?unit_id='.$unit1->json("id"));
        $response->assertOk();
        $this->assertEquals(50, $response->json('total_quantity_by_unit_id'));
        $response = $this->get('products/'.$product1->json("id").'?unit_id='.$unit3->json("id"));
        $response->assertOk();
        $this->assertEquals(24000, $response->json('total_quantity_by_unit_id'));
    }
}
