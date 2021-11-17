<?php

/*

Plugin Name: Wordpress Notion API

Plugin URI: https://github.com/monaco-lux/wordpressNotionAPI

Description: THis plugin can be used to connect Wordpress to Notion's API.

Version: 1.0

Author: Brendon de Beer

Author URI: https://github.com/monaco-lux

License: GPLv2 or later TBA

Text Domain: TBA

*/

//connection information
$databaseId = "e9dea5e7-2fa7-4f57-9c30-004aa32dc55f";
$url = "https://api.notion.com/v1/databases/$databaseId/query"; //api endpoint
$token = 'secret_PyQGJm7Ja3MFMMacOLr8qjsar5a8B3Hg0CDlvr1XVe4';
$version = '2021-08-16';
$contentType = "Content-type: application/json";

//post data
$data_array =
['filter' =>
    [
      "property"=>"DataElement",
      "title"=>["equals"=>"smallHouse"]
    ]
];

$data = json_encode($data_array);

//intialize cURL
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//below is for posting
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token,
  'Notion-Version: '.$version,$contentType));

$resp = curl_exec($ch);

if($e = curl_error($ch))
{
	echo $e;
} else
{
	$decoded = json_decode($resp, true);
  var_dump($decoded);
}

//file_put_contents('test.json',json_encode($decoded, JSON_PRETTY_PRINT));

curl_close($ch);

?>
