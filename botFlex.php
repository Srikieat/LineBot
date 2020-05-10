<?php



require "vendor/autoload.php";

$access_token = '0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'df1d8d8ef1b407d1c31c7b1aac6e8027';



$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);

$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$msg = '123';
$pushID = 'U44e90a4578cb725ccc9ed09d2cdc18e9';


// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$msg],
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

//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);
//$response = $bot->pushMessage($pushID, $textMessageBuilder);

//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







