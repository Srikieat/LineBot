<?php

$paymentDetails = file_get_contents('http://okplus.thddns.net:9330/okplus/bot/botWakeup.aspx');
echo $paymentDetails;
?>
