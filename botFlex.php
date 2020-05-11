<?php
   $accessToken = "0jFIiIq0JnX9WLpNo+ZMNnVKOSP3IYtDwwqLNSwnR3PyIqo+pTSIdJyY0fLkxQEBSGB7h1OA/ZlRTeHiYeb6v/B7Xnla6B2RO0oIjXfuLFKLKp5kwGc1ZwyR/Ye2KAAnD+fXr3MR7/eCN6ilzs6CQAdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   //รับ id ของผู้ใช้
   $id = "U44e90a4578cb725ccc9ed09d2cdc18e9";
   
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






