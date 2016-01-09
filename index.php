<?php 
include("connect.php");
include('lock.php'); 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="1.ico" type="image/x-icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      input{
        margin-bottom: 10px;
      }
      li{
        margin-left: 5px;
        margin-right: 10px;
      }
      h1{
        margin-top: 100px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand">211 Scouting Systam</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="index.php">Home</a>
          </li>
          <li>
            <a href="search.php">Search</a>
          </li>
          
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a>Loged in as: <?php echo $login_session;?></a>
          </li>
          <li>
            <a href="logout.php">Log Out</a>
          </li>
        </ul>

      </div>
    </nav>

    <div class="container">
      <?php

        if(isset($_POST["submit"])){
          if (empty($_POST["match_number"]) || empty($_POST["team_number"])){
            echo "<div class='alert alert-danger' role='alert'> 
            <strong>Error:</strong> Please enter a team number and a match number!!!
            </div>";
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

            $q = "INSERT INTO data (match_num, team_num, lift, lifted, auto, drive) 
                VALUES ({$match_number},'{$team_number}',{$lift},{$lifted},{$auto},{$drive})";
            $result = mysqli_query($conn, $q);

            if (!$result){
              die("Query Failed!!");
            }else{
              echo "<div class='alert alert-success' role='alert'>
              <strong>Submitted!</strong>
              </div>";
            }
          }
        }
      ?>
      <h1>Home</h1>
      <div>
        <form method="post" >
          <div class="row">
            <div class="col-md-2">Match Number:</div>
            <div class="col-md-3"><input type="text" name="team_number" placeholder="Match Number" value=""></div>
          </div>

          <div class="row">
            <div class="col-md-2">Team Number:</div>
            <div class="col-md-3"><input type="text" name="match_number" placeholder="Team Number" value=""></div>
          </div>

          <hr>
          <div class="row">
            <div class="col-md-2">Lift:</div>
            <div class="col-md-3"><input type="checkbox" name="lift" ></div>
          </div>

          <div class="row">
            <div class="col-md-2">Lifted:</div>
            <div class="col-md-3"><input type="checkbox" name="lifted" ></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-2">Auto:</div>
            <div class="col-md-3"><input type="range" name = "auto" value="0"></div>
          </div>

          <div class="row">
            <div class="col-md-2">Driver:</div>
            <div class="col-md-3"><input type="range" name = "drive" value="0"></div>
          </div>
          <hr>
          <div>
            <input type="submit" name="submit" Value="Submit" class="btn btn-lg btn-success">
          </div>
          
        </form>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>