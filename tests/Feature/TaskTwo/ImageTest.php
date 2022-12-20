<?php

namespace Tests\Feature\TaskTwo;

use Tests\Feature\BaseTest;

class ImageTest extends BaseTest
{
    public function test_adding_images()
    {
        $product1=$this->createProduct(['name' => 'Apple']);
        $image=$this->createImage([
            'imageable_id' => $product1->json("id"),
            'imageable_type' => 'Product',
            'path' => 'apple.jpg',
            'description' => 'image of an apple'
        ]);
        $response = $this->get('products/'.$product1->json("id"));
        $this->assertEquals('apple.jpg', $response->json('image_path'));

        $user=$this->createUser(['name' => 'Bilal', 'email' => 'b@mail.com', 'password' => '123']);
        $this->createImage([
            'imageable_id' => $user->json("id"),
            'imageable_type' => 'User',
            'path' => 'bilal.jpg',
            'description' => 'image of a Bilal'
        ]);
        $response = $this->get('users/'.$user->json("id"));
        $this->assertEquals('bilal.jpg', $response->json('image_path'));
    }

}
