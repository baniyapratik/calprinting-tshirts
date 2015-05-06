<?php
// if there is post
if(isset($_POST) && !empty($_POST) ) {
	 // if there is an attachment
	 if(!empty($_FILES['attachment']['name'])) {
				  // store some variables
				  $file_name = $_FILES['attachment']['name'];
			      $temp_name = $_FILES['attachment']['tmp_name'];
				  $file_type = $_FILES['attachment']['type'];
				  
				  // get the extension of the file
				  $base = $basename($file_name);
				  $extension = substr($base, strlen($base)-4, strlen($base));
				  
				  // only these file types will be allowed
				  $allowed_extensions = array("jpeg",".pdf",".psd",".png",".zip");
				  
				  // check that this file type is allowed
				  if(in_array($extension,$allowed_extensions)) {
				  		// mail essentials
						$from = $_POST['fieldFormEmail'];
						$to = "dan_malak11@hotmail.com";
						$subject = "testing email";
						$message = "this is a random message";
						
						// things you need
						$file = $temp_name;
						$content = chunk_split(base64_encode(file_get_conte­nts($file)));
						$uid = md5(uniqid(time()));
						
						// standard mail headers
						$header = "From: ".$from."\r\n";
						$header .= "Reply-To: ".$replyto."\r\n";
						$header .= "MIME-Version: 1.0\r\n";
						
						// declaring we have multiple kinds of email
						$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"­;\r\n\r\n";
						$header .= "Content-Transfer-Encoding: base64\r\n";
						$header .= "Content-Disposition: attachment; filename=\"".$file_name."­\"\r\n\r\n";
						$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
						$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
						
						// plain text part
						$header .= "--".$uid."\r\n";
						$header .= "Content-type:text/plain; charset-iso-8859-1\r\n";
						$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
						$header .= $message."\r\n\r\n";
						
						$header .= "--".$uid."\r\n";
						$header .= "Content-Type: ".$file_type."; name=\"".file_name."\"\r\n";
						$header .= "Content-Transfer-Encoding: base64\r\n";
						$header .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
						$header .= $content."\r\n\r\n";
						
						// send the mail (message not here but in header
						if (mail($to, $subject, "", $header)) {
						  echo "success";
						} else {
						  echo "fail";
						}
						
				  } else {
				  	echo "file type not allowed";
				  }
														  
	 } else {
	 echo "no file posted";
	 }
				
}



?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email Attachment Without Upload - Excellent Web World</title>

</head>
<body>
    <form action="briefform.php" method="post" name="mainform" enctype="multipart/form-data">
    <table width="500" border="0" cellpadding="5" cellspacing="5">
       <tr>
        <th>Your Name</th>
        <td><input name="fieldFormName" type="text"></td>
    </tr>
    <tr>
    <tr>
        <th>Your Email</th>
        <td><input name="fieldFormEmail" type="text"></td>
    </tr>
    <tr>
        <th>To Email</th>
        <td><input name="toEmail" type="text"></td>
    </tr>

    <tr>
        <th>Subject</th>
        <td><input name="fieldSubject" type="text" id="fieldSubject"></td>
    </tr>
    <tr>
        <th>Comments</th>
        <td><textarea name="fieldDescription" cols="20" rows="4" id="fieldDescription"></textarea></td>
    </tr>
    <tr>
      <th>Attach Your File</th>
      <td><input name="attachment" type="file"></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;"><input type="submit" name="Submit" value="Send"><input type="reset" name="Reset" value="Reset"></td>
    </tr>
    </table>
    </form>
</body>
</html>