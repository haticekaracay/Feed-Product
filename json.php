<?php

$feed = implode(file('http://localhost/feed/'));
$xml = simplexml_load_string($feed);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

var_dump($array);
?>