<?php

namespace Waredesk\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Waredesk\Exceptions\InvalidRequestException;
use Waredesk\Image;
use Waredesk\Models\Code;
use Waredesk\Models\Product;
use Waredesk\Tests\BaseTest;

class ProductCreateTest extends BaseTest
{
    private function createProduct(): Product
    {
        $product = new Product();
        $product->setName('Amazing T-Shirt');
        $product->setDescription('This T-Shirt will cover your belly');

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/../Categories/responses/getTestSuccess.json')));
        $categories = $this->waredesk->categories->fetch();

        $product->getCategories()->add($categories->first());

        $variant = new Product\Variant();
        $variant->setName('X-Large');
        $product->getVariants()->add($variant);

        return $product;
    }

    public function testCreateProduct()
    {
        $product = $this->createProduct();

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getId());

        $this->assertNotEmpty($product->getCategories()->first()->getId());
    }

    public function testCreateProductWithImage()
    {
        $image = new Image(__DIR__.'/../files/tshirt.jpg');
        $product = $this->createProduct();
        $product->setImage($image);
        $product->getVariants()->first()->setImage($image);

        $this->mock->append(new Response(200, [], file_get_contents(__DIR__ . '/responses/createWithImageTestSuccess.json')));

        $product = $this->waredesk->products->create($product);
        $this->assertNotEmpty($product->getImages()['small']);
        $this->assertNotEmpty($product->getVariants()->first()->getImages()['small']);
    }

    public function testCreateByCloningCodes()
    {
        $code = new Code();
        $code->reset([
            'id' => 'code_0F8f8936aeb96c8b6gZQ',
            'name' => 'SKU',
            'creation' => new \DateTime('2017-05-15T20:39:13+00:00'),
            'modification' => new \DateTime('2017-05-15T20:39:13+00:00'),
        ]);

        $element = new Code\Element();
        $element->reset([
            'id' => 'cele_0De08e7034ea879aL4gv',
            'type' => 'text'
        ]);
        $code->getElements()->add($element);

        $product = $this->createProduct();
        $codes = $product->getVariants()->first()->getCodes();
        $codes->reset();
        $codes->add($code);

        $array = $product->jsonSerialize();
        $this->assertEquals($array['variants'][0]['codes'][0]['code'], 'code_0F8f8936aeb96c8b6gZQ');
        $this->assertEquals($array['variants'][0]['codes'][0]['elements'][0]['element'], 'cele_0De08e7034ea879aL4gv');
    }

    public function testFailure()
    {
        $product = $this->createProduct();
        $product->getVariants()->first()->setName('');

        $this->mock->append(new Response(400, [], file_get_contents(__DIR__ . '/responses/createTestFailure.json')));

        try {
            $this->waredesk->products->create($product);
        } catch (InvalidRequestException $e) {
            $this->assertEquals('Request is invalid', $e->getMessage());
            $expectedError = [
                [
                    'field' => 'variants',
                    'error' => 'child_errors',
                    'message' => 'Field \'variants\' has errors in it\'s children',
                    'errors' => [
                        [
                            [
                                'field' => 'name',
                                'error' => 'invalid',
                                'message' => 'Field \'name\' is invalid',
                            ]
                        ]
                    ]
                ]
            ];
            $this->assertEquals($expectedError, $e->getErrors());
        }
    }
}
