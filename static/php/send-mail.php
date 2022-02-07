<?php
if($_POST && isset($_FILES['file']))
{
	$recipient_email 	= "1.handwerk.de@gmail.com"; //recepient
	$from_email 		= "info@1-handwerk.de"; //from email using site domain.
	$subject			= "Attachment email from 1-handwer.de website!"; //email subject line
	

	$sender_name = filter_var($_POST["sender_name"], FILTER_SANITIZE_STRING); //capture sender name
	$sender_email = filter_var($_POST["sender_email"], FILTER_SANITIZE_STRING); //capture sender email
	$sender_message = filter_var($_POST["sender_message"], FILTER_SANITIZE_STRING); //capture message
	$sender_tel = filter_var($_POST["sender_tel"], FILTER_SANITIZE_STRING); //capture tel


	// $sender_type_of_work_select = filter_var($_POST["type_of_work_select"], FILTER_SANITIZE_STRING); //capture type_of_work_select
	// $location  = filter_var($_POST["location"], FILTER_SANITIZE_STRING); //capture location

	$attachments = $_FILES['file'];
	
	//php validation
    if(strlen($sender_name)<4){
        die('Name is too short or empty');
    }
	if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
	  die('Invalid email');
	}
    if(strlen($sender_message)<4){
        die('Too short message! Please enter something');
    }
	
	$file_count = count($attachments['name']); //count total files attached
	$boundary = md5("sanwebe.com"); 
	
	
	$svg_smaile_face_Content = '<svg width="5em" height="5em" viewbox="0 0 16 16" class="bi bi-emoji-smile"  fill="#adac70" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
	<path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683z"/>
	<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
	</svg>';
	
	
	$svg_sad_face_Content = '<svg width="5em" height="5em" viewbox="0 0 16 16" class="bi bi-emoji-frown" fill="#adac70" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
	<path fill-rule="evenodd" d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683z"/>
	<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
	</svg>';

	if($file_count > 0){ //if attachment exists
		//header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "From:".$from_email."\r\n"; 
		$headers .= "Reply-To: ".$sender_email."" . "\r\n";
		$headers .= "kunde_Name: ".$sender_name."" . "\r\n";
		$headers .= "Tel-Number: ".$sender_tel."" . "\r\n";
		// $headers .= "Location: ".$location."" . "\r\n";
		// $headers .= "Type_of_work: ".$sender_type_of_work_select."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($sender_message)); 

		//attachments
		for ($x = 0; $x < $file_count; $x++){		
			if(!empty($attachments['name'][$x])){
				
				if($attachments['error'][$x]>0) //exit script and output error if we encounter any
				{
					$mymsg = array( 
					1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
					2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form", 
					3=>"The uploaded file was only partially uploaded", 
					4=>"No file was uploaded", 
					6=>"Missing a temporary folder" ); 
					die($mymsg[$attachments['error'][$x]]); 
				}
				
				//get file info
				$file_name = $attachments['name'][$x];
				$file_size = $attachments['size'][$x];
				$file_type = $attachments['type'][$x];
				
				//read file 
				$handle = fopen($attachments['tmp_name'][$x], "r");
				$content = fread($handle, $file_size);
				fclose($handle);
				$encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)
				
				$body .= "--$boundary\r\n";
				$body .="Content-Type: $file_type; name=\"$file_name\"\r\n";
				$body .="Content-Disposition: attachment; filename=\"$file_name\"\r\n";
				$body .="Content-Transfer-Encoding: base64\r\n";
				$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
				$body .= $encoded_content; 
				
			}
		}
		

	}else{ //send plain email otherwise
       $headers = "From:".$from_email."\r\n".
		"Reply-To: ".$sender_email. "\n" .
		
        "X-Mailer: PHP/" . phpversion();
        $body = $sender_message;
	}
		
	 $sentMail = @mail($recipient_email, $subject, $body, $headers);
	if($sentMail) //output success or failure messages
	{   
		echo "<h1>Your Email to: </h1>$recipient_email  <h1> Sent Successfully! </h1>  $svg_smaile_face_Content";
			
		die('Thank you for your email');
		

	}else{

		echo  "<h1>Your Email to: </h1> $recipient_email  <h1>failed.</h1> $svg_sad_face_Content";

		die('Could not send mail! Please check your PHP mail configuration.');  
		

	}
}
?>