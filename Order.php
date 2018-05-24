<?php
    echo "<pre>";
    include_once('magento1/app/Mage.php');
    Mage::app();
    Mage::getSingleton('customer/session')->clear();
    $cart = Mage::getSingleton('checkout/cart');
    $cart->init();
    //$options = array('92'=>'49','144'=>'21');
    $product = Mage::getModel('catalog/product')->load(1);

    $paramater = array(
            'product'   => '1',
            'qty'       => '1',
            'form_key'  => Mage::getSingleton('core/session')->getFormKey(),
            'options'   => ''
        );
    $customer_address = array (
        'firstname' => 'Subham',
        'email'     => 'hello@example.com',
        'lastname'  => 'Kumar',
        'street'    => array (
            '0' => "Street 1",
            '1' => "Street 2"
        ),
        'city'          => 'New Delhi',
        'region_id'     => '',
        'region'        => '',
        'postcode'      => '31000',
        'country_id'    => 'IN',
        'telephone'     => '0038531555444',
    );
    $data = array (
        'method'        =>'ccsave',
        'cc_owner'      => 'Subham Kumar',
        'cc_type'       => 'VI',
        'cc_number'     => '4111111111111111',
        'cc_exp_month'  => 4,
        'cc_exp_year'   => 2022
        );
    $request = new Varien_Object();
    $request->setData($paramater);
    $cart->addProduct($product, $request);
    $cart->save();
    $checkout = Mage::getSingleton('checkout/type_onepage');
    $checkout->initCheckout();
    $checkout->saveCheckoutMethod('guest');
    $checkout->saveBilling($customer_address);
    $checkout->saveShipping($customer_address);
    $checkout->saveShippingMethod('flatrate_flatrate');
    $checkout->savePayment($data);
    $checkout->getQuote()->getPayment()->importData($data);
    $checkout->saveOrder();
    $order      = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastRealOrderId());
    $payment    = $checkout->getQuote()->getPayment();
    if ($payment->getMethodInstance() instanceof Mage_Paygate_Model_Authorizenet) {
        $payment->capture(null);
     }
    $order->save();

    //Mage::getModel('paygate/authorizenet')->capture($checkout->getQuote()->getPayment(), 50);
    $cart->truncate();
    $cart->save();
    $cart->getItems()->clear()->save();
