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

$checkout_session = \Stripe\Checkout\Session::create([
  //'customer_email' => 'customer@example.com',
  'billing_address_collection' => 'required',
  'shipping_address_collection' => [
    'allowed_countries' => ['US', 'CA', 'MX'],
  ],
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'mxn',
        'product_data' => [
          'name' => 'T-shirt',  
        ],
        'unit_amount' => 500000,
      ],
      'quantity' => 1,
    ],
    [
      'price_data' => [
        'currency' => 'mxn',
        'product_data' => [
          'name' => 'Tu :)',  
        ],
        'unit_amount' => 500000,
      ],
      'quantity' => 1,
    ],
  ],
  'payment_method_types' => [
    'card',
    
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);