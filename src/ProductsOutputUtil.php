<?php
class ProductsOutputUtil {
	public static function output($type, $products)
	{
		$formatter = ProductsOutputUtil::createProductOutput($type);
		return $formatter->output($products);
	}

	private static function createProductOutput($type)
	{
//		return new JsonOutput();
		if ($type == "json") {
			$formatter = new JsonOutput();
		} else {
			$formatter = new NullOutput();
		}
		return $formatter;
	}
}