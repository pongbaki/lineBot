<?php
$access_token = 'hoHaA5VVlwo4WdDd5KrD0HdeSGO854jVVtGB2YhHzJUTp2R5j41ummZm+7s6LLafyBVA6l1PUI090dsfFGuqvKPl64PK7k/FK1UcduWbJzZ22vgQqkO03UaQ8dSYLHlqQYGKXGyMZej1DbqAnnDXlQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
