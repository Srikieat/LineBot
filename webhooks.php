<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html><?php // callback.php

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
			
				// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			// reply message
			 $messages = [
										'type' => 'text',
										'text' => 'Line นี้เป็นระบบอัตโนมัติ'."\n"."\n".'หากต้องการส่งสลิปการชำระค่างวด โปรดส่งสลิปมาที่ Line ด้านล่างนี้ค่ะ  https://lin.ee/6D052q8'."\n"."\n".'ขอบคุณค่ะ'
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
					
					$isRegister = "1:srikieat:12/45263:16April2020;";
					$pos = strpos($isRegister, ";");
					$xxxx = substr($isRegister, 0, $pos);
					   $messages = [
										'type' => 'text',
										'text' => 'ขออภัย ยังใช้งานไม่ได้'	
									];	
					break;
					
						case "ค่างวดคงเหลือ":
					
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
					
				case "Test":
					$isRegister = "1:srikieat:12/45263:16April2020;";
					$pos = strpos($isRegister, ";");
					$xxxx = substr($isRegister, 0, $pos);
					   $messages = [
										'type' => 'text',
										'text' => $xxxx	
									];	
					break;
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
						
						if ($isAppoint == "1")
						{
							   $messages = [
										'type' => 'text',
										'text' => 'ชื่อ : '	. $name . ''."\n".'เลขที่สัญญา :' . $contractId . ''."\n".'ท่านมีนัดชำระค่างวดภายในวันที่ : ' . $dt ."\n"."\n".'(หากท่านต้องการเปลี่ยนแปลง กรุณาติดต่อ 023311798)'
									];	
						}
						
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
