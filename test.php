<?php

echo 'test';

$ftp_server="119.59.120.23";
 $ftp_user_name="okplusc1";
 $ftp_user_pass="2A3w7tFm7j";
 $file = "uploadImages/image.png";//tobe uploaded
 $remote_file = "public_html/RegCopy/image.png";

// set up basic connection
 //$conn_id = ftp_connect($ftp_server);

 // login with username and password
 //$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

 // upload a file
 //if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
   // echo "successfully uploaded $file\n";
    //exit;
 //} else {
   // echo "There was a problem while uploading $file\n";
  //exit;
  //  }
 // close the connection
 //ftp_close($conn_id);

?>
