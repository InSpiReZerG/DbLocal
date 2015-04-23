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
Add a Theater
</title>
</head>

<h3>
Add a Theater
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

	if(isset($_POST['cinema']) && isset($_POST['theaterNumber']) && isset($_POST['theaterCapacity']))
	{
		
		$cinemaID = $_POST['cinema'];
		$theaterNumber = $_POST['theaterNumber'];
		$theaterCapacity = $_POST['theaterCapacity'];
		
		$theaterExistsResult = mysql_query("select * from Theater where CinemaID=$cinemaID and TheaterNumber=$theaterNumber;") or die(mysql_error());
		
		if($t = mysql_fetch_array($theaterExistsResult))
		{
			echo "Theater number $theaterNumber already exists at this cinema.";
		}
		
		else
		{		
			$addTheaterQuery = "insert into Theater (CinemaID, TheaterNumber, Capacity)
											values ('$cinemaID', '$theaterNumber', '$theaterCapacity')";
											
											
			$addTheaterResult = mysql_query($addTheaterQuery) or die(mysql_error());
			
			echo "Theater successfully added!";
		}
		
	}
	
	else
	{
			echo "<form action='AddTheater.php' method='post'>";
			echo "Cinema: ";
			echo "<select name='cinema'>";
			
			$selectCinemaResult = mysql_query("select * from Cinema;") or die(mysql_error());	
			while($cinemaRow = mysql_fetch_array($selectCinemaResult))
			{
					$cinemaID = $cinemaRow['ID'];
					$cinemaName = $cinemaRow['Name'];
					
					echo "<option value='$cinemaID'>($cinemaID) $cinemaName</option>";
			}
			
			echo "</select>";
			echo "<br>";
			
			echo "Theater Number: <input type='text' name='theaterNumber' placeholder='1' required><br>";
			echo "Seating Capacity: <input type='text' name='theaterCapacity' placeholder='50' required><br>";	
			
			echo "<br><input type='submit' value='Add Theater'>";
			echo "</form>";
	}
	
	echo '<br><a href ="index.php">Go to Index</a>';
?>

</body>
</html>