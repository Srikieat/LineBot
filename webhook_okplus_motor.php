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
         
            $isNeedHelp = 0;
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
						$isNeedHelp = 1;
		}

		$dataBlackList = array("แบล็คลิสต์","Black","ติดบูโร","เครดิต","bl","BL");
		
		if (checkSendMessage($dataBlackList,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ติดไม่เกินแสน ออกได้ค่ะ มีไฟแนนท์รองรับ'	
						];	
						$isNeedHelp = 1;
		}

		$dataFinance = array("ไฟแนน");
		
		if (checkSendMessage($dataFinance,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ไฟแนนท์มี กรุงศรี กับ ทีลิสซิ่ง ค่ะ'	
						];	
						$isNeedHelp = 1;
		}
            
		$dataAge = array("อายุ 18","อายุ 19");
		
		if (checkSendMessage($dataAge,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ต้องรอ อายุ 20 ก่อนค่ะ'	
						];	
						$isNeedHelp = 1;
		}

		$dataColor = array("สี");
		
		if (checkSendMessage($dataColor,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'มีรถทุกสีค่ะ'	
						];	
						$isNeedHelp = 1;
		}

		$dataComplete = array("000");
		
		if (checkSendMessage($dataComplete,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'อีกสักครู่จะแจ้งผลกลับนะค่ะ ใช้เวลาประมาณ 15 นาทีค่ะ'	
						];	
						$isNeedHelp = 1;
						$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m=Done');
		}

		

		$dataNoSlip= array("ไม่มีสลิป","สลิปไม่มี","สลิปเงินเดือนไม่มี",);

		if (checkSendMessage($dataNoSlip,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'ไม่มี ไม่เป็นไรค่ะ'	
							];	
							$isNeedHelp = 1;
			
		}


		$dataYamaha= array("ยามา","yama","Yama");

		if (checkSendMessage($dataYamaha,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'ไม่มีค่ะ'	
							];	
							$isNeedHelp = 1;
			
		}


		$dataSlipMonth= array("กี่เดือน");

		if (checkSendMessage($dataSlipMonth,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'เดือนล่าสุดค่ะ'	
							];	
							$isNeedHelp = 1;
			
		}

		$dataSalaryCer= array("รับรองเงินเดือน");
		if (checkSendMessage($dataNoHave,$sendMessage) == 1)
			{
				$messages=  [
								'type' => 'text',
								'text' => 'ใช้ได้ค่ะ'	
							];	
							$isNeedHelp = 1;
			}
		
		
		

		$dataOnline = array("สนใจ");
		
		if (checkSendMessage($dataOnline,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'สนใจออกรถ กรุณาส่งข้อมูลดังนี้'."\n".
							'1. บัตรประชาชน '."\n".
							'2. ที่อยู่ปัจจุบัน '."\n".
							'3. เบอร์โทรศัพท์ '."\n\n\n".
							'สำหรับ พนักงานบริษัท'."\n".
							'1. ที่อยู่ทำงาน '."\n".
							'2.เบอร์ที่ทำงาน '."\n".
							'3.ตำแหน่งและอายุงาน '."\n".
							'4. สลิป (ไม่มีก็ไม่เป็นไร)'."\n\n\n".
							'สำหรับ อาชีพค้าขาย'."\n".
							'- ถ่ายรูปสินค้าหรือหน้าร้าน '."\n\n\n".
							'สำหรับ อาชีพขับวิน'."\n".
							'- ถ่ายรูปเสื้อวิน '."\n\n\n".
							'สำหรับ อาชีพรับจ้าง'."\n".
							'- เบอร์นายจ้างที่ทำงานประจำ '."\n\n\n".

							
							
							'ถ่ายรูปแล้วส่งมาทาง line ได้เลยค่ะ'."\n\n". '*** สำคัญมาก***'."\n".'ส่งเสร็จแล้ว พิมพ์ว่า "000" ค่ะ '."\n".
							'หลังจากนั้นทางร้านจะยื่นเรื่องให้ค่ะ'."\n".
							'ใช้เวลาประมาณ 15 นาที'	
							
						];	
						$isNeedHelp = 1;
		}
		$dataPCX = array("pcx","PCX","Pcx");
		
		if (checkSendMessage($dataPCX,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								
								'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'PCX', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/pcx1.png', // 圖片網址 <不一定需要>
                 						'title' => 'PCX', // 標題 <不一定需要>
		                				'text' => 'รุ่นนี้มีโปร ดาวน์ 4,900'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
                						'actions' => array(
			                      					       array(
                        				 			 	'type' => 'message', // 類型 (連結)
				                         			 	'label' => 'สนใจออกรถออนไลน์', // 標籤 3
				                         			 	'text' => 'สนใจออกรถ' // 連結網址
				                       				          )
			                       					   )
		                					)
					
								
						
							];
							
		}

		$dataScoopy = array("scoo","Scoo","สกุ","สกู");
		
		if (checkSendMessage($dataScoopy,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Scoopy', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/SCOOPY.png', // 圖片網址 <不一定需要>
						 'title' => 'Scoopy-i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
								
						
							];
							
		}
	

		$dataWave = array("Wave","wave","เวฟ");
		
		if (checkSendMessage($dataWave,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Wave', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/wave110.png', // 圖片網址 <不一定需要>
						 'title' => 'Wave 110, Wave 125', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
								
						
							];
							
		}

		$dataClick = array("Click","click","คลิ");
		
		if (checkSendMessage($dataClick,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Click125', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/ClickPromotion1.png', // 圖片網址 <不一定需要>
						 'title' => 'Click-i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
								
						
							];
							
		}

		$dataPayment = array("ผ่อน");
		
		if (checkSendMessage($dataPayment,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								'type' => 'text',
								'text' => 'ข้อมูลตามเวป เลย ค่ะ'."\n".'https://www.okplus.co.th/mobile/newbike.html'
						
							];
							
		}
		$dataShop = array("ไหน","ร้าน","สาขา");
		
		if (checkSendMessage($dataShop,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$messages	=  	[
								'type' => 'text',
								'text' => 'ชื่อ ร้านสามชัยกรุงเทพ'."\n".
								'โทร: 02 115 9962 , 091 575 3685'."\n".
								'เวลาทำการ'."\n".
								'จันทร์ - เสาร์  8.30 - 18.00 '."\n".
								'อาทิตย์ 8.30 - 14.00'."\n\n\n".
								
								
								'ร้านอยู่ระหว่างอ่อนนุช 16 กับ 18'."\n".
								'ตรงข้ามปั้มบางจาก ติดกับ ธ.กรุงเทพ'."\n\n\n".
								
								'แผนที่ https://goo.gl/maps/hXwBwZp8PZqyZdep8'."\n\n\n".
								
								'มาถึงร้านแล้วติดต่อฝ่ายขาย ชื่อ นะ ค่ะ'."\n".
								'แจ้งว่ามาจาก อินเตอร์เน็ต'
						
							];
							
		}


	
	
		if ($isNeedHelp == 0)
		{
			$messageHelp = $sendMessage;
			$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m='.$messageHelp);
			
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


