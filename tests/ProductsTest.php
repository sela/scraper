<?php
class ProductsTest extends \PHPUnit_Framework_TestCase {

	public function testObject() {
		$product = new Product();
		$product->setTitle('title');
		$product->setSize('10k');
		$product->setUnitPrice('10');
		$product->setDescription('description');

		$products = new Products();
		$products->add($product);

		$this->assertArrayHasKey('total', $products->getItems());

	}
}