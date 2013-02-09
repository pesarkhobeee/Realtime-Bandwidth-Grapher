<?php
include('config.php');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$rec = system("snmpwalk -Os -v 1 -c $community $router ifInOctets.$ifindex | sed -e 's,.* ,,'");

// $time = date('r');
echo "retry: 1000\n";
echo "data:{$rec}\n\n";
flush();
