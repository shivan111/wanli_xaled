<?php





// Recipient 
$to = '1.handwerk.de@gmail.com'; 
 
// Sender 
//$from = 'sender_Email'; 
$from = 'info@1-handwerk.de'; 
$subject = "Attachment email from 1-handwer.de website!"; //
$fromName = 'sender_name';

//1
$user_email='sender_email'; 
 
// Email subject 
//$subject = 'subject';
// 1
$msg='message' ; 
 
//art_ot_work_select
$_type_of_work="type_of_work_select";

// Attachment file 
$file = "attachment"; 
 
// Email body content 
$htmlContent = ' 
    <h3>PHP Email with Attachment by 1-handwerk.de</h3> 
    <p>This email is sent from the PHP script with attachment.</p> '; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">";

//$headers = "type_of_work: $_type_of_work ";
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 


 $svg_smaile_face_Content = '<svg width="5em" height="5em" viewbox="0 0 16 16" class="bi bi-emoji-smile"  fill="#adac70" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683z"/>
<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
</svg>';


$svg_sad_face_Content = '<svg width="1em" height="1em" viewbox="0 0 16 16" class="bi bi-emoji-frown" fill="#adac70" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path fill-rule="evenodd" d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683z"/>
<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
</svg>';


// Send email <
$mail = @mail($to, $subject, $message, $headers, $returnpath);  
 
// Email sending status 
echo $mail?" <h1>Your Email to: </h1>$to <h1> Sent Successfully! </h1>  $svg_smaile_face_Content"  : "<h1>Your Email to: </h1> $to <h1>failed.</h1> $svg_sad_face_Content"; 

//go to home page
$_go_home='<a href="../index.html">go home</a>';
echo $_go_home


//####################################

/*



*/
}

?>





