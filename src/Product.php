<?php
class Product {
	private $title;
	private $size;
	private $unit_price;
	private $description;

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title)
	{
		$this->title = trim( $title );
	}

	/**
	 * @return mixed
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @param mixed $size
	 */
	public function setSize($size)
	{
		$size = round($size / 1024);
		$size .= 'kb';
		$this->size = $size;
	}

	/**
	 * @return mixed
	 */
	public function getUnitPrice()
	{
		return $this->unit_price;
	}

	/**
	 * @param mixed $unit_price
	 */
	public function setUnitPrice($unit_price)
	{
		$unit_price = trim($unit_price);
		$this->unit_price = substr($unit_price, 2, strpos($unit_price, '/') - 2);
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
}