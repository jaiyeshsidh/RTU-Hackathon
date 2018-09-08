<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost","root","root@123","incubate");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//print_r($_POST);
$name = "";
$phone = "";
$location = "";
$email = "";
$occupation = "";
$nameOfTeam = "";
$numberOfTeam = "";
$problem = "";
$tmFirst = "";
$tmSecond = "";
$tmThird = "";
$tmFourth = "";
$githubProfile = "";
$projectTitle = "";
$projectDescription = "";
$technologyUsed = "";

if(isset($_POST['edit']) && $_POST['edit']=='y')
{
	
	if(isset($_POST['name']) && $_POST['name']!='') $name=$_POST['name'];
	if(isset($_POST['phone']) && $_POST['phone']!='') $phone=$_POST['phone'];
	if(isset($_POST['location']) && $_POST['location']!='') $location=$_POST['location'];
	if(isset($_POST['email']) && $_POST['email']!='') $email=$_POST['email'];
	if(isset($_POST['occupation']) && $_POST['occupation']!='') $occupation=$_POST['occupation'];
	if(isset($_POST['nameOfTeam']) && $_POST['nameOfTeam']!='') $nameOfTeam=$_POST['nameOfTeam'];
	if(isset($_POST['numberOfTeam']) && $_POST['numberOfTeam']!='') $numberOfTeam=$_POST['numberOfTeam'];
	if(isset($_POST['problem']) && $_POST['problem']!='') $problem=$_POST['problem'];
	if(isset($_POST['tmFirst']) && $_POST['tmFirst']!='') $tmFirst=$_POST['tmFirst'];
	if(isset($_POST['tmSecond']) && $_POST['tmSecond']!='') $tmSecond=$_POST['tmSecond'];
	if(isset($_POST['tmThird']) && $_POST['tmThird']!='') $tmThird=$_POST['tmThird'];
	if(isset($_POST['tmFourth']) && $_POST['tmFourth']!='') $tmFourth=$_POST['tmFourth'];
	if(isset($_POST['githubProfile']) && $_POST['githubProfile']!='') $githubProfile=$_POST['githubProfile'];
	if(isset($_POST['projectTitle']) && $_POST['projectTitle']!='') $projectTitle=$_POST['projectTitle'];
	if(isset($_POST['projectDescription']) && $_POST['projectDescription']!='') $projectDescription=$_POST['projectDescription'];
	if(isset($_POST['technologyUsed']) && $_POST['technologyUsed']!='') $technologyUsed=$_POST['technologyUsed'];

	$sql = 'INSERT INTO futureskills (name, phone, location, email, occupation, nameOfTeam, numberOfTeam, problem, tmFirst, tmSecond, tmThird, tmFourth, githubProfile, projectTitle, projectDescription, technologyUsed, submitted) 
	VALUES ("'.$name.'", "'.$phone.'", "'.$location.'", "'.$email.'", "'.$occupation.'", "'.$nameOfTeam.'", "'.$numberOfTeam.'", "'.$problem.'", "'.$tmFirst.'", "'.$tmSecond.'", "'.$tmThird.'", "'.$tmFourth.'", "'.$githubProfile.'", "'.$projectTitle.'", "'.$projectDescription.'", "'.$technologyUsed.'", now())';
	//-------------Email Format------------------
	
	$subject = "Futureskills Hackathon"; $headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: info@incubateind.com" . "\r\n" . "CC: info@incubateind.com";
	
		if($problem == 1)
		{
			$files = 'amazonalexa.pdf';
		}
		else if($problem==2)
		{
			$files = 'indigo.pdf';
		}
		else if($problem==4)
		{
			$files = 'Explainer.pdf';
		}
		else if($problem==3)
		{
			$files = 'aeris.pdf';
		}
	
	$message = 'Hi,<br/><br/>Thank you for your Registration.<br/><br/>We welcome you to a <a href="http://www.incubateind.com/futureskills/">NASSCOM initiative Futureskills Hackathon</a> powered by <a href="http://www.edcast.com/">Edcast</a> with Hack partner as <a href="http://www.incubateind.com">IncubateIND</a> and Sponsorship Partner as <a href="http://www.codeforindia.org/">Code for India</a>.<br/><br/>We have received your Registration. Shortly, our Github Organisation will send you a link for creating your Github Repository under IncubateIND-Dev Community.<br/>We have also provided Process Explanation attachment to let you know the furthur process of creating you Github Repository.<br/><br/>This Online Hackathon starts from 11th August 2018 and Hack Ends on 29th August 2018.<br/><br/>Till then ideate your problem statements and develop, you can make something better out of them too!<br/>Please Visit: <a href="http://www.incubateind.com/futureskills/">www.incubateind.com/futureskills</a><br/><br/>For any query write us at info@incubateind.com<br/><br/>Regards,<br/>Punit Jain<br/>punitjain@incubateind.com<br/>+91-7877079666<br/>';
	
	//-------------------------------
	
	if ($conn->query($sql) === TRUE) {
		//mail($email,$subject,$message,$headers);
		//mail('jaisharma.imcl@gmail.com',$subject,$message,$headers);
		
		mail_attachment($files, '/', "jaisharma.imcl@gmail.com", 'info@incubateind.com', 'IncubateIND', 'info@incubateind', 'Futureskills Hackathon', $message);
		
		header('Location:thanks.html');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
 $file = $filename;
 $file_size = filesize($file);
 $handle = fopen($file, "r");
 $content = fread($handle, $file_size);
 fclose($handle);
 $content = chunk_split(base64_encode($content));
 $uid = md5(uniqid(time()));
 $header = "From: ".$from_name." <".$from_mail.">\r\n";
 $header .= "Reply-To: ".$replyto."\r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";
 $header .= "This is a multi-part message in MIME format.";
 $header .= "--".$uid."\r\n";
 $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
 $header .= "Content-Transfer-Encoding: 7bit\r\n";
 $header .= $message."\r\n";
 $header .= "--".$uid."\r\n";
 $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
 $header .= "Content-Transfer-Encoding: base64\r\n";
 $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n";
 $header .= $content."\r\n";
 $header .= "--".$uid."--";
 
 echo $mailto;
 
 if (mail($mailto, $subject, "", $header)) {
 echo "mail send ... OK"; // or use booleans here
 } else {
 echo "mail send ... ERROR!";
 }
 die;
}

?>