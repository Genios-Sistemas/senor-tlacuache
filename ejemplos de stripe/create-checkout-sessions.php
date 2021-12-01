<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/acceptpay';

/*
  line_item -> productos 
  mxn (pesos) -> no modificar
  name-> product->name
  unit_amount-> product->{'sales_price'} 
*/

//for ($i=0; $i < 3; $i++) { 
    $checkout_session = \Stripe\Checkout\Session::create(
   [
    // code...
  'line_items' => [[
      'price_data' => [
        'currency' => 'mxn',
        'product_data' => [
          'name' => 'T-shirt',  
        ],
        'unit_amount' => 50000,
      ],
      'quantity' => 2,
    ]],
  
  'payment_method_types' => [
    'card',
    'oxxo',
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
  ]);
//}




header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);