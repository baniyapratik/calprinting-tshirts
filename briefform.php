<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/full-slider.css" rel="stylesheet">
    <link href="css/screen.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
    $(function(){
      $("#header").load("header/header.html"); 
      $("#footer").load("footer/footer.html"); 
    });
    </script> 

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
				  
				  $base = basename("$file_name");
				  $extension = substr($base, strlen($base)-4, strlen($base));
				 
				 
				  // only these file types will be allowed
				  $allowed_extensions = array("jpeg",".pdf",".psd",".png",".zip");
				  
				  // check that this file type is allowed
				  if(in_array($extension,$allowed_extensions)) {
				  		// mail essentials
						$from = $_POST['fieldFormEmail'];
						$replyto = $_POST['fieldFormName'];
						$to = $_POST['toEmail'];
						$subject = "testing email";
						$message = "this is a random message";
						
						// things you need
						$file = $temp_name;
						$content = chunk_split(base64_encode(file_get_contents($file)));
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
						$header .= "Content-Type: ".$file_type."; name=\"".$file_name."\"\r\n";
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
<div id="header"></div>
	<div class="col-md-9 col-md-push-4">
	 <img src="http://static1.squarespace.com/static/53c43c0ee4b01b8adb4e431a/t/53ed49cae4b02ea8d2ed6cf1/1408059851530/" height="300px" align="center">
	 <p class="h2"> Upload your files<br> <small> Today</small></p>
	</div>
	<div class="rapper">
      <div class="container" id="inner">
      
          <form action="briefform.php" method="post" name="mainform" enctype="multipart/form-data">
          <table width="500" border="0" cellpadding="5" cellspacing="5">
             <tr>
              <th>Your Name</th>
              <td><input name="fieldFormName" style="height:40px;font-size:14pt;" type="text"><br><br></td>
          </tr>
          <tr>
          <tr>
              <th>Your Email</th>
              <td><input name="fieldFormEmail" style="height:40px;font-size:14pt;" type="text"><br><br></td>
          </tr>
          <tr>
              <th>To Email</th>
              <td><input name="toEmail" style="height:40px;font-size:14pt;" type="text"><br><br></td>
          </tr>
      
          <tr>
              <th>Subject</th>
              <td><input name="fieldSubject" type="text" style="height:40px;font-size:14pt;" id="fieldSubject"><br><br></td>
          </tr>
          <tr>
              <th>Comments</th>
              <td><textarea name="fieldDescription" cols="20" rows="4" id="fieldDescription"></textarea><br><br></td>
          </tr>
          <tr>
            <th>Attach Your First File</th>
            <td><input name="attachment1" type="file"><br><br></td>
          </tr>
      	<tr>
            <th>Attach Another File <small>Optional</small></th>
            <td><input name="attachment2" type="file"><br><br></td>
          </tr>
      	<tr>
            <th>Attach Another File <small>Optional</small></th>
            <td><input name="attachment3" type="file"><br><br></td>
          </tr>
          <tr>
              <td colspan="2" style="text-align:center;"><input type="submit" name="Submit" value="Send"> <input type="reset" name="Reset" value="Reset"></td>
          </tr>
          </table>
          </form>
      </div>
	</div>
<div id="footer"></div>
</body>

<style>
.rapper {
background-color: silver; }

#inner {
align:center;
background-color:white; }
</style>



</html>