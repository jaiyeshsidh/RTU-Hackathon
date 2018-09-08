<?php
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
	
	$subject = "Futureskills Hackathon"; $headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: info@incubateind.com" . "\r\n" . "CC: info@incubateind.com";
	
	$emailMsg = 'Hi,<br/><br/>Thank you for your Registration.<br/><br/>We welcome you to a <a href="http://www.incubateind.com/futureskills/">NASSCOM initiative Futureskills Hackathon</a> powered by <a href="http://www.edcast.com/">Edcast</a> with Hack partner as <a href="http://www.incubateind.com">IncubateIND</a> and Sponsorship Partner as <a href="http://www.codeforindia.org/">Code for India</a>.<br/><br/>We have received your Registration. Shortly, our Github Organisation will send you a link for creating your Github Repository under IncubateIND-Dev Community.<br/>We have also provided Process Explanation attachment to let you know the furthur process of creating you Github Repository.<br/><br/>This Online Hackathon starts from 11th August 2018 and Hack Ends on 29th August 2018.<br/><br/>Till then ideate your problem statements and develop, you can make something better out of them too!<br/>Please Visit: <a href="http://www.incubateind.com/futureskills/">www.incubateind.com/futureskills</a><br/><br/>For any query write us at info@incubateind.com<br/><br/>Regards,<br/>Punit Jain<br/>punitjain@incubateind.com<br/>+91-7877079666<br/>';
	
	//-------------------------------
	
	if ($conn->query($sql) === TRUE) {
		mail($email,$subject,$emailMsg,$headers);
		header('Location:thanks.html');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>