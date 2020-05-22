<?php



require "vendor/autoload.php";

$access_token = '9qdNZtBI6urLTohgjHLutRo/5gELhmrx7PukSdauW8fsFBwcdN+ozxNH1XVj4kkCNu/T30nl2oITOMvdQ6QlcLOqgO+Ji+JSnH+rRXUtC1Xg5vx32G8vseS4VZ+Mc83SBp2IPpuAzcH+aOBgzgEuhQdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'df1d8d8ef1b407d1c31c7b1aac6e8027';



$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);

$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$msg = $_GET['m'];
$pushID = $_GET['u'];
  //'U44e90a4578cb725ccc9ed09d2cdc18e9';
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







