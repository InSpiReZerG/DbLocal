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
Upcoming Movie Showings
</title>
</head>

<h3>Movie Listings</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];

	if($sessionUser != "member")
	{
		echo 'Not logged in as a member!';
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

<form action = "ShowListings.php" method = "post">

	 <!-- 
	 Skill Name:<br>	<input type = "text" name = "name"><br><br> 
	Skill Description:<br>	<input type = "text" name = "desc"><br><br>
	-->
	
<?php

	$cinemaQuery = "SELECT * FROM Cinema";
			
	$cinemaResult = mysql_query($cinemaQuery) or die(mysql_error());
	
	
	
	
?>
	
Select a Complex
<select name="complex_select_menu">
	<option value="all">all</option>
	
<?php

	while($row = mysql_fetch_array($cinemaResult))
	{
		echo "<option value= '{$row['Name']}' >{$row['Name']}</option>";
	}
	
?>

</select>
<br>
<br>

<?php

	$movieQuery = "SELECT * FROM Movie";
			
	$movieResult = mysql_query($movieQuery) or die(mysql_error());

?>

Select a Movie
<select name="movie_select_menu">
	<option value="all">all</option>
	
<?php

	while($row = mysql_fetch_array($movieResult))
	{
		echo "<option value= '{$row['Title']}' >{$row['Title']}</option>";
	}
	
?>

	
	
</select>
<br>
<br>



Select a Day
<select name="day_select_menu">
	<option value="0">Today</option>
	<option value="1">Today + 1</option>
	<option value="2">Today + 2</option>
	<option value="3">Today + 3</option>
	<option value="4">Today + 4</option>
	<option value="5">Today + 5</option>
	<option value="6">Today + 6</option>
	<option value="all">All</option>
</select>
<br>
<br>

<input type = "submit" value = "Show Listings">

</form>
</body>
</html>
