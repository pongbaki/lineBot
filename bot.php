<?php
header('Content-Type: application/json');

$url = "http://samples.openweathermap.org/data/2.5/forecast/daily?lat=35&lon=139&cnt=10&appid=b1b15e88fa797225412429c1c50c122a1";

$contents = file_get_contents($url);
$clima=json_decode($contents);

$temp_max=$clima->main->temp_max;
$temp_min=$clima->main->temp_min;
$icon=$clima->weather[0]->icon.".png";
//how get today date time PHP :P
$today = date("F j, Y, g:i a");
$cityname = $clima->city->name; 

echo " test \r\n";
echo $cityname . " - " .$today . " \r\n";
echo "Temp Max: " . $temp_max ." \r\n";
echo "Temp Min: " . $temp_min ." \r\n";


