<?php
   $accessToken = "0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   
   	//รับ id ของผู้ใช้
  	 $id = "U44e90a4578cb725ccc9ed09d2cdc18e9";
	//$id= $_GET['u'];
	
//$text = $_GET['t'];
   echo($id);
//echo($text);
			//$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getPaymentList.aspx?u='.$id);
			//		$paymentDetails = "1,430:Big C:14 เมษายน 2563:ชำระค่างวดรถจักรยานยนต์:ราณี สายใจ:8กร 2513:62RC-06200:62/0147:621478";
			//		$str_arr = explode (":", $text);  
					
			//		$amount=$str_arr[0];
			//		$channel = $str_arr[1];
			//		$dt = $str_arr[2];
			//		$detail = $str_arr[3];
			//		$name = $str_arr[4];
			//		$plate = $str_arr[5];
			//		$receiptId = $str_arr[6];
			//		$contractId = $str_arr[7];
			//		$reference = $str_arr[8];
					
					
					

					
				
				// Build message to reply back
				$messages = [
										'type' => 'image',
										'originalContentUrl' => 'https://www.okplus.co.th/RegCopy/132564484499877552.jpg',
    									'previewImageUrl' => 'https://www.okplus.co.th/RegCopy/132564484499877552.jpg'

									];	
					










      
	$data = [
				'to' => $id,
				'messages' => [$messages],
			];
			$post = $data;
   
      //$arrayPostData['to'] = $id;
      //$arrayPostData['messages'][0]['type'] = "text";
      //$arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
      //$arrayPostData['messages'][1]['type'] = "sticker";
      //$arrayPostData['messages'][1]['packageId'] = "2";
      //$arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$post);
   
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>






