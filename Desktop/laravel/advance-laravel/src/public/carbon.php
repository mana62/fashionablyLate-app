<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
$dt = Carbon::now();
echo $dt->year . '<br>';

$dt = Carbon::now();
echo $dt->month. '<br>';

$dt = Carbon::now();
echo $dt->second. '<br>';

$dt = Carbon::now();
echo $dt->addYear() . '<br>';

$dt = Carbon::now();
echo $dt->subYear().'<br>';

$dt = Carbon::now();
echo $dt->addSeconds().'<br>';

$dt = Carbon::now();
echo $dt->subSeconds().'<br>';