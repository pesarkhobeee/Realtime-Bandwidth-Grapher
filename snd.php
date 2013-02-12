<?php
include('config.php'); 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


$rec = system("cat /sys/class/net/{$interface}/statistics/tx_bytes");

// $time = date('r');
echo "retry: 1000\n";
echo "data:{$rec}\n\n";
flush();
