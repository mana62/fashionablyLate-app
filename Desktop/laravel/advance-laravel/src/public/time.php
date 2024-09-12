<?php
$date = new DateTime();
echo $date->format('Y-m-d H:i:s'). '<br>';

$date = new DateTime('1997-06-02 03:25:32');
echo $date->format('Y-m-d H:i:s'). '<br>';


$date = new DateTime();
echo $date->format(DateTime::ATOM). '<br>';

$date = new DateTime();
echo $date->format(DateTime::COOKIE). '<br>';

$date = new DateTime();
echo $date->format(DateTime::RSS). '<br>';

$date = new DateTime();
echo $date->format(DateTime::W3C). '<br>';

$date = new DateTime();
echo $date->modify('-1 years')->format('Y-m-d H:i:s'). '<br>';

$date = new DateTime();
echo $date->modify('1 years')->format('Y-m-d H:i:s'). '<br>';


$date = new DateTime();
echo $date->modify('-1 days')->format('Y-m-d H:i:s'). '<br>';

$date = new DateTime();
echo $date->modify('1 days')->format('Y-m-d H:i:s'). '<br>';
?>