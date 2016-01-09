<?php 
  include("connect.php");
  include('lock.php'); 
  include("match.php");
  $name="Home"
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
      <?php
        if(isset($_POST["submit"])){
          if ($_POST["submit"] == "Submit"){
            if (empty($_POST["match_number"]) || empty($_POST["team_number"])){
              echo "<div class='alert alert-danger' role='alert'> 
              <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
              <strong>Error:</strong> Please enter a team number and a match number!!!
              </div>";
            }else{
              $match_number = $_POST["match_number"];

              $team_number = $_POST["team_number"];
              $team_number2 = $_POST["team_number2"];

              if (!isset($_POST["lift"])){
                $lift = 0;
              }else{
                $lift = 1;
              }

              if (!isset($_POST["lift2"])){
                $lift2 = 0;
              }else{
                $lift2 = 1;
              }

              if (!isset($_POST["lifted"])){
                $lifted = 0;
              }else{
                $lifted = 1;
              }

              if (!isset($_POST["lifted2"])){
                $lifted2 = 0;
              }else{
                $lifted2 = 1;
              }

              $auto = $_POST["auto"];
              $auto2 = 100-$auto;

              $drive = $_POST["drive"];
              $drive2 = 100-$drive;

              $q = "INSERT INTO data (match_num, team_num, lift, lifted, auto, drive) 
                  VALUES ({$match_number},'{$team_number}',{$lift},{$lifted},{$auto},{$drive})";
              $result = mysqli_query($conn, $q);

              $q2 = "INSERT INTO data (match_num, team_num, lift, lifted, auto, drive) 
                  VALUES ({$match_number},'{$team_number2}',{$lift2},{$lifted2},{$auto2},{$drive2})";

              $result2 = mysqli_query($conn, $q2);

              if (!$result || !$result2){
                die("Query Failed!!");
              }else{
                echo "<div class='alert alert-success' role='alert'>
                <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
                <strong>Submitted!</strong>
                </div>";
              }

              $match_num = $match_number + 1;

              if($color == "red"){
                $team1 = getTeams($match_num, 'red1');
                $team2 = getTeams($match_num, 'red2');
              }
              elseif ($color == "blue"){
                $team1 = getTeams($match_num, 'blue1');
                $team2 = getTeams($match_num, 'blue2');
              }else{
                $team1 = "";
                $team2 = "";
              }

              $field=getField($match_num);
            }

          }elseif ($_POST["submit"] == "Get Teams") {
            $match_num = $_POST["match_number"];
            if (empty($match_num)){
              echo "<div class='alert alert-danger' role='alert'> 
              <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
              <strong>Error:</strong> Please enter a match number!!!
              </div>";
            }else{
              if($color == "red"){
                $team1 = getTeams($match_num, 'red1');
                $team2 = getTeams($match_num, 'red2');
              }
              elseif ($color == "blue"){
                $team1 = getTeams($match_num, 'blue1');
                $team2 = getTeams($match_num, 'blue2');
              }else{
                $team1 = "";
                $team2 = "";
              }
              $field=getField($match_num);
            }
            
          }
        }
      ?>
      <h1>Home</h1>
      <div id="space"></div>
      <div>
        <form method="post" >

          <div class="form-group row">
            <lable class="col-md-2" for="match_num">Match Number:</lable>
            <div class="col-md-6">
              <input class="form-control" type="text" id="match_num"name="match_number" placeholder="Match Number" value= <?php echo isset($match_num) ?  $match_num :  "";?>>
            </div>
            <input type="submit" name="submit" Value="Get Teams" class="btn btn-md btn-info">
          </div>

          <div class="form-group row">
            <lable class="col-md-1">Field: </lable>
            <div class="col-md-2">
              <span class="label label-default"><?php echo isset($field) ?  $field :  ""; ?></span>
            </div>
          </div>

          <div class="form-group row">
            <lable class="col-md-2" for="team_num_1">Team Number:</lable>
            <div class="col-md-3">
              <input type="text" class="form-control" id="team_num_1" name="team_number" placeholder="Team Number" value=<?php echo isset($team1) ?  $team1 :  ""; ?>>
            </div>

            <lable class="col-md-2" for="team_num_2">Team Number:</lable>
            <div class="col-md-3">
              <input type="text" class="form-control" id="team_num_2" name="team_number2" placeholder="Team Number" value=<?php echo isset($team2) ?  $team2 :  ""; ?>>
            </div>
          </div>

          <hr>
          <div class="row">
            <lable class="col-md-2">Lift:</lable>
            <div class="col-md-3">
              <input type="checkbox" name="lift" >
            </div>

            <lable class="col-md-2">Lift:</lable>
            <div class="col-md-3">
              <input type="checkbox" name="lift2" >
            </div>
          </div>

          <div class="row">
            <lable class="col-md-2">Lifted:</lable>
            <div class="col-md-3">
              <input type="checkbox" name="lifted" >
            </div>

            <lable class="col-md-2">Lifted:</lable>
            <div class="col-md-3">
              <input type="checkbox" name="lifted2" >
            </div>
          </div>
          <hr>
          <div class="row">
            <lable class="col-md-2">Auto:</lable>
            <lable class="col-md-1"><?php echo !empty($team1) ?  $team1 :  "Team1";?></lable>
            <div class="col-md-6">
              <input type="range" name="auto" value="0">
            </div>
            <lable class="col-md-1"><?php echo !empty($team2) ?  $team2 :  "Team2";?></lable>
          </div>

          <div class="row">
            <lable class="col-md-2">Driver:</lable>
            <lable class="col-md-1"><?php echo !empty($team1) ?  $team1 :  "Team1";?></lable>
            <div class="col-md-6">
              <input type="range" name="drive" value="0">
            </div>
            <lable class="col-md-1"><?php echo !empty($team2) ?  $team2 :  "Team2";?></lable>
          </div>
          <hr>
          <div class="col-md-11">
            <input type="submit" name="submit" Value="Submit" class="btn btn-lg btn-success btn-block">
          </div>
          
        </form>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>