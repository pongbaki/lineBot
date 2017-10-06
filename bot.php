<?php
header('Content-Type: application/json');

$lat = 13.768384;
$lon = 100.6144870;

//$url = "http://samples.openweathermap.org/data/2.5/forecast/daily?lat=".$lat."&lon=".$lon."&cnt=10&appid=b1b15e88fa797225412429c1c50c122a1";
$url = "http://samples.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lon."&appid=b1b15e88fa797225412429c1c50c122a1"
$contents = file_get_contents($url);
$clima=json_decode($contents);

$cityname = $clima->city->name;
$list = $clima->list;

foreach ($list as $value) {
    echo "Date = " . date('m/d/Y',$value->dt) . " \r\n";
}
