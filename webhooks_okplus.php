<?php // callback.php

// state
//0 follow
//1 รุ่น
//2 สนใจ
//4 check blacklist
//3 000
//5 reject


// release note
// version 2 : check location morethan 5 reject
// version 3 : check black list then reject 29/5/2563
// version 4 : fix check black list 30/5/2563
// version 5 : add price and payment info 1/6/2563
// version 6 : fix blacklist 4/5/2563
// version 7 : moreDown 5/5/2563
// version 8 : Admin Command SET5 5/6/2563

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '0c1mevGh8lDmxa4wmhr0g52tTduTLEBlV2cu8Mcyc8ZinK0b5GhELE68eB5LX5ph9Rtc0cg2eWaRPlk/dCwZi1XvNncQTG7cqzVkgQq9LiOE4zf328tQaqRT3JcVv0HWHjE2oY5JHGdgoEwz3viJewdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// user define function
function checkSendMessage($arrKeyword, $message)
{
	$isFound =0;
	foreach ($arrKeyword as $keyword) 
        {
		if (strpos($message,$keyword) !== false) 
             {
                $isFound = 1;
             }
         }
	return $isFound;

}

function checkExactMessage($arrKeyword, $message)
{
	$isFound =0;
        foreach ($arrKeyword as $keyword) 
        {
		if ($message == $keyword) 
             {
                $isFound = 1;
             }
		}
         
	return $isFound;

}
function getDisplayName($id)
{
	$access_token = '9qdNZtBI6urLTohgjHLutRo/5gELhmrx7PukSdauW8fsFBwcdN+ozxNH1XVj4kkCNu/T30nl2oITOMvdQ6QlcLOqgO+Ji+JSnH+rRXUtC1Xg5vx32G8vseS4VZ+Mc83SBp2IPpuAzcH+aOBgzgEuhQdB04t89/1O/w1cDnyilFU=';
	$url = 'https://api.line.me/v2/bot/profile/'.$id;
	$headers = array('Authorization: Bearer ' . $access_token);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	//echo $result
	$profile = json_decode($result, true);
	$displayName =  $profile['displayName'];
	$pictureUrl = $profile['pictureUrl'];
	
	return $displayName;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) 
{
	
//echo distance(13.709404, 100.611131, 13.7100786, 100.6110613, "K") . " km<br>";
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

// end function



// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event

			
			
	foreach ($events['events'] as $event) {
		if ($event['type'] == "unfollow") 
		{
			$id = $event['source']['userId'];
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorUnfollow.aspx?u='.$id);
		}
	
		
		if ($event['type'] == "follow") 
		{
 			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			$id = $event['source']['userId'];
			$userName = getDisplayName($text);
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorFollow.aspx?u='.$id.'&n='.$userName);
			
			
			
			
			
			// start message
				$messages=  [
				             'type' => 'text',
				             'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'OKPLUS MOTOR', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/images/newbike_front.png', // 圖片網址 <不一定需要>
                 						'title' => 'OKPLUS MOTOR', // 標題 <不一定需要>
		                				'text' => 'สวัสดีค่ะ'."\n".'สนใจรถรุ่นไหนค่ะ', // 文字
                						'actions' => array(
			                      					  
			                       					 array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'Scoopy-i', // 標籤 2
				                   				     'text' => 'Scoopy' // 用戶發送文字
				                 				     ),
			                        				   array(
                        				 				'type' => 'message', // 類型 (連結)
				                         				'label' => 'Wave', // 標籤 3
				                         				'text' => 'Wave' // 連結網址
				                       				         )
			                       					   ,
			                        				   array(
                        				 				'type' => 'message', // 類型 (連結)
				                         				'label' => 'Click', // 標籤 3
				                         				'text' => 'Click' // 連結網址
				                       				         )
			                       					   ,
			                        				   array(
                        				 				'type' => 'message', // 類型 (連結)
				                         				'label' => 'PCX', // 標籤 3
				                         				'text' => 'PCX' // 連結網址
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
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
		{
			
			
			// Get text sent
			$text = $event['source']['userId'];
			$id = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			 $sendMessage = $event['message']['text'];
			
			$userName = getDisplayName($text);
			
			
			
			$setInitial = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorFollow.aspx?u='.$id.'&n='.$userName);
			
			$setLastMessage = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorLastMessage.aspx?u='.$id.'&m='.$sendMessage);
						
			
			// Build message to reply back
		 	
			$Info = file_get_contents('http://okplus.ddns.net/okplus/bot/OkplusMotorGetInfo.aspx?u='.$id);

            $messages = [
                'type' => 'text',
                'text' => 'กรุณารอสักครู่นะค่ะ'
            		];	
							
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
		
				$data = [
			 	'replyToken' => $replyToken,
				'messages' => [$messages]
			 	];	
		
			 
		
				
			
			

			
		}
	}
}
