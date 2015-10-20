<?php
require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\ClassLoader\ClassMapGenerator;

ClassMapGenerator::dump(
	array(__DIR__.'/src'),
	__DIR__.'/class_map.php'
);
use Symfony\Component\ClassLoader\MapClassLoader;

$mapping = include __DIR__.'/class_map.php';
$loader = new MapClassLoader($mapping);
$loader->register();

use Goutte\Client;
use Guzzle\Common\Event;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

date_default_timezone_set('Europe/London');
$client = new Client();
$url_crawl = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/CategoryDisplay?msg=&categoryId=185749&langId=44&storeId=10151&krypto=CWSPwJn7%2FfNCQJ17kIzWIEvEWIHZR3Bj3iR4i5MAF9M7qzk%2FP9%2B4zVL66KSWG186Uk9LnjKfPgCi%0AMsUYGCAI6oj6XhceppObUmu5R1ud8Z7wJuqB5X214E%2BBA47VydOEDYPnnJM%2BvN%2FIT5QMVV5%2B2aGv%0Alb1unCWjvafVBq7m6USN2aiCjWKM5mUPqPuXdvOWsUIFwpRb3OMbqw0sp5n8RyO6gCstruK1H%2B3L%0AGstBthGCZEJIXfuWPan04OtMjtzKYB1lUYa1f1JJu7YBoqhhyEgYYl0MlcS8vhp8Dn4dsKY%3D#langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true';
$crawler = $client->request('GET', $url_crawl);

$product_elms = new Products();

$crawler->filter('ul.productLister > li .productInner')->each(function ($node) use (&$product_elms) {
	$product_elm = new Product();
	$product_elm->setTitle($node->filter('h3 a')->text());
	$product_elm->setUnitPrice($node->filter('.pricePerUnit')->text());

	// get the item description from the linked page
	$client_internal = new Client();
	$crawler_internal = $client_internal->request('GET', $node->filter('h3 a')->attr('href'));
	$product_elm->setDescription($crawler_internal->filter('.productText')->text());
	$product_elm->setSize(strlen($crawler_internal->html()));

	// calc total unit price
	$product_elms->add($product_elm)->addUnitPrice($product_elm);
});
ProductsOutputUtil::output('json', $product_elms);

