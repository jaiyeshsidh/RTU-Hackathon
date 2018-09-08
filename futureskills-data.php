<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

include('../lib/config.php'); 

$dqry = " SELECT distinct(email) FROM `futureskills` WHERE 1 AND ( email!='jaisharma2196@gmail.com' OR email!='siddhantsgoral@gmail.com' ) ";
$dresult = mysqli_query($conn, $dqry);
$dCount = mysqli_num_rows($dresult);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Futureskills Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px">
        
  <h2>Futureskills Data</h2>
  <table class="table">
    <thead>
      <tr>
        <th>S. no.</th>
		<th>Firstname</th>
        <th>Email</th>
        <th>Phone</th>
		<th>Occupation</th>
		<th>Problem Statement</th>
        <th>Team Member 1</th>
        <th>Team Member 2</th>
        <th>Team Member 3</th>
        <th>Team Member 4</th>
      </tr>
    </thead>
    <tbody>
	<?php
	if($dCount>0)
	{
		$inc = 0;
		while($dData = mysqli_fetch_assoc($dresult))
		{
			$inc++;
			$qry = " SELECT * FROM `futureskills` WHERE email = '".$dData['email']."' ";
			$result = mysqli_query($conn, $qry);
			$Data = mysqli_fetch_assoc($result);
			$problem = 'Amazon Alexa';
			if($Data['problem'] == 1){ $problem = 'Amazon Alexa'; }else if($Data['problem'] == 2){ $problem = 'indiGO'; }else if($Data['problem'] == 3){ $problem = 'Aeris Communications'; }
			?>
	  <tr>
        <td><?php echo $inc;?></td>
		<td><?php echo $Data['name'];?></td>
        <td><?php echo $Data['email'];?></td>
        <td><?php echo $Data['phone'];?></td>
		<td><?php echo $Data['occupation'];?></td>
		<td><?php echo $problem;?></td>
        <td><?php echo $Data['tmFirst'];?></td>
        <td><?php echo $Data['tmSecond'];?></td>
        <td><?php echo $Data['tmThird'];?></td>
        <td><?php echo $Data['tmFourth'];?></td>
      </tr>     
	<?php } }?>	  
    </tbody>
  </table>

            
        </div>
</body>
</html>