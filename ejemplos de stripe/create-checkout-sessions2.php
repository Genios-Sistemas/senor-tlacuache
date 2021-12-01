<?php
	$len=$_POST['produtcs'];
	$products=[]
	for ($i=0; $i < $len; $i++) {
		$proti='product',$i;
		$priti='price',$i;
		$quanti='quantity'.$i
		$products[$i]=$_POST[$proti];
		$price[$i]=$_POST[$priti];
		$quant[$i]=$_POST[$quanti];
		
	}
/*
  line_item -> productos 
  mxn (pesos) -> no modificar
  name-> product->name
  unit_amount-> product->{'sales_price'} 
*/

	switch (variable) {
		case 1:
			require 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

			header('Content-Type: application/json');

			$YOUR_DOMAIN = 'http://localhost/acceptpay';


			$checkout_session = \Stripe\Checkout\Session::create([
			  'line_items' => [
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[0],  
			        ],
			        'unit_amount' => $price[0],
			      ],
			      'quantity' => $quant[0],
			    ],
			  'payment_method_types' => [
			    'card',
			    'oxxo',
			  ],
			  'mode' => 'payment',
			  'success_url' => $YOUR_DOMAIN . '/success.html',
			  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
			break;
		case 2:
			require 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

			header('Content-Type: application/json');

			$YOUR_DOMAIN = 'http://localhost/acceptpay';


			$checkout_session = \Stripe\Checkout\Session::create([
			  'line_items' => [
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[0],  
			        ],
			        'unit_amount' => $price[0],
			      ],
			      'quantity' => $quant[0],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[1],  
			        ],
			        'unit_amount' => $price[1],
			      ],
			      'quantity' => $quant[1],
			    ],
			  'payment_method_types' => [
			    'card',
			    'oxxo',
			  ],
			  'mode' => 'payment',
			  'success_url' => $YOUR_DOMAIN . '/success.html',
			  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
			// code...
			break;
		case 3:
			require 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

			header('Content-Type: application/json');

			$YOUR_DOMAIN = 'http://localhost/acceptpay';


			$checkout_session = \Stripe\Checkout\Session::create([
			  'line_items' => [
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[0],  
			        ],
			        'unit_amount' => $price[0],
			      ],
			      'quantity' => $quant[0],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[1],  
			        ],
			        'unit_amount' => $price[1],
			      ],
			      'quantity' => $quant[1],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[2],  
			        ],
			        'unit_amount' => $price[2],
			      ],
			      'quantity' => $quant[2],
			    ],
			  'payment_method_types' => [
			    'card',
			    'oxxo',
			  ],
			  'mode' => 'payment',
			  'success_url' => $YOUR_DOMAIN . '/success.html',
			  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
			// code...
			break;
		case 4:
			require 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

			header('Content-Type: application/json');

			$YOUR_DOMAIN = 'http://localhost/acceptpay';


			$checkout_session = \Stripe\Checkout\Session::create([
			  'line_items' => [
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[0],  
			        ],
			        'unit_amount' => $price[0],
			      ],
			      'quantity' => $quant[0],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[1],  
			        ],
			        'unit_amount' => $price[1],
			      ],
			      'quantity' => $quant[1],
			    ],
			  'payment_method_types' => [
			    'card',
			    'oxxo',
			  ],
			  [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[2],  
			        ],
			        'unit_amount' => $price[2],
			      ],
			      'quantity' => $quant[2],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[3],  
			        ],
			        'unit_amount' => $price[3],
			      ],
			      'quantity' => $quant[3],
			    ],
			  'mode' => 'payment',
			  'success_url' => $YOUR_DOMAIN . '/success.html',
			  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
			// code...
			break;
		case 5:
		require 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey('sk_test_51JXqf1ESay5sBgHM8TdS5EV1QEBnmm1h6dbsfSlWbMV5rxEsJisnTAGQ9BW2IsYkMH5E2FIft9WUuVfRHSbrnj3A00mz15fytG');

			header('Content-Type: application/json');

			$YOUR_DOMAIN = 'http://localhost/acceptpay';


			$checkout_session = \Stripe\Checkout\Session::create([
			  'line_items' => [
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[0],  
			        ],
			        'unit_amount' => $price[0],
			      ],
			      'quantity' => $quant[0],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[1],  
			        ],
			        'unit_amount' => $price[1],
			      ],
			      'quantity' => $quant[1],
			    ],
			  'payment_method_types' => [
			    'card',
			    'oxxo',
			  ],
			  [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[2],  
			        ],
			        'unit_amount' => $price[2],
			      ],
			      'quantity' => $quant[2],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[3],  
			        ],
			        'unit_amount' => $price[3],
			      ],
			      'quantity' => $quant[3],
			    ],
			    [
			      'price_data' => [
			        'currency' => 'mxn',
			        'product_data' => [
			          'name' => $products[4],  
			        ],
			        'unit_amount' => $price[4],
			      ],
			      'quantity' => $quant[4],
			    ],
			  'mode' => 'payment',
			  'success_url' => $YOUR_DOMAIN . '/success.html',
			  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
			// code...
			break;
		default:
			// code...
			break;
	}
?>