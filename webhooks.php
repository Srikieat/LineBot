<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html><?php // callback.php

//require "vendor/autoload.php";
//require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');



$access_token = '0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

$array = json_decode(json_encode($content), true);


$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string); //รับ JSON มา decode เป็น StdObj
$array1 = json_decode(json_encode($jsonObj), true);


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
				
		
		
		// detect image
		//
		if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			
			
   
        	// IMXX

 			$message_id = $event['message']['id'];
			
			
			// run your code here
					$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
			
			
	//		$message_id = $array1['events'][0]['message']['id'];
			
			
			
		//	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret]);
			
			
			//$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
			
			//$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret]);
			
		//	$response = $bot->getMessageContent($message_id);
			//$date_file = date("Y-m-d-H-i-s");
		//	$date_file = uniqid();
			
			
		//	if ($response->isSucceeded()) 
		//	{
		//			$message_id = 'i am image';
					// save image
					//$dataBinary = $response->getRawBody();
					//$fileFullSavePath = 'uploadImages/'.$date_file.'.jpg';
					//$fileFullSavePath = 'uploadImages/test.jpg';
					//file_put_contents($fileFullSavePath,$dataBinary);
				
					//$id = $event['source']['userId'];
				
		//			$urlImage = 'https://okplusbot.herokuapp.com/'.$fileFullSavePath;
		//			$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getClosePayment.aspx?u='.$id);;
		//							$str_arr = explode (":", $paymentDetails);  

		//							$contractId=$str_arr[0];
		//							$name = $str_arr[1];
		//							$reference = $str_arr[2];
		//							$loan = $str_arr[3];
		//							$plate = $str_arr[4];
		//							$model = $str_arr[5];
		//							$payment = $str_arr[6];
		//							$noPayment = $str_arr[7];
		//							$firstDt = $str_arr[8];
		//							$closeAmount = $str_arr[9];
		//							$date = date('d/m/Y', time());
				
		//			 $accessToken = "0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=";
					//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   			//		$arrayHeader = array();
   			//		$arrayHeader[] = "Content-Type: application/json";
   			//		$arrayHeader[] = "Authorization: Bearer {$accessToken}";
					
					// Bow lek
					//$pushID = 'Uf55473a52212b163dd7508653ec5bbd8';
					
					//srikieat
			//		$pushID = 'U44e90a4578cb725ccc9ed09d2cdc18e9';
					
				
				
			//		$messages = [
			//			 		 'type' => 'template', //訊息類型 (模板)
              //  					'altText' => 'ลูกค้าส่งสลิป', //替代文字
                //					'template' => array(
                  //  					'type' => 'image_carousel', //類型 (圖片輪播)
                    //					'columns' => array(
                        							//	array(
                            					//			'imageUrl' => 'hhttps://okplusbot.herokuapp.com/uploadImages/test.jpg', //圖片網址
                            				//				'action' => array
											//					(
										//					'type' => 'postback', //類型 (回傳)
										//					'label' => 'Pb example', //標籤
										//					'data' => 'action=buy&itemid=123' //資料
                            				//					)
                        					//				),
                      //  array(
                      //      'imageUrl' => 'https://api.reh.tw/line/bot/example/assets/images/example_1-1.jpg', //圖片網址
                       //     'action' => array(
                       //         'type' => 'message', //類型 (訊息)
                       //         'label' => 'Msg example', //標籤
                       //         'text' => 'Message example' //用戶發送文字
                       //     )
                       // ),
                //        array(
                  //          'imageUrl' => $urlImage , //圖片網址
                    //        'action' => array(
                      //          'type' => 'message', //類型 (連結)
                      //          'label' => $contractId, //標籤
                        //        'text' => $urlImage //連結網址
                          //  )
					//	)
   // )
	//									)
	//					];	
	//				$data = [
	//					'to' => $pushID,
	//					'messages' => [$messages],
	//				];
	//				$post = $data;

	//				$strUrl = "https://api.line.me/v2/bot/message/push";
      //				$ch = curl_init();
      	//			curl_setopt($ch, CURLOPT_URL,$strUrl);
      	//			curl_setopt($ch, CURLOPT_HEADER, false);
      	//			curl_setopt($ch, CURLOPT_POST, true);
      	//			curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      	//			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      	//			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      	//			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      	//			$result = curl_exec($ch);
      	//			curl_close ($ch);
					
				
					
				
				

				
	//		}
				// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			// reply message
			 $messages = [
										'type' => 'text',
				 						'text' => $content
										//'text' => 'Line นี้เป็นระบบอัตโนมัติ'."\n"."\n".'หากต้องการส่งสลิปการชำระค่างวด โปรดส่งสลิปมาที่ Line ด้านล่างนี้ค่ะ  https://lin.ee/6D052q8'."\n"."\n".'ขอบคุณค่ะ'
				 						//'text' => 'ขอบคุณค่ะ'
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

			echo "Reply : " .$result . "\r\n";
		}
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			
			
			
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			 $sendMessage = $event['message']['text'];
			
			
			// Build message to reply back
			
			switch ($sendMessage) {
					
				// send image to customer	URL must be https
				// car copy	
				case "สำเนารถ":
					
					
					$isRegister = file_get_contents('http://okplus.ddns.net/okplus/bot/CheckRegister.aspx?u='.$text);
			
					//$isRegister = "0";
					$isRegister = substr($isRegister, 0, 1);
					
					if ($isRegister === "2")
					{
						
						// ลูกค้าลงทะเบียนแล้ว รอลงสัญญาในระบบ	
					  $messages = [
										'type' => 'text',
										'text' => 'ลงทะเบียนสำเร็จแล้ว แต่ระบบยังตรวจสอบข้อมูลอยู่'."\n"."\n".'(รหัสอ้างอิง:'.$text.')'
									];	
						
					}
					
					if ($isRegister === "1")
					{
						
							$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getRegCopy.aspx?u='.$text);;
									$str_arr = explode (":", $paymentDetails);  

									$completeProcess=$str_arr[0];
									$fileName = $str_arr[1];
						
						
						// find reg copy	
						if ($completeProcess === "1")
						{
						$messages = [
										'type' => 'image',
										'originalContentUrl' => 'https://www.okplus.co.th/RegCopy/'.$fileName.'.jpg',
    									'previewImageUrl' => 'https://www.okplus.co.th/RegCopy/'.$fileName.'.jpg'

									];		
						}
						
						// cannot find reg copy
						if ($completeProcess === "0")
						{
							$messages = [
										'type' => 'text',
										'text' => 'มีข้อผิดพลาดในระบบ โปรดติดต่อเจ้าหน้าที่'

									];	
						}
						 
						// not allow to process reg copy
						if ($completeProcess === "2")
						{
							$messages = [
										'type' => 'text',
										'text' => 'ระบบไม่สามารถทำงานได้ โปรดติดต่อเจ้าหน้าที่'

									];	
						}
						
						
					}
					
						// check close account
					$contractInfo = file_get_contents('http://okplus.ddns.net/okplus/bot/getContractInfo.aspx?u='.$text);;
					$str_Info = explode (":", $contractInfo);
					$status = $str_Info[0];
					$status_name = $str_Info[1];
							
					if ($status === "3")
					{
						  $messages = [
										'type' => 'text',
										'text' => 'ไม่สามารถทำรายการได้'."\n"."\n".'(สถานะ'.$status_name.')'
										];	
					}
					
					break;
					
					case "สายด่วน":
					
					$isRegister = "1:srikieat:12/45263:16April2020;";
					$pos = strpos($isRegister, ";");
					$xxxx = substr($isRegister, 0, $pos);
					   $messages = [
										'type' => 'text',
										'text' => 'เบอร์โทรติดต่อ : 023311798 023311799'	
									];	
					break;
					
					
				case "ยอดปิดบัญชี":
					
						// check register or not
					
					$isRegister = file_get_contents('http://okplus.ddns.net/okplus/bot/CheckRegister.aspx?u='.$text);
			
					//$isRegister = "0";
					$isRegister = substr($isRegister, 0, 1);
					
					if ($isRegister === "2")
					{
						// ลูกค้าลงทะเบียนแล้ว รอลงสัญญาในระบบ	
					  $messages = [
										'type' => 'text',
										'text' => 'ลงทะเบียนสำเร็จแล้ว แต่ระบบยังตรวจสอบข้อมูลอยู่'."\n"."\n".'(รหัสอ้างอิง:'.$text.')'
									];	
						
					}
					
					if ($isRegister === "0")
					{
						
						$messages = [
						'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'ลงทะเบียน', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/Bot/Images/ImgButtonTemplate.png', // 圖片網址 <不一定需要>
                 						'title' => 'บ.โอเคพลัส จำกัด', // 標題 <不一定需要>
		                				'text' => 'ท่านยังไม่ได้ลงทะเบียนในระบบ กรุณาลงทะเบียน', // 文字
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
						
					}
					
						if ($isRegister === "1")
						{
									//$paymentDetails = "63/0457:นาย นิคม สมบรูณ์:621401:10,000:3กน 6787:ZOOMER-X:2,370:12:3 มิถุนายน 2020:24,583";
									$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getClosePayment.aspx?u='.$text);;
									$str_arr = explode (":", $paymentDetails);  

									$contractId=$str_arr[0];
									$name = $str_arr[1];
									$reference = $str_arr[2];
									$loan = $str_arr[3];
									$plate = $str_arr[4];
									$model = $str_arr[5];
									$payment = $str_arr[6];
									$noPayment = $str_arr[7];
									$firstDt = $str_arr[8];
									$closeAmount = $str_arr[9];
									$date = date('d/m/Y', time());
					
									$messages = [
					
					
					
						 "type" => "flex",
    "altText" => "ยอดปิดบัญชี",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "ยอดปิดบัญชี",
            "size" => "lg",
            "align" => "start",
            "weight" => "bold",
            "color" => "#009813"
          ],
          [
            "type" => "text",
            "text" => "฿".$closeAmount,
            "size" => "3xl",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $name,
            "size" => "lg",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $plate,
            "size" => "xs",
            "color" => "#B2B2B2"
          ],
          [
            "type" => "text",
            "text" => "ยอดปิดบ/ช ณ วันที่ " .$date,
            "margin" => "lg",
            "size" => "lg",
            "color" => "#000000"
          ]
			//,
			//  [
            //"type" => "text",
            //"text" => "ยอดตามระบบ",
            //"margin" => "lg",
            //"size" => "xs",
            //"color" => "#000000"
          //]
        ]
      ],
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "separator",
            "color" => "#C3C3C3"
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "เลขที่สัญญา",
                "align" => "start",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $contractId,
                "align" => "end",
                "color" => "#000000"
              ]
            ]
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ค่างวดงวดละ",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $payment,
                "align" => "end"
              ]
            ]
          ],
		
		
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "จำนวนงวด",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $noPayment,
                "align" => "end"
              ]
            ]
          ],
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ชำระงวดแรกวันที่",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $firstDt,
                "align" => "end"
              ]
            ]
          ],
				
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ]
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => " ",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",

            "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://www.okplus.co.th"
            ]
          ]
        ]
      ]
    ]
					
					
					
					
					    ];	
					
						}
					
					
						// check close account
					$contractInfo = file_get_contents('http://okplus.ddns.net/okplus/bot/getContractInfo.aspx?u='.$text);;
					$str_Info = explode (":", $contractInfo);
					$status = $str_Info[0];
					$status_name = $str_Info[1];
							
					if ($status === "3")
					{
						  $messages = [
										'type' => 'text',
										'text' => 'ไม่สามารถทำรายการได้'."\n"."\n".'(สถานะ'.$status_name.')'
										];	
					}
					
					break;
					
						case "ค่างวดคงเหลือ":
					
					
					
						// check register or not
					
					$isRegister = file_get_contents('http://okplus.ddns.net/okplus/bot/CheckRegister.aspx?u='.$text);
			
					//$isRegister = "0";
					$isRegister = substr($isRegister, 0, 1);
					
					if ($isRegister === "2")
					{
						// ลูกค้าลงทะเบียนแล้ว รอลงสัญญาในระบบ	
					  $messages = [
										'type' => 'text',
										'text' => 'ลงทะเบียนสำเร็จแล้ว แต่ระบบยังตรวจสอบข้อมูลอยู่'."\n"."\n".'(รหัสอ้างอิง:'.$text.')'
									];	
						
					}
					
					if ($isRegister === "0")
					{
						
						$messages = [
						'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'ลงทะเบียน', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/Bot/Images/ImgButtonTemplate.png', // 圖片網址 <不一定需要>
                 						'title' => 'บ.โอเคพลัส จำกัด', // 標題 <不一定需要>
		                				'text' => 'ท่านยังไม่ได้ลงทะเบียนในระบบ กรุณาลงทะเบียน', // 文字
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
						
					}
					
						if ($isRegister === "1")
						{
									//$paymentDetails = "63/0516:นาย นิคม สมบรูณ์:621401:10,000:3กน 6787:ZOOMER-X:1,240:12:6:6:3 กรกฎาคม 2020:26 ธันวาคม 2020";
							
									
									$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getPaymentDetail.aspx?u='.$text);;
									$str_arr = explode (":", $paymentDetails);  

									$contractId=$str_arr[0];
									$name = $str_arr[1];
									$reference = $str_arr[2];
									$loan = $str_arr[3];
									$plate = $str_arr[4];
									$model = $str_arr[5];
									$payment = $str_arr[6];
									$noPayment = $str_arr[7];
									$noPaid = $str_arr[8];
									$noRemain = $str_arr[9];
									$firstDt = $str_arr[10];
									$lastDt = $str_arr[11];
					
									$messages = [
					
					
					
						 "type" => "flex",
    "altText" => "ค่างวดคงเหลือ",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "ยอดกู้",
            "size" => "lg",
            "align" => "start",
            "weight" => "bold",
            "color" => "#009813"
          ],
          [
            "type" => "text",
            "text" => "฿".$loan,
            "size" => "3xl",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $name,
            "size" => "lg",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $plate,
            "size" => "xs",
            "color" => "#B2B2B2"
          ],
          [
            "type" => "text",
            "text" => "ชำระแล้ว " .$noPaid. " งวด คงเหลือ " . $noRemain . " งวด",
            "margin" => "lg",
            "size" => "lg",
            "color" => "#000000"
          ]
        ]
      ],
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "separator",
            "color" => "#C3C3C3"
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "เลขที่สัญญา",
                "align" => "start",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $contractId,
                "align" => "end",
                "color" => "#000000"
              ]
            ]
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ค่างวดงวดละ",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $payment,
                "align" => "end"
              ]
            ]
          ],
		
		
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "จำนวนงวด",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $noPayment,
                "align" => "end"
              ]
            ]
          ],
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ชำระงวดแรกวันที่",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $firstDt,
                "align" => "end"
              ]
            ]
          ],
		
	
			
			 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ชำระล่าสุดวันที่",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $lastDt,
                "align" => "end"
              ]
            ]
          ],
		
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ]
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => "จ่ายตรงวัน ลดงวดละ 100 บาท",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",
            "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://www.okplus.co.th"
            ]
          ]
        ]
      ]
    ]
					
					
					
					
					    ];	
					
						}
					
			
					
					// check close account
					$contractInfo = file_get_contents('http://okplus.ddns.net/okplus/bot/getContractInfo.aspx?u='.$text);;
					$str_Info = explode (":", $contractInfo);
					$status = $str_Info[0];
					$status_name = $str_Info[1];
							
					if ($status === "3")
					{
						  $messages = [
										'type' => 'text',
										'text' => 'ไม่สามารถทำรายการได้'."\n"."\n".'(สถานะ'.$status_name.')'
										];	
					}
									
					
					
					break;
					
				case "Myid":
					
					$xxxx = $id = $event['source']['userId'];
					   $messages = [
										'type' => 'text',
										'text' => $xxxx	
									];	
					break;
				// appointment
					
				case "นัดชำระค่างวด":
					
					// check register or not
					
					$isRegister = file_get_contents('http://okplus.ddns.net/okplus/bot/CheckRegister.aspx?u='.$text);
			
					//$isRegister = "0";
					$isRegister = substr($isRegister, 0, 1);
					
					if ($isRegister === "2")
					{
						// ลูกค้าลงทะเบียนแล้ว รอลงสัญญาในระบบ	
					  $messages = [
										'type' => 'text',
										'text' => 'ลงทะเบียนสำเร็จแล้ว แต่ระบบยังตรวจสอบข้อมูลอยู่'."\n"."\n".'(รหัสอ้างอิง:'.$text.')'
									];	
						
					}
					
					if ($isRegister === "0")
					{
						
						$messages = [
						'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'ลงทะเบียน', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/Bot/Images/ImgButtonTemplate.png', // 圖片網址 <不一定需要>
                 						'title' => 'บ.โอเคพลัส จำกัด', // 標題 <不一定需要>
		                				'text' => 'ท่านยังไม่ได้ลงทะเบียนในระบบ กรุณาลงทะเบียน', // 文字
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
						
					}
					if ($isRegister === "1")
					{
						
						
						// check already appointment
						$serverData = file_get_contents('http://okplus.ddns.net/okplus/bot/CheckAppointment.aspx?u='.$text);
						//$serverData = "1:srikieat:12/45263:16April2020;";
						//$serverData = "0:0:0:0;";
						$pos = strpos($serverData, ";");
						$serverData = substr($serverData, 0, $pos);
						
						$str_arr = explode (":", $serverData); 
						
						$isAppoint = $str_arr[0];
						$name=$str_arr[1];
						$contractId = $str_arr[2];
						$dt = $str_arr[3];
						
						// already appointment
						if ($isAppoint == "1")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ท่านมีนัดชำระค่างวดภายในวันที่ : ' . $dt ."\n"."\n".'(หากท่านต้องการเปลี่ยนแปลง กรุณาติดต่อ 023311798)'
									];	
						}
						
						// not allow to appointment
						if ($isAppoint == "2")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ท่านมีค่างวดค้างชำระ กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
								   		//'text' => 'ท่านมีค่างวดต้างชำระ กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
									];	
						}
						
						// still not over due date
						
						if ($isAppoint == "3")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ไม่สามารถนัดได้เนื่องจากยังไม่ถึงงวดแรก ( '  .$dt . ' )'
								   		//'text' => 'ท่านมีค่างวดต้างชำระ กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
									];	
						}
						
						// over due date
						
						if ($isAppoint == "4")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ท่านได้นัดชำระค่างวด ( '  .$dt . ' ) แต่ยังไม่มีการชำระเข้ามา กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
								   		//'text' => 'ท่านมีค่างวดต้างชำระ กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
									];	
						}
						
						// already paid in month
						if ($isAppoint == "5")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ท่า่นได้ชำระค่างวดมาแล้ว ขอบคุณค่ะ'
								   		//'text' => 'ท่านมีค่างวดต้างชำระ กรุณาติดต่อ 023311798 เพื่อทำการนัดชำระค่างวด'
									];	
						}
						
						// allow to appointment
						if ($isAppoint == "0")
						{
							
							
							
							 //start message
							$messages = [
						'type' => 'template', // 訊息類型 (模板)
                				'altText' => 'นัดชำระค่างวด', // 替代文字
                				'template' => array(
                    						'type' => 'buttons', // 類型 (按鈕)
		                				'thumbnailImageUrl' => 'https://okplus.co.th/Bot/Images/ImgButtonTemplate.png', // 圖片網址 <不一定需要>
                 						'title' => 'บ.โอเคพลัส จำกัด', // 標題 <不一定需要>
		                				'text' => 'นัดชำระค่างวด', // 文字
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
				                         				'label' => 'ดำเนินการ', // 標籤 3
				                         				'uri' => 'http://okplus.ddns.net/okplus/OKMO/BotAppoint.aspx?u='.$text // 連結網址
				                       				         )
			                       					   )
		                					)
					
						];	
						// end message
						}
						
						
					}
					
					
						// check close account
					$contractInfo = file_get_contents('http://okplus.ddns.net/okplus/bot/getContractInfo.aspx?u='.$text);;
					$str_Info = explode (":", $contractInfo);
					$status = $str_Info[0];
					$status_name = $str_Info[1];
							
					if ($status === "3")
					{
						  $messages = [
										'type' => 'text',
										'text' => 'ไม่สามารถทำรายการได้'."\n"."\n".'(สถานะ'.$status_name.')'
										];	
					}
					
					break;
  				case "ลงทะเบียน":
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
   					 break;
  					 case "ใบเสร็จ":
   							
					//$paymentDetails = file_get_contents('http://okplus.ddns.net/okplus/bot/getPaymentList.aspx');
					$paymentDetails = "1,430:Big C:14 เมษายน 2563:ชำระค่างวดรถจักรยานยนต์:ราณี สายใจ:8กร 2513:62RC-06200:62/0147:621478";
					$str_arr = explode (":", $paymentDetails);  
					
					$amount=$str_arr[0];
					$channel = $str_arr[1];
					$dt = $str_arr[2];
					$detail = $str_arr[3];
					$name = $str_arr[4];
					$plate = $str_arr[5];
					$receiptId = $str_arr[6];
					$contractId = $str_arr[7];
					$reference = $str_arr[8];
					
					
					

					
				
				// Build message to reply back
				$messages = [
					
					
					
						 "type" => "flex",
    "altText" => "ใบเสร็จรับเงิน",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "header" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "text",
            "text" => "ใบเสร็จรับเงิน",
            "size" => "lg",
            "align" => "start",
            "weight" => "bold",
            "color" => "#009813"
          ],
          [
            "type" => "text",
            "text" => "฿".$amount,
            "size" => "3xl",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $name,
            "size" => "lg",
            "weight" => "bold",
            "color" => "#000000"
          ],
          [
            "type" => "text",
            "text" => $dt,
            "size" => "xs",
            "color" => "#B2B2B2"
          ],
          [
            "type" => "text",
            "text" => $detail,
            "margin" => "lg",
            "size" => "lg",
            "color" => "#000000"
          ]
        ]
      ],
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
          [
            "type" => "separator",
            "color" => "#C3C3C3"
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "เลขที่ใบเสร็จรับเงิน",
                "align" => "start",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $receiptId,
                "align" => "end",
                "color" => "#000000"
              ]
            ]
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "สัญญาเลขที่",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $contractId,
                "align" => "end"
              ]
            ]
          ],
		
		
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "เลขที่อ้างอิง",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $reference,
                "align" => "end"
              ]
            ]
          ],
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ชำระทาง",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $channel,
                "align" => "end"
              ]
            ]
          ],
		
		 [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "lg",
            "contents" => [
              [
                "type" => "text",
                "text" => "ทะเบียนรถ",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "text",
                "text" => $plate,
                "align" => "end"
              ]
            ]
          ],
		
		
		
          [
            "type" => "separator",
            "margin" => "lg",
            "color" => "#C3C3C3"
          ]
        ]
      ],
      "footer" => [
        "type" => "box",
        "layout" => "horizontal",
        "contents" => [
          [
            "type" => "text",
            "text" => "จ่ายตรงวัน ลดงวดละ 100 บาท",
            "size" => "lg",
            "align" => "start",
            "color" => "#0084B6",
            "action" => [
              "type" => "uri",
              "label" => "View Details",
              "uri" => "https://www.okplus.co.th"
            ]
          ]
        ]
      ]
    ]
					
					
					
					
					    ];	
					
					
					
					
					
					
					
					
					 break;
  				         default:
							    $messages = [
										'type' => 'text',
										'text' => 'Line นี้เป็นระบบอัตโนมัติ'."\n".'หากต้องการติดต่อพนักงาน โปรดติดต่อที่ https://lin.ee/6D052q8'	
									];	
				// end case				
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
echo "test";
