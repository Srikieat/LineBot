<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '9qdNZtBI6urLTohgjHLutRo/5gELhmrx7PukSdauW8fsFBwcdN+ozxNH1XVj4kkCNu/T30nl2oITOMvdQ6QlcLOqgO+Ji+JSnH+rRXUtC1Xg5vx32G8vseS4VZ+Mc83SBp2IPpuAzcH+aOBgzgEuhQdB04t89/1O/w1cDnyilFU=';

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
// end function

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		if ($event['type'] == "unfollow") 
		{
			$id = $event['source']['userId'];
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/unfollowLine.aspx?u='.$id);
		}
	
		
		if ($event['type'] == "follow") 
		{
 			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			
			
			
			
			
			
			// start message
				$messages = [
						
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
			
			
			// Build message to reply back
         
            
            $messages = [
                'type' => 'text',
                'text' => 'กรุณารอสักครู่นะค่ะ'	
            ];	

        
		$dataHello = array("สวัสดี","ทัก","hi","Hi","HI","สอบถาม");
		
		if (checkSendMessage($dataHello,$sendMessage) == 1)
		{
			$messages=  [
				             'type' => 'text',
				             'text' => 'สวัสดีค่ะ'."\n".'สนใจรถรุ่นไหนค่ะ'	
				        ];	
		}

		$dataBlackList = array("แบล็คลิสต์","Black","ติดบูโร","เครดิต","bl","BL");
		
		if (checkSendMessage($dataBlackList,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ติดไม่เกินแสน ออกได้ค่ะ มีไฟแนนท์รองรับ'	
				        ];	
		}

		$dataFinance = array("ไฟแนน");
		
		if (checkSendMessage($dataFinance,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ไฟแนนท์มี กรุงศรี กับ ทีลิสซิ่ง ค่ะ'	
				        ];	
		}
            
		$dataAge = array("อายุ 18","อายุ 19");
		
		if (checkSendMessage($dataAge,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ต้องรอ อายุ 20 ก่อนค่ะ'	
				        ];	
		}

		$dataColor = array("สี");
		
		if (checkSendMessage($dataColor,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'มีรถทุกสีค่ะ'	
				        ];	
		}
		$dataPCX = array("pcx","PCX","Pcx");
		
		if (checkSendMessage($dataPCX,$sendMessage) == 1)
		{
			
			$messages	=  [
							
								'type'=>'text', 
								'text'=>'รุ่นนี้มีโปร ดาวน์ 4,900'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน'."\n".'แถมเสื้อ + หมวก'."\n"."\n"."\n".'ลูกค้าสนใจออกรถไหมค่ะ'
								
						
							
							// { 'type'=>'text', 'text'=>'รุ่นนี้มีโปร ดาวน์ 4,900'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน'."\n".'แถมเสื้อ + หมวก' }, 
							// { 'type'=>'text', 'text'=>'สนใจออกรถไหมค่ะ' } 
				        ];	
		}
	


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


