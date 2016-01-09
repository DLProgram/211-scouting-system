<?php 
include("connect.php");
include('lock.php'); 
$name="Leaderboard"
?>


<?php 
  $all_teams = [];

  $q = $q = "SELECT * FROM `data`;";
  $result = mysqli_query($conn, $q);

  if(!$result){
    die("query failed");
  }

  while($row = mysqli_fetch_assoc($result)){
    $all_teams[] = $row["team_num"];
  }
  $teams = array_unique($all_teams);
  sort($teams);
?>
<?php
  $q = "TRUNCATE TABLE leaderboard;";
  $result = mysqli_query($conn, $q);

  if(!$result){
    die("query failed");
  }

  foreach ($teams as $team_num) {
    $q = "SELECT * FROM `data` WHERE team_num='$team_num';";
    $result = mysqli_query($conn, $q);

    $auto_val = [];
    $drive_val = [];

    if(!$result){
      die("queryg failed");
    }
    while($row = mysqli_fetch_assoc($result)){
      $auto_val[] = $row["auto"];
      $drive_val[] = $row["drive"];
    }

    $auto_average = (int) count($auto_val) == 0 ?  " " : array_sum($auto_val) / count($auto_val);
    $drive_average = (int) count($drive_val) == 0 ?  " " : array_sum($drive_val) / count($drive_val);

    $q = "INSERT INTO leaderboard (team_num, auto, drive) VALUES ('$team_num', $auto_average, $drive_average);";
    $result = mysqli_query($conn, $q);
  }
?>
<?php 
  if(isset($_GET["order"])){
    if($_GET["order"] == "auto"){
      $ql = "SELECT * FROM leaderboard ORDER BY auto DESC";
    }elseif ($_GET["order"] == "drive") {
      $ql = "SELECT * FROM leaderboard ORDER BY drive DESC";
    }elseif ($_GET["order"] == "team_num") {
      $ql = "SELECT * FROM leaderboard ORDER BY team_num";
    }else{
      $ql = "SELECT * FROM leaderboard ORDER BY drive DESC";
    }
  }else{
    $ql = "SELECT * FROM leaderboard ORDER BY drive DESC";
  }
  
  $resultl = mysqli_query($conn,$ql);

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
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include("navbar.php") ?>
    <div id="top"></div>
    <div class="container" >
      <h1>Leaderboard</h1>
      <div id="space"></div>
      
      <div class="row">
        <div class="col-md-2"><span style="font-size:200%;">Sort by:</span></div>
        <div class="col-md-4"><a href="?order=team_num" type="button" class="btn btn-lg btn-warning">Team Number</a></div>
        <div class="col-md-3"><a href="?order=auto" type="button" class="btn btn-lg btn-warning">Auto</a></div>
        <div class="col-md-3"><a href="?order=drive" type="button" class="btn btn-lg btn-warning">Drive</a></div>
      </div>
      <div id="top"></div>

      <table class='table table-striped'>
        <!--
        <tr>
          <td>
            <div class="col-md-4">
              <a href="?order=team_num" type="button" class="btn btn-lg btn-warning">Team Number</a>
            </div>
          </td>
          <td>
            <div class="col-md-3">
              <a href="?order=auto" type="button" class="btn btn-lg btn-warning">Auto</a>
            </div>
          </td>
          <td>
            <div class="col-md-3">
              <a href="?order=drive" type="button" class="btn btn-lg btn-warning">Drive</a>
            </div>
          </td>
        </tr>
      -->
        <tr><th>Team Number</th> <th>Auto</th> <th>Drive</th></tr>
        <?php 
          
          while($row = mysqli_fetch_assoc($resultl)){
            $team_number = $row["team_num"];
            echo "<tr>";
            echo "<td>";
            echo "
            <a href='graph.php?team_number=$team_number'>
            $team_number
            </a>";
            echo "</td>";

            echo "<td>";
            echo $row["auto"];
            echo "</td>";

            echo "<td>";
            echo $row["drive"];
            echo "</td>";

            echo "</tr>";
          }

        ?>
      </table>

    </div>
    <a href=""></a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>