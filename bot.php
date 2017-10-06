<?php
header('Content-Type: application/json');

$url = "http://samples.openweathermap.org/data/2.5/forecast/daily?lat=35&lon=139&cnt=10&appid=b1b15e88fa797225412429c1c50c122a1";

$contents = file_get_contents($url);
$clima=json_decode($contents);

$cityname = $clima->city->name;
$list = $clima->list;

foreach ($list as $value) {
    echo "Date = " . date('m/d/Y',$value->dt) . " \r\n";
}
