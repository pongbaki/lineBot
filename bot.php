<?php
header('Content-Type: application/json');

$lat = 13.768384;
$lon = 100.6144870;
$appID = "e72ca729af228beabd5d20e3b7749713";

$url = "http://api.openweathermap.org/data/2.5/forecast/daily?lat=".$lat."&lon=".$lon."&cnt=10&appid=".$appID;
//$url = "http://api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lon."&appid=b1b15e88fa797225412429c1c50c122a1"
$contents = file_get_contents($url);
$clima=json_decode($contents);

$cityname = $clima->city->name;
$list = $clima->list;

foreach ($list as $value) {
    echo "Date = " . date('m/d/Y',$value->dt) . " \r\n";
}
