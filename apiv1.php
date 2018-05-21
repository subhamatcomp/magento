<?php
    $proxy = new SoapClient('http://127.0.0.1/magento1/api/soap/?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));
    $sessionId = $proxy->login('soaper', 'pass@123');

    $data = array(
        'register' => array(
            array(
                "first_name" => 'Subham',
                "last_name" => 'Kumar',
                "email" => 'sk@email.com',
                "website_id" => '1',
                "group_id" => '1'
            ),
            array(
                "first_name" => 'Subham',
                "last_name" => 'Kumar',
                "email" => 'sk1@email.com',
                "website_id" => '1',
                "group_id" => '1'
            )
        )
    );
    $result = $proxy->call($sessionId, 'customapimodule_api.register', $data);
    print_r($result);
    $proxy->endSession($sessionId);
    die;

    $proxy = new SoapClient('https://cert1-www.apac.elsevierhealth.com/index.php/api/v2_soap?wsdl', array('trace' => true));
    $sessionId = $proxy->login('prateek', '12345678');
    $complexFilter = array(
        'filter' => array(
            array(
                'key' => 'qty',
                'value' => 2
            )
        )
    );

    $attributes = new stdclass();
    $attributes->attributes = array('contractorigin', 'cover');

    $result = $proxy->predictionSuggestionList($sessionId, $complexFilter, 22, $attributes);
    print_r($result);

    die;


    $proxy = new SoapClient('https://cert1-www.apac.elsevierhealth.com/index.php/api/v2_soap?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));
    $sessionId = $proxy->login((object)array('username' => 'prateek', 'apiKey' => '12345678'));
    $result = $proxy->predictionSuggestionList((object)array('sessionId' => $sessionId->result, 'filters' => $complexFilter, 'store' => 22, 'attributes' => $attributes));
    print_r($result->result);


    require "/mnt/g/Compunnel_Prateek Agarwal/Data/BitBucket/apac/app/Mage.php";
    $client = new Zend_XmlRpc_Client('https://cert1-www.apac.elsevierhealth.com/index.php/api/xmlrpc/');
    $session = $client->call('login', array('prateek', '12345678'));

    $result = $client->call('call', array($session, 'prediction_suggestion.list', $args));
    print_r($result);
    $client->call('endSession', array($session));
