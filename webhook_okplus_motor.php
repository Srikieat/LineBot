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
		
		
		
				
		if ($event['message']['type'] == 'location')
		{
			$text = $event['source']['userId'];
			$id = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			$lat = $event['message']['latitude'];
			$long = $event['message']['longitude'];
			
			$distance = distance($lat, $long, 13.7100786, 100.6110613, "K");

			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetDistance.aspx?u='.$id.'&d='.$distance);
			
			
			$userName = getDisplayName($id);
			
			if (intval($distance) > 5)
			{
				$messages=  [
							'type' => 'text',
                			//'text' => 'ติดไม่เกินแสน ออกได้ค่ะ มีไฟแนนท์รองรับ'	
							'text' => 'ลูกค้าอยู่นอกเขต ไม่สามารถออกได้ค่ะ'	
						];	
						$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=5');
			}
			else
			{
				$messages=  [
								'type' => 'text',
								'text' => 'ขอบคุณค่ะ'."\n".'ลูกค้ามีประวัติค้างชำระบัตรเครดิต ติดแบล็คลิส หรือ คืนรถจักรยานยนต์ บ้างไหมค่ะ'
						];	
						// end message
					$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m=LocationPass:'.$userName);
					$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=4');
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
		}
		
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			
			// Get text sent
			$text = $event['source']['userId'];
			$id = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			 $sendMessage = $event['message']['text'];
			
			$userName = getDisplayName($text);
			// Build message to reply back
		 	
			$Info = file_get_contents('http://okplus.ddns.net/okplus/bot/OkplusMotorGetInfo.aspx?u='.$id);
		
			$str_arr = explode (";", $Info);  
					
			$state=$str_arr[0];
			$lastMessage= $str_arr[1];
			$lastMessageDT = $str_arr[2];
			$distance = $str_arr[3];
			
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorLastMessage.aspx?u='.$id.'&m='.$sendMessage);

            $isNeedHelp = 0;
			$isMoreMessage = 1;
            $messages = [
                'type' => 'text',
                'text' => 'กรุณารอสักครู่นะค่ะ'
            		];	
			
		if ($state == "1")
		{
				$isNeedHelp = 1;
				$messages = [
                'type' => 'text',
               	'text' => 'ขอบคุณค่ะ'."\n".'ลูกค้ามีประวัติค้างชำระบัตรเครดิต ติดแบล็คลิส หรือ คืนรถจักรยานยนต์ บ้างไหมค่ะ'
            		];
				$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=4');
		}
			
			
			
			
		$skipAnswer  = 1;
		
		// wait for document
		if ($state == "2")
		{
			$skipAnswer = 0;
			$isNeedHelp = 1;
		}
		
			// check blacklist
		if ($state== "4")
		{
			$dataCheckBlackList = array("ไม่");
			if (checkSendMessage($dataCheckBlackList,$sendMessage) == 1)
			{
				$isMoreMessage =1;
				$skipAnswer  = 1;
				$isNeedHelp = 1;
				 $messages = [
                'type' => 'text',
                'text' => 'สนใจออกรถไหมค่ะ'
            		];	
				$state = "0021";
			}
			else
			{
				$dataCheckHave = array("มี");
				if (checkSendMessage($dataCheckHave,$sendMessage) == 1)
				{
					$sendMessage = "BlackList";

				}
				else
				{
					$isMoreMessage =1;
					$skipAnswer  = 1;
					$isNeedHelp = 0;
					
				}
			}
			
		}
		
		// reject customer
		if ($state == "5")
		{
			exit();
		}
			
	
		$dataThanks = array("ขอบคุณ","ได้ค่ะ","ได้คับ","ได้ครับ","ได้คะ");
		
		if (checkSendMessage($dataThanks,$sendMessage) == 1)
		{
			$messages=  [
				             'type' => 'text',
				             'text' => 'ขอบคุณค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
					
		}
        
		$dataHello = array("สวัสดี","ทัก","hi","Hi","HI","สอบถาม","ออกรถ");
		
		if (checkSendMessage($dataHello,$sendMessage) == 1)
		{
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
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
		
		$dataYes = array("ใช่ไหม","ใช่ไไม");
		
		if (checkSendMessage($dataYes,$sendMessage) == 1)
		{
			$messages=  [
				             'type' => 'text',
				             'text' => 'ใช่ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
			
		
		$dataDai = array("ได้ไหม","ได้ไไม");
		
		if (checkSendMessage($dataDai,$sendMessage) == 1)
		{
			$messages=  [
				             'type' => 'text',
				             'text' => 'ได้ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}

		$dataBlackList = array("แบล็คลิสต์","Black","ติดบูโร","เครดิต","bl","BL","คืน","ยึด","ค้าง");
		
		if (checkSendMessage($dataBlackList,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			//'text' => 'ติดไม่เกินแสน ออกได้ค่ะ มีไฟแนนท์รองรับ'	
							'text' => 'เสียใจด้วย ลูกค้าติดประวัติผ่อนไม่ดี (BlackList) ไม่สามารถออกรถได้ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
						$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=5');
		}
			
		
		
		$dataFarLocation = array("ราม","สมุทร","ปาก","ลาด");
		
		if (checkSendMessage($dataFarLocation,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			//'text' => 'ติดไม่เกินแสน ออกได้ค่ะ มีไฟแนนท์รองรับ'	
							'text' => 'ลูกค้าอยู่นอกเขต ไม่สามารถออกได้ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
						$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=5');
		}

			$dataPassLocation = array("อ่อนนุช","พัฒนาการ","บางนา","พึ่งมี","สุขุม","พระราม","เอกมัย","บางจาก");
		
		if (checkSendMessage($dataPassLocation,$sendMessage) == 1)
		{
						$isNeedHelp = 1;
						$skipAnswer  = 1;
						
						$messages=  [
								'type' => 'text',
								'text' => 'ขอบคุณค่ะ'."\n".'ลูกค้ามีประวัติค้างชำระบัตรเครดิต ติดแบล็คลิส หรือ คืนรถจักรยานยนต์ บ้างไหมค่ะ'
						];	
						// end message
					$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m=LocationPass:'.$userName);
					$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=4');
				
		
		}

		$dataFinance = array("ไฟแนน");
		
		if (checkSendMessage($dataFinance,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ไฟแนนท์มี กรุงศรี กับ ทีลิสซิ่ง ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
            
		$dataAge = array("อายุ 18","อายุ 19","อายุ19","อายุ18");
		
		if (checkSendMessage($dataAge,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'ต้องรอ อายุ 20 ก่อนค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}

		$dataColor = array("สี");
		
		if (checkSendMessage($dataColor,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'มีรถทุกสีค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
			
		$dataDocument = array("เอกสาร","หลักฐาน");
		
		if (checkSendMessage($dataDocument,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'เอกสารที่ต้องนำมาด้วย'."\n".
										'1. บัตรประชาชน'."\n".
										'2. สลิปเงินเดือน เดิอนล่าสุด (ถ้ามี)'."\n".
										'3. บัตรพนักงาน (ถ้ามี)'."\n".
										'4. หนังสือรับรองเงินเดือน (ถ้ามี)'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
			
			

		$dataComplete = array("999");
		
		if (checkSendMessage($dataComplete,$sendMessage) == 1)
		{
			$messages=  [
							'type' => 'text',
                			'text' => 'อีกสักครู่จะแจ้งผลกลับนะค่ะ ใช้เวลาประมาณ 15 นาทีค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
			
						$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m=Done:'.$userName);
						$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=3');
		}

		

		$dataNoSlip= array("ไม่มีสลิป","สลิปไม่มี","สลิปเงินเดือนไม่มี",);

		if (checkSendMessage($dataNoSlip,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'ไม่มี ไม่เป็นไรค่ะ'	
							];	
							$isNeedHelp = 1;
							$skipAnswer  = 1;
			
		}


		$dataNoProduct= array("ยามา","yama","Yama","Ad","ad","ฟอร","For","za","for");

		if (checkSendMessage($dataNoProduct,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'ไม่มีค่ะ'	
							];	
							$isNeedHelp = 1;
							$skipAnswer  = 1;
			
		}


		$dataSlipMonth= array("กี่เดือน");

		if (checkSendMessage($dataSlipMonth,$sendMessage) == 1)
		{
		
				$messages=  [
								'type' => 'text',
								'text' => 'เดือนล่าสุดค่ะ'	
							];	
							$isNeedHelp = 1;
							$skipAnswer  = 1;
			
		}

		$dataSalaryCer= array("รับรองเงินเดือน");
		if (checkSendMessage($dataNoHave,$sendMessage) == 1)
			{
				$messages=  [
								'type' => 'text',
								'text' => 'ใช้ได้ค่ะ'	
							];	
							$isNeedHelp = 1;
							$skipAnswer  = 1;
			}
		
		
		$dataGuarantee= array("ค้ำ");
		if (checkSendMessage($dataGuarantee,$sendMessage) == 1)
			{
				$messages=  [
								'type' => 'text',
								'text' => 'ไม่ต้องใช้คนค้ำค่ะ'	
							];	
							$isNeedHelp = 1;
							$skipAnswer  = 1;
			}

			
			
		

		$dataOnline = array("สน");
		
		if (checkSendMessage($dataOnline,$sendMessage) == 1)
		{
				$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=2');
				$isMoreMessage = 0;
				$x_messages = array
									(array
											(
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
												'- เบอร์นายจ้างที่ทำงานประจำ '
											),
									
										array
												(
										'type' => 'text',
										'text' => '*** สำคัญมาก***'."\n".'ส่งเสร็จแล้ว พิมพ์ว่า "999" ค่ะ '."\n".
										'หลังจากนั้นทางร้านจะยื่นเรื่องให้ค่ะ'."\n".
										'ใช้เวลาประมาณ 15 นาที'	
												)
							   );
			
		
							
					
						$isNeedHelp = 1;
						$skipAnswer  = 1;
		}
			
			
		$dataPCX = array("pcx","PCX","Pcx","ซี");
		
		if (checkSendMessage($dataPCX,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');

				$isNeedHelp = 1;
				$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'PCX', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/pcx3.png', // 圖片網址 <不一定需要>
						 'title' => 'PCX', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											 array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 95,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '4,215 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '4,755 * 30', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
			
		
							
		}

		$dataScoopy = array("scoo","Scoo","สกุ","สกู");
		
		if (checkSendMessage($dataScoopy,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Scoopy', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/SCOOPY.png', // 圖片網址 <不一定需要>
						 'title' => 'Scoopy-i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											  array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 47,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '2,590 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,345 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
		
			
		
							
		}
	

		$dataWave = array("Wave","wave","เวฟ","110","เวป");
		
		if (checkSendMessage($dataWave,$sendMessage) == 1)
		{
			
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Wave 110i', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/wave110.png', // 圖片網址 <不一定需要>
						 'title' => 'Wave 110i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
												 array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 44,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '2,455 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,170 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
							
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
			
			
			
		
							
		}
			
			
			
			$dataWave125 = array("Wave125","wave125","เวฟ125","เวป 125","Wave 125","wave 125","เวฟ 125","เวป 125");
		
		if (checkSendMessage($dataWave125,$sendMessage) == 1)
		{
			
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Wave 125i', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/wave110.png', // 圖片網址 <不一定需要>
						 'title' => 'Wave 125i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
												 array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 53,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '2,930 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,780 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
							
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
			
			
			
		
							
		}
			
			
			$dataQbix = array("Qbix");
		
		if (checkSendMessage($dataQbix,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');

				$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'QBIX', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/QBIX.png', // 圖片網址 <不一定需要>
						 'title' => 'QBIX', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											  array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 56,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,110 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '4,015 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
			
		
							
		}
			
			
			$dataFilano = array("Filano");
		
		if (checkSendMessage($dataFilano,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');

				$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Grand Filano', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/filanoPromotion1.png', // 圖片網址 <不一定需要>
						 'title' => 'Grand Filano', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											 array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 56,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,110 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '4,015 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
							   );
			
		
							
		}
			
			
			
			
			
			
			
			
			
		
			
			
			
			

		$dataClick = array("Click","click","คลิ");
		
		if (checkSendMessage($dataClick,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Click 125', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/ClickPromotion1.png', // 圖片網址 <不一定需要>
						 'title' => 'Click 125i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											  array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 53,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '2,790 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,605 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
								
								
							   );

							
		}
			
			
			
			
			
			
				$dataClick150 = array("Click150","click150","Click 150","click 150","คลิก 150","คลิก150","คลิ้ก150","คลิ้ก 150","คลิ๊ก150","คลิ๊ก 150");
		
		if (checkSendMessage($dataClick150,$sendMessage) == 1)
		{
			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$id.'&s=1');
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$isMoreMessage = 0;
			$x_messages = array(array
									(
				'type' => 'template', // 訊息類型 (模板)
				'altText' => 'Click 150', // 替代文字
				'template' => array(
							'type' => 'buttons', // 類型 (按鈕)
						'thumbnailImageUrl' => 'https://okplus.co.th/images/bike/ClickPromotion1.png', // 圖片網址 <不一定需要>
						 'title' => 'Click 150i', // 標題 <不一定需要>
						'text' => 'รุ่นนี้ฟรีดาวน์ ออกรถ 0 บ'."\n".'ไม่ต้องใช้คนค้ำ'."\n".'ฟรีประกันรถหาย + พรบ + จดทะบียน', // 文字
						'actions' => array(
											  array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => 'ราคา 59,000', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '3,035 * 36', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
							 					array(
                            								'type' => 'message', // 類型 (訊息)
				                 				       'label' => '4,000 * 24', // 標籤 2
				                   				     'text' => 'สอบถาม' // 用戶發送文字
				                 				     ),
											 array(
										  'type' => 'message', // 類型 (連結)
										  'label' => 'สนใจออกรถออนไลน์', // 標籤 3
										  'text' => 'สนใจออกรถ' // 連結網址
												 )
										  )
							)
									),
								
								array(
							'type' => 'text',
							'text' =>'ปัจจุบันลูกค้าพักอยู่ที่ไหนค่ะ (กดปุ่มข้างล่างนี้เพิ่อระบุที่อยู่)',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'ระบุที่อยู่'
																	)
																)
										  ]
										  
										  )
				)
								
								
							   );

							
		}

			
			

		
		if (checkSendMessage($dataPayment,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$messages	=  	[
								'type' => 'text',
								'text' => 'ข้อมูลตามเวป เลย ค่ะ'."\n".'https://www.okplus.co.th/mobile/newbike.html'
						
							];
							
		}

		$dataPayment = array("ผ่อน","ราคา");
		
		if (checkSendMessage($dataPayment,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$messages	=  	[
								'type' => 'text',
								'text' => 'ข้อมูลตามเวป เลย ค่ะ'."\n".'https://www.okplus.co.th/mobile/newbike.html'
						
							];
							
		}
		$dataShop = array("ไหน","ร้าน","สาขา","รับรถ","เบอร์","ติดต่อ");
		
		if (checkSendMessage($dataShop,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$skipAnswer  = 1;
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
			
			$dataMoreDown = array("ถ้าดาวน์","ดาวน์เพิ่ม","ถ้าผมดาวน์","7000","8000","5000","9000","10000","12000","15000","20000","3000","6000","หมื่น");
		
		if (checkSendMessage($dataMoreDown,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
			$skipAnswer  = 1;
			$messages	=  	[
								'type' => 'text',
								'text' => 'รบกวนสอบถามข้อมูลเพิ่มเติมที่'."\n".
								'ชื่อ ร้านสามชัยกรุงเทพ'."\n".
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

			$dataLocation = array("lo","Lo");
			if (checkSendMessage($dataLocation,$sendMessage) == 1)
		{
			$isNeedHelp = 1;
				$skipAnswer  = 1;
				$isMoreMessage=0;
				
			$x_messages = [array(
							'type' => 'text',
							'text' =>'quickreply',
							'quickReply' => 
									array(
												'items'=>[array(
																'types'=>'action',
													'action'=>array(
																		'type'=>'location',
																		'label'=>'i am location'
																	)
																)
										  ]
										  
										  )
				)];
				
					
				
				
							
		}
			
			
		
		$dataHiReturn = array('พี่คับ','พี่ครับ','พี่คะ','ครับ','คับ','คะ','ค่ะ','งั้น');
		if (checkExactMessage($dataHiReturn,$sendMessage) == 1)
		{
			$messages=  [
				             'type' => 'text',
				             'text' => 'ค่ะ'	
						];	
						$isNeedHelp = 1;
						$skipAnswer  = 1;
						$state = "258";
		}	
			
			
		// set command
			
		$dataCommand = array('set5');
		if (checkSendMessage($dataCommand,$sendMessage) == 1)
		{
			$str_arr = explode (":", $sendMessage); 
			$arr_id=$str_arr[0];
			$arr_cmd = $str_arr[1];
			$help = file_get_contents('http://okplus.ddns.net/okplus/bot/okplusMotorSetState.aspx?u='.$arr_id.'&s=5');
			
			
			$isMoreMessage =1;
			$skipAnswer  = 1;
			$isNeedHelp = 1;
			
			 $messages = [
                'type' => 'text',
                'text' => 'Command Completed:'.$arr_cmd
            		];	
			
		}	
	
	
		if ($isNeedHelp == 0)
		{
			$messageHelp = $userName.":".$sendMessage;
			$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m='.$messageHelp);
			$help = file_get_contents('https://okplusbot.herokuapp.com/botPushOkplusMotor.php?u=U44e90a4578cb725ccc9ed09d2cdc18e9&m='.$id);
			   $messages = [
                'type' => 'text',
                'text' => 'กรุณารอสักครู่นะค่ะ'
            		];	
			
		}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			if ($isMoreMessage ==0)
			{
				$data = [
			 	'replyToken' => $replyToken,
				 'messages' => $x_messages,
			 	];	
				
			}
			else
			{
				$data = [
			 	'replyToken' => $replyToken,
				'messages' => [$messages]
			 	];	
			}
			 
			

			
			
			
			if ($skipAnswer  == 1)
			{
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
} 


