<?php

date_default_timezone_set("Asia/Bangkok");
$access_token = 'hoHaA5VVlwo4WdDd5KrD0HdeSGO854jVVtGB2YhHzJUTp2R5j41ummZm+7s6LLafyBVA6l1PUI090dsfFGuqvKPl64PK7k/FK1UcduWbJzZ22vgQqkO03UaQ8dSYLHlqQYGKXGyMZej1DbqAnnDXlQdB04t89/1O/w1cDnyilFU=';
//////////
$lat = 13.768384;
$lon = 100.6144870;
$appID = "e72ca729af228beabd5d20e3b7749713";
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?lat=".$lat."&lon=".$lon."&cnt=10&appid=".$appID;
//$url = "http://api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lon."&appid=b1b15e88fa797225412429c1c50c122a1"
$contents = file_get_contents($url);
$clima=json_decode($contents);
$list = $clima->list;



//echo "Date of next Sat. = " . date('d/m/Y',$dataDay->dt) . " \r\n";
//$dateOfSat = date('d/m/Y',$list[$day_diff]->dt);

$dayWeather = "";
foreach( $list as $dataDay ){
//echo "Date of next Sat. = " . date('d/m/Y',$dataDay->dt) . "      :   ";
//echo  date('N',$dataDay->dt) . " \r\n";
	
	$weatherID = $dataDay->weather[0]->main;
	$weather = $dataDay->weather[0]->description;
	if(date('N',$dataDay->dt) === '6'){
		if(strpos($weatherID,'Rain') !== false ) {
			$msg = 'ที่บดินทร ฝนตก อดเล่นจ้า ';
		} else {
			$msg = 'ได้เล่นแล้วโว้ยยย ';
		}
		$dayWeather .=  date('d/m/Y',$dataDay->dt) . " : " . $weather . "  " . $msg."\r\n";
	}
}

echo  $dayWeather . " \r\n";
	

/////////
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text' && strpos($event['message']['text'],'ฝนตกไหม') !== false) {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $dayWeather,
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "OK";
