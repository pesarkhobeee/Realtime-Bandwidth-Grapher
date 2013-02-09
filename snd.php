<?php
include('config.php');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$snd = system("snmpwalk -Os -v 1 -c $community $router ifOutOctets.$ifindex | sed -e 's,.* ,,'");

// $time = date('r');
echo "retry: 1000\n";
echo "data:{$snd}\n\n";
flush();
