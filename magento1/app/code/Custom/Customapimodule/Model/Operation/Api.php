<?php
	class Custom_Customapimodule_Model_Operation_Api extends Mage_Api_Model_Resource_Abstract
	{
		public function items()
		{
			$products 	= array();
			$collection = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*');

			foreach ($collection as $product) {
				$products[] = $product->toArray(array('entity_id', 'name'));
			}
			return $products;
		}
		public function Create($attributes = array())
		{
			$attributes = json_decode(json_encode($attributes), True);
			return $attributes[0];
		}
	}