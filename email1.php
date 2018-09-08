<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>"; 
//exit();

 // to, from, subject, message body, attachment filename, etc.
$to = "jaisharma.imcl@gmail.com";
$from = "info@incubateind.com";
$subject = "subject 1";
$message = "Other sites home page screenshots";
$fpath = "/var/www/html/futureskills/";
//$filename = "bhaskar.png";
//$fname = "bhaskar.png";


$fname = array('amazonalexa.pdf', 'indigo.pdf', 'aeris.pdf');


$headers = "From: $from" . "\r\n" .
// boundary 
"CC: jaisharma.imcl@gmail.com"; 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

// headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

// multipart boundary 
$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
$message .= "--{$mime_boundary}\n";

// preparing attachments            
/*
$file = fopen($filename,"rb");
$data = fread($file,filesize($filename));
fclose($file);
$data = chunk_split(base64_encode($data));
$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$fname."\"\n" . 
"Content-Disposition: attachment;\n" . " filename=\"$fname\"\n" . 
"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
$message .= "--{$mime_boundary}--\n";
*/

 for($x=0;$x<count($fname);$x++){
	 	$filename = $fpath.$fname[$x];
        $file = fopen($filename,"rb");
        $data = fread($file,filesize($filename));
        fclose($file);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$fname[$x]\"\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"$fname[$x]\"\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        $message .= "--{$mime_boundary}\n";
    }


// send
//print $message;

//@mail($to, $subject, $message, $headers, "-f " . $from);  

$ok = @mail($to, $subject, $message, $headers, "-f " . $from);   

if($ok)
{
	echo 'ok-->'.$ok;
}

?>