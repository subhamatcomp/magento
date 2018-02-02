<?php
	include '/var/www/html/magento/app/Mage.php';
	Mage::app();

	$fp = fopen(Mage::getBaseDir('var') . DS . "sample.txt" , "w");
	fwrite($fp, "abced");