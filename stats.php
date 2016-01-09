<?php 
include("connect.php");
include('lock.php'); 
$name="Stats"
?>

<?php 
  $all_teams = [];

  $q = $q = "SELECT * FROM `$match_database`;";
  $result = mysqli_query($conn, $q);

  if(!$result){
    die("query failed");
  }

  while($row = mysqli_fetch_assoc($result)){
    $all_teams[] = $row["red1"];
    $all_teams[] = $row["red2"];
    $all_teams[] = $row["blue1"];
    $all_teams[] = $row["blue2"];
  }
  $teams = array_unique($all_teams);
  sort($teams);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $name?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" href="1.ico" type="image/x-icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include("navbar.php") ?>
    <div id="top"></div>
    <div class="container">
      <h1>Stats</h1>
      <div id="space"></div>
      <table class='table table-striped'>
        <tr><th>Team Number</th> <th>Lift</th> <th>Lifted</th> <th>Auto</th> <th>Driver</th></tr>
        <?php
          foreach ($teams as $team_num) {
            $q = "SELECT * FROM `data` WHERE team_num='$team_num';";
            $result = mysqli_query($conn, $q);
            $auto_val = [];
            $drive_val = [];

            if(!$result){
              die("query failed");
            }
            $liftcount=0;
            $liftedcount=0;
            $matchcount=mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result)){
              if ($row["lift"] == 1){
                $liftcount++;
              }
              if ($row["lifted"] == 1){
                $liftedcount++;
              }
              $auto_val[] = $row["auto"];
              $drive_val[] = $row["drive"];
            }
            echo "<tr>";
            echo "<td>";
            echo "
            <a href='graph.php?team_number=$team_num'>
            $team_num
            </a>";
            echo "</td>";

            echo "<td>";
            echo $matchcount == 0 ? "" : round($liftcount/$matchcount*100) . "% (".$liftcount."/".$matchcount.")";
            echo "</td>";

            echo "<td>";
            echo $matchcount == 0 ? "" : round($liftedcount/$matchcount*100) . "% (".$liftedcount."/".$matchcount.")";
            echo "</td>";

            echo "<td>";
            echo count($auto_val) == 0 ?  " " : round(array_sum($auto_val) / count($auto_val));
            echo "</td>";

            echo "<td>";
            echo count($drive_val) == 0 ?  " " : round(array_sum($drive_val) / count($drive_val));
            echo "</td>";
            echo "</tr>";
          }
        ?>
      </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>