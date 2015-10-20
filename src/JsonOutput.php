<?php
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class JsonOutput implements scrapeOutputerInerface {

	/**
	 * JsonOutput constructor.
	 */
	public function __construct()
	{
	}

	public function output($object)
	{

		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($object->getItems(),  'json');
		echo $jsonContent;
	}
}