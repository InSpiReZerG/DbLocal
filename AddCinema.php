<?php

	include "login.php";

	if(isset($_SESSION["userType"]) == false)
	{	
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
	
?>
<html>
<head>
<title> 
Add a Cinema
</title>
</head>

<h3>
Add a Cinema
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	
	
	if($sessionUser != "admin")
	{
		echo 'Not logged in as an admin!';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	

	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php

	if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phoneNumber']))
	{
		
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phoneNumber = $_POST['phoneNumber'];
		
		$addCinemaQuery = "insert into Cinema (Name, Address, PhoneNumber)
										values ('$name', '$address', '$phoneNumber')";
		$addCinemaResult = mysql_query($addCinemaQuery) or die(mysql_error());
		
		echo "Cinema successfully added!";
		
	}
	
	else
	{
		
?>

<form action='AddCinema.php' method = 'post'>
  Name: <input type="text" name="name" placeholder="Grand 16"><br>
  Address: <input type="text" name="address" placeholder="123 North Easy Street"><br>
  Phone Number: <input type="text" name="phoneNumber" placeholder="123-456-7890"><br>
  <input type="submit" value="Add Cinema">
</form>

<?php

	}
	
	echo '<br><a href ="index.php">Go to Index</a>';
?>

</body>
</html>