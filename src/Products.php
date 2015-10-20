<?php
class Products {
	private $items;
	private $sum_unit_price;

	function __construct()
	{
		$this->items = array();
		$this->sum_unit_price = 0;
	}

	/**
	 * @return int
	 */
	public function getSumUnitPrice()
	{
		return $this->sum_unit_price;
	}

	/**
	 * @param int $sum_unit_price
	 */
	public function setSumUnitPrice($sum_unit_price)
	{
		$this->sum_unit_price = $sum_unit_price;
	}

	public function addUnitPrice($item)
	{
		$this->update_sum_amount($item);
		return $this;
	}

	public function add($item)
	{
		$this->items[] = $item;
		return $this;
	}

	public function getItems()
	{
		return array_merge(array('results' => $this->items), array('total' => $this->sum_unit_price));
	}

	private function update_sum_amount($item)
	{
		$this->sum_unit_price += $item->getUnitPrice();
	}
}