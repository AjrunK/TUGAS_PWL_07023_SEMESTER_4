<?php
require_once 'config.php';

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => 10000,
);

$customer_details = array(
    'first_name' => "Nama",
    'email' => "email@example.com",
);

$params = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo json_encode(['snapToken' => $snapToken]);
?>
