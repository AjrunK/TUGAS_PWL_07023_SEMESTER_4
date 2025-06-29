<?php
require_once 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-xxxxxxxxxxxxxxxxxxxx';
\Midtrans\Config::$clientKey = 'SB-Mid-client-xxxxxxxxxxxxxxxxxxxx';

\Midtrans\Config::$isProduction = false; // testing mode
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
?>
