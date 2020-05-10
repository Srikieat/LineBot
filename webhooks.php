<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);


// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		
	
		
		if ($event['type'] == "follow") 
		{
 			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			
			
			
			
			
			
			// start message
				$messages = [
						'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'ลงทะเบียน', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/Bot/Images/ImgButtonTemplate.png', // 圖片網址 <不一定需要>
                 						'title' => 'บ.โอเคพลัส จำกัด', // 標題 <不一定需要>
		                				'text' => 'ยินดีต้อนรับเข้าสู่ระบบ', // 文字
                						'actions' => array(
			                      					//  array(
                            							//	'type' => 'postback', // 類型 (回傳)
				                 				//       'label' => 'Postback example', // 標籤 1
				                   				//     'data' => 'action=buy&itemid=123' // 資料
                        			  				//    ),
			                       					// array(
                            							//	'type' => 'message', // 類型 (訊息)
				                 				//       'label' => 'Message example', // 標籤 2
				                   				//     'text' => 'Message example' // 用戶發送文字
				                 				//     ),
			                        				   array(
                        				 				'type' => 'uri', // 類型 (連結)
				                         				'label' => 'ลงทะเบียน', // 標籤 3
				                         				'uri' => 'http://okplus.ddns.net/okplus/OKMO/Bot.aspx?u='.$text // 連結網址
				                       				         )
			                       					   )
		                					)
					
						];	
						// end message
			
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

			echo "Your ID is : ".$result . "\r\n";
		}
				
		
		
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			 $sendMessage = $event['message']['text'];
			
			
				 $message = [
							    		'type' => 'text',
									'text' => 'Line นี้เป็นระบบอัตโนมัติ'."\n".'หากต้องการติดต่อพนักงาน โปรดติดต่อที่ https://lin.ee/6D052q8'	
						    		];
			
			
			
			header( "location: http://www.ireallyhost.com" );

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

			echo "Reply : " .$result . "\r\n";
		}
	}
}
echo "test";
