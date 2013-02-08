<?php
include('config.php'); 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


$rec = system("ifconfig $interface | grep 'TX bytes' | sed -e 's,.*TX bytes:,,' -e 's, .*,,'");

// $time = date('r');
echo "retry: 1000\n";
echo "data:{$rec}\n\n";
flush();
