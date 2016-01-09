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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $name?></title>

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
      .row{
        margin-top: 10px;
      }
      #top{
        margin-top: 60px;
      }
    </style>
  </head>
  <body>
    <?php include("navbar.php") ?>
    <div id="top"></div>
    <div class="container">
      <?php include("submit.php"); ?>
      <h1>Home</h1>
      <div>
        <form method="post" >
          <div class="row">
            <div class="col-md-2">Match Number:</div>
            <div class="col-md-3"><input type="text" name="match_number" placeholder="Match Number" value= <?php echo isset($match_num) ?  $match_num :  "";?>></div>
            <div class="col-md-2"><input type="submit" name="submit" Value="Get Teams" class="btn btn-md btn-info"></div>
          </div>
          <div class="row">
            <div class="col-md-2">Field: </div>
            <div class="col-md-2"><span class="label label-default"><?php echo isset($field) ?  $field :  ""; ?></span></div>
          </div>
          <div class="row">
            <div class="col-md-2">Team Number:</div>
            <div class="col-md-3"><input type="text" name="team_number" placeholder="Team Number" value=<?php echo isset($team1) ?  $team1 :  ""; ?>>
            </div>

            <div class="col-md-2">Team Number:</div>
            <div class="col-md-3"><input type="text" name="team_number2" placeholder="Team Number" value=<?php echo isset($team2) ?  $team2 :  ""; ?>>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-md-2">Lift:</div>
            <div class="col-md-3"><input type="checkbox" name="lift" ></div>

            <div class="col-md-2">Lift:</div>
            <div class="col-md-3"><input type="checkbox" name="lift2" ></div>
          </div>

          <div class="row">
            <div class="col-md-2">Lifted:</div>
            <div class="col-md-3"><input type="checkbox" name="lifted" ></div>

            <div class="col-md-2">Lifted:</div>
            <div class="col-md-3"><input type="checkbox" name="lifted2" ></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-2">Auto:</div>
            <div class="col-md-1"><?php echo isset($team1) ?  $team1 :  "Team1";?></div>
            <div class="col-md-6"><input type="range" name = "auto" value="0"></div>
            <div class="col-md-1"><?php echo isset($team2) ?  $team2 :  "Team2";?></div>
          </div>

          <div class="row">
            <div class="col-md-2">Driver:</div>
            <div class="col-md-1"><?php echo isset($team1) ?  $team1 :  "Team1";?></div>
            <div class="col-md-6"><input type="range" name = "drive" value="0"></div>
            <div class="col-md-1"><?php echo isset($team2) ?  $team2 :  "Team2";?></div>
          </div>
          <hr>
          <div>
            <input type="submit" name="submit" Value="Submit" class="btn btn-lg btn-success">
          </div>
          
        </form>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>