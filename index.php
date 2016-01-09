<?php include("connect.php") ?>

<head>
    <title>Main</title>
 </head>
<body>

	<?php
		//write to file
		function write($val){
			$handle = fopen("log.txt", "a");
			fwrite($handle, $val);
			fclose($handle);
		}
		if(isset($_POST["submit"])){
			if (empty($_POST["match_number"]) || empty($_POST["team_number"])){
				echo "Error: Please enter a match number and a team number!!!";
			}else{
				$match_number = $_POST["match_number"];

				$team_number = $_POST["team_number"];

				if (!isset($_POST["lift"])){
					$lift = 0;
				}else{
					$lift = 1;
				}

				if (!isset($_POST["lifted"])){
					$lifted = 0;
				}else{
					$lifted = 1;
				}

				$auto = $_POST["auto"];
				$drive = $_POST["drive"];

				// write("Match#: " . $match_number . "\r\n");
				// write("Team#: " . $team_number . "\r\n");

				// write("Lift: " . $lift . "\r\n");
				// write("Lifted: " . $lifted . "\r\n");
				// write("Auto: " . $auto . "\r\n");
				// write("Drive: " . $drive . "\r\n");

				// write("\r\n");

				$q = "INSERT INTO data (match_num, team_num, lift, lifted, auto, drive) 
					  VALUES ({$match_number},'{$team_number}',{$lift},{$lifted},{$auto},{$drive})";
				$result = mysqli_query($conn, $q);

				if (!$result){
					die("Query Failed!!");
				}else{
					echo "Submited!!\n";
				}
			}
		}
	?>

	<form method="post">

		Match #: <input type="text" name="match_number" value=""><br />
		Team #: <input type="text" name="team_number" value=""><br />

		Lift?: <input type="checkbox" name="lift" ><br />
		Lifted?: <input type="checkbox" name="lifted" ><br />

		Auto: 0%<input type="range" name = "auto" value="0">100%<br />
		Drive: 0%<input type="range" name = "drive" value="0">100%<br />

		<input type="submit" name="submit" Value="Submit">
	</form>
</body>

<?php
include("disconnect.php");
?>
