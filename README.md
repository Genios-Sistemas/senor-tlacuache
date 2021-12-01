![alt text](https://raw.githubusercontent.com/Genios-Sistemas/senor-tlacuache/main/assets/img/logo.png?token=AWXTJKR3AHXGBVABJC3F2HLBU7GKY)
<br/><br/>
# Señor Tlacuache<br/>
El Señor tlacuache es una tienda de antigüedades ubicada en Tulum, Quintana Roo.<br/><br/>

Actualmente hay una versión funcional, en el que se pueden comprar productos. (http://senortlacuache.com.mx/)<br/>
Lo que se encuentra aquí es una nueva versión, en el cual puede manejar los productos nuevos, sin la necesidad de estar actualizando página de manera manual,
para eso tenemos el ERP de **Stel Order**; este ERP cuenta con una API que puede hacer manejo de los datos del usuario con una aplicación externa. 
En el apartado de pagos en línea utilizamos **Stripe**, el cual facilita los pagos, y transferencias bancarias por internet. <br/><br/>

## Uso de la API de Stel Order<br/>
Aunque esta APi tenga muchas funciones, actualmente y por simple comodidad se está utilizando solo una función el cual es llamado *products*
esta función devuelve todos los datos que contiene un producto, en formato JSON, se puede buscar por el ID del producto, su referencia, código de barras o nombre;
tambien puedes desplegar y ver todos los productos registrados en el ERP (limitado a 100 productos por default, se puede modificar el límite hasta 500 como máximo); 
si se devuelve varios productos el resultado devolverá un *array* de los productos,
###### cuerpo de producto en un *array*
~~~
[{
"utc-last-modification-date": "2019-06-21T10:44:19+0000",
"primary-tax-percentage": 10,
"description": "A safe and comfortable way to store documents and other office items",
"product-category-path": "app.stelorder.com/app/productCategories/15",
"discount-percentage": 0,
"reference": "00005",
"path": "app.stelorder.com/app/products/58",
"private-comments": null,
"serial-number-path": "app.stelorder.com/app/serialNumbers/52",
"inactive": false,
"sales-price": 18.8,
"sales-minimum-price": 0,
"primary-tax-path": "app.stelorder.com/app/taxLines/37273",
"external-id": null,
"id": 58,
"real-stock": 39,
"location": "Location in warehouse",
"purchase-price": 11,
"product-category-id": 15,
"barcode": "8429096081111",
"promotional": false,
"serial-number-id": 52,
"item-rates": [
 {
  "rate-path": "app.stelorder.com/app/rates/2807",
  "rate-id": 2807,
  "price": 15
 },
 {
  "rate-path": "app.stelorder.com/app/rates/2808",
  "rate-id": 2808,
  "price": 16
 },
 {
  "rate-path": "app.stelorder.com/app/rates/2809",
  "rate-id": 2809,
  "price": 17
 }
],
"product-warehouses": [
 {
  "warehouse-id": -2,
  "minimum-stock": 200,
  "location": "",
  "warehouse-path": "app.stelorder.com/app/warehouses/-2",
  "real-stock": 220,
  "virtual-stock": 220
 }
],
"stock-enabled": true,
"minimum-stock": 0,
"sales-countable-account": null,
"purchase-margin-percentage": 70.91,
"deleted": false,
"secondary-tax-percentage": 0,
"item-images": [
 {
  "item-image-path": "https://app.stelorder.com/app/ControladorPublico?token=AEcihxapBKwKQQTDK1j9PE5Xi-o7EqqCB1H4-7ML2EbqA-cRK5UWRYc0Om6nKOyfMKAH9G0M5Q2_PhCxhYguhuDlXK8G4RWQwOq6tIbGL-XF_TMrzpxyAQRLnCvZ8MiH9YsGHImV32PZQ1f8oDRwIssB5IXqHKIpX0gqxH9cbhwDX7AStizg8igSb7BPP6WvYf2zTwb2cVDj",
  "order": 0
 }
],
"name": "Folders (6 Pack)",
"creation-date": "2016-11-28T12:54:57+0000",
"sales-margin-percentage": 41.49,
"purchase-countable-account": null,
"primary-tax-id": 37273,
"virtual-stock": 34,
"full-reference": "PRO00005",
"margin-enabled": false
}]
~~~

para llamar a la API, procesamiento del JSON y despliegue la tienda utilizamos PHP
###### procesamiento del archivo JSON
~~~
$url = "https://app.stelorder.com/app/products?APIKEY=CENSORED";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array(
   "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$jsonobj=json_decode($resp);
$indi=count($jsonobj);
~~~
###### despliegue de la tienda
~~~
for ($i=0; $i < $indi; $i++) { 
  echo "<div class='col-lg-4 col-md-6 text-center strawberry'>";
  echo "<div class='single-product-item'>";
  echo "<div class='product-image'>";
  if (count($jsonobj[$i]->{'item-images'})){
    // code...
    $image=$jsonobj[$i]->{'item-images'}[0]->{'item-image-path'};
    echo "<a href='single-product.html'><img src=";
    echo $image;
    echo " alt=></a>";
    //echo "<br> <br>";
  }
  echo "</div>";
  echo "<h3>",$jsonobj[$i]->name,"</h3>";
  echo "<p class='product-price'><span>";
  echo $jsonobj[$i]->description,"</span>$";
  echo $jsonobj[$i]->{'sales-price'}," </p>";
  echo "<a href='cart.html' class='cart-btn'><i class='fas fa-shopping-cart'></i> Agregar al carrito</a>
  </div>
  </div>";
}
~~~

## Uso de la API de Stripe <br/>
Mencionando anteriormente Stripe maneja los procesos bancarios por internet, por lo que la API funciona mediante scripts.<br/>
El manejo que debe hacer el usuario es únicamente mediante el archivo **_create-checkot-sessions.php_**

###### cuerpo del script
~~~
require 'vendor/autoload.php';
//aqui va la APIkey
\Stripe\Stripe::setApiKey('sk_test_CENSORED');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/acceptpay';

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
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
~~~

### Nota <br/>
hay que instalar el servicio de Stripe, para ello necesitaras instalarlo mediante dos medios con **Composer** o **descargarlo directamente**.<br/>
- Para descargarlo directamente ve a este enlace (https://github.com/stripe/stripe-php/releases)
- Con composer debes primero debes instalar el programa y en tu línea de comandos escribir lo siguiente 
~~~ 
composer require stripe/stripe-php
~~~

El script te mandara a esta página ya preconstruida con los datos del productos, precio y cantidad; lo unico que se puede modificar son 
los métodos de pago y los datos de entrada.<br>

![alt text](https://raw.githubusercontent.com/Genios-Sistemas/senor-tlacuache/main/milti-md/Stripe-checkout.jpeg?token=AWXTJKTSOJ2YFFVAG2S5C3TBU7BAQ)<br/><br/>
# ¿qué hay que hacer ahora?<br/>
Debido por cuestiones de tiempo no se pudo completar de manera satisfactoria la nueva versión, esto se debe a que hay tareas que no se pudieron concretar, 
en los cuales se encuentra
- integración de Stripe con el carrito
- scripts para conseguir productos del carrito a la página de esta
- almacenar productos al carrito
- Corrección de bug grafico de la tienda

### Soluciones propuestas
#### Integración de strike<br/>
Debido a que el checkout de Stripe maneja productos internos hay que ingresar productos externos de manera manual, debido a que la estructura del script
no se puede modificar de manera flexible se propuso que mediante un `switch` para agregar de 2 a más productos (límite establecido a 6 productos);
igualmente hay que conseguí la información del carrito hacia el script para que se despliegue el checkout de manera correcta.
#### Scripts del carrito <br/>
Para agregar productos al carrito utilizamos Scripts de js estos scripts están en `assets/js/carting.js` y `assets/js/carito.js`; el primero crea un *stack* en el incono
de carrito en la barra de navegación, en las últimas actualizaciones del repositorio ocurrió que, los scripts ya no funcionaban, y debido al tiempo ya no se pudieron verificar y corregir.
para continuar con los scripts para crear cookies hacer las pruebas necesarias de la mismas, incluyendo la prueba general de `carito.js`.
#### Bug grafico de la tienda
Debido a que el script de la tienda recoge imágenes del ERP hay cierto tiempo que demora en cargarlas, debido a eso la distribución de los productos 
se despliega por default, por lo que cuando se despliegan las imágenes estas se empiezan a encima unos entre otros, por lo que no se ha podido encontrar una solución.
<br/> <br/> <br/>
###### Repositorio creado por Luis David Zarate y Jose Arturo Valenzuela
###### Texto creado por Jose Arturo Valenzuela

