<?php

namespace Waredesk\Tests;

use Waredesk\Image;

class ImageTest extends BaseTest
{
    public function testImageFromFile()
    {
        $image = new Image(__DIR__ . '/../files/tshirt.jpg');
        $this->assertNotEmpty($image->getContent());
        $this->assertEquals(Image::IMAGE_TYPE_JPG, $image->getType());
    }

    public function testImageFromString()
    {
        $image = new Image(file_get_contents(__DIR__ . '/../files/tshirt.jpg'), Image::IMAGE_TYPE_JPG);
        $this->assertNotEmpty($image->getContent());
        $this->assertEquals(Image::IMAGE_TYPE_JPG, $image->getType());
    }
}
