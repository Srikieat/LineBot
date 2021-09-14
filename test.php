<?php

echo 'test333';

$ch = curl_init();
$localfile = '/uploadImages/image.png';
$remotefile = 'public_html/RegCopy/image.png';
$fp = fopen($localfile, 'r');
curl_setopt($ch, CURLOPT_URL, 'ftp://okplusc1:2A3w7tFm7j@119.59.120.23:2002/'.$remotefile);
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
curl_exec ($ch);
$error_no = curl_errno($ch);

echo $error_no;

curl_close ($ch);
if ($error_no == 0) {
    $error = 'File uploaded succesfully.';
} else {
    $error = 'File upload error.';
}



//$ftp_server="119.59.120.23";
 //$ftp_user_name="okplusc1";
 //$ftp_user_pass="2A3w7tFm7j";
 //$file = "uploadImages/image.png";//tobe uploaded
 //$remote_file = "public_html/RegCopy/image.png";
//echo '1';

// set up basic connection
 //$conn_id = ftp_connect($ftp_server);
//echo '2';
 // login with username and password
 //$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//echo '3';

 // upload a file
 //if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
    //echo "successfully uploaded $file\n";
   // exit;
 //} else {
   // echo "There was a problem while uploading $file\n";
  //exit;
  //  }
 // close the connection
 //ftp_close($conn_id);


// Ref : http://php.net/manual/en/function.ftp-put.php

//$name = "image.png";
//$filename = "uploadImages/image.png";

//-- Code to Transfer File on Server Dt: 06-03-2008 by Aditya Bhatt --//
//-- Connection Settings
//$ftp_server = "119.59.120.23"; // Address of FTP server.
//$ftp_user_name = "okplusc1"; // Username
//$ftp_user_pass = '2A3w7tFm7j'; // Password
//$destination_file = "/public_html/RegCopy/image.png"; //where you want to throw the file on the webserver (relative to your login dir)

//echo '<br>854444';

//$conn_id = ftp_connect($ftp_server,2002,30) or die("<span style='color:#FF0000'><h2>Couldn't connect to $ftp_server</h2></span>");        // set up basic connection

//echo $conn_id;

//$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("<span style='color:#FF0000'><h2>You do not have access to this ftp server!</h2></span>");   // login with username and password, or give invalid user message

//if ((!$conn_id) || (!$login_result)) {  // check connection
    // wont ever hit this, b/c of the die call on ftp_login
  //  echo "<span style='color:#FF0000'><h2>FTP connection has failed! <br />";
   // echo "Attempted to connect to $ftp_server for user $ftp_user_name</h2></span>";
    //exit;
//} else {
//    echo "Connected to $ftp_server, for user $ftp_user_name <br />";
//}

//$upload = ftp_put($conn_id, $destination_file.$name, $filename, FTP_BINARY);  // upload the file
//if (!$upload) {  // check upload status
  //  echo "<span style='color:#FF0000'><h2>FTP upload of $filename has failed!</h2></span> <br />";
//} else {
  //  echo "<span style='color:#339900'><h2>Uploading $name Completed Successfully!</h2></span><br /><br />";
//}
//ftp_close($conn_id); // close the FTP stream    


?>
