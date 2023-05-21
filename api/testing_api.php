<?php
include('./api.php');

// Setup:
require '../vendor/autoload.php';

use Automattic\WooCommerce\Client;


$api = new Api();


$woocommerce = new Client(
    'https://chalofuncity.com/backold', // Your store URL
    $api->consumerkey, // Your consumer key
    $api->consumersecret, // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

print_r($fetchOrder = $woocommerce->get('orders'));
echo ($first_name = $fetchOrder->billing->first_name) . "<br>";
echo ($status = $fetchOrder->status) . "<br>";
echo ($last_name = $fetchOrder->billing->last_name) . "<br>";
echo ($payment_method_title = $fetchOrder->payment_method_title) . "<br>";
echo ($date_paid = $fetchOrder->date_paid) . "<br>";
print_r ($line_items = $fetchOrder->line_items[0]->name) . "<br>";
print_r ($quantity = $fetchOrder->line_items[0]->quantity) . "<br>";
