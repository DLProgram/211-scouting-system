<?php include("connect.php") ?>

<?php
if (isset($_GET["submit"])){
	$match_number = $_GET["match_number"];
	$team_number = $_GET["team_number"];

	if (!empty($match_number)&&!empty($team_number)){
		$q = "SELECT * FROM data WHERE match_num = {$match_number} AND team_num = '{$team_number}';";
	}elseif (!empty($match_number)){
		$q = "SELECT * FROM data WHERE match_num = {$match_number};";
	}elseif(!empty($team_number)){
		$q = "SELECT * FROM data WHERE team_num = '{$team_number}';";
	}else{
		$q = "SELECT * FROM data;";
	}

	$result = mysqli_query($conn, $q);
}
?>
<html>
	<head>
		<meta charset="utf-8">
	   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	   	<meta name="viewport" content="width=device-width, initial-scale=1">
		   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		   <title>Search</title>

		   <!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<link rel="icon" type="image/x-icon" href="/1.ico">
	</head>

	<body>
		<div class="container">
			<form method="get">	
				Match Number: <input type="text" name="match_number" value=""><br />
				Team Number: <input type="text" name="team_number" value=""><br />
				<input type="submit" name="submit" Value="Search" class="btn btn-lg btn-success"><br />
			</form>
			<hr />
			<?php
			if(isset($result)){
				if($result){
					echo "<table>
					<tr> <th>ID</th> <th>Match Number</th> <th>Team Number</th> <th>Lift</th> <th>Lifted</th> <th>Auto</th> <th>Drive</th> </tr>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<tr>" .
						 "<td>" . $row["id"]. "</td>" . 
						 "<td>" . $row["match_num"]. "</td>" . 
						 "<td>" . $row["team_num"]. "</td>" . 
						 "<td>" . $row["lift"]. "</td>" . 
						 "<td>" . $row["lifted"]. "</td>" . 
						 "<td>" . $row["auto"]. "</td>" . 
						 "<td>" . $row["drive"]. "</td>" . 
						 "</tr>";
					}
					echo" </table>";
				}
			}
			?>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		   <!-- Include all compiled plugins (below), or include individual files as needed -->
		   <script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php
include("disconnect.php");
?>
