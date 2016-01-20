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

    <link rel="stylesheet" type="text/css" href="css/rangestepper.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
    <script src="js/rangestepper.js"></script>

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
        $error = [];
        //check if there is post data
        if(isset($_POST["submit"])){
          //submiting data
          if ($_POST["submit"] == "Submit"){
            //empty match number or team number
            if (empty($_POST["match_number"])){
              $error[] = "Please enter a match number!!!";
            }elseif(empty($_POST["team_number"]) || empty($_POST["team_number2"])){
              $error[] = "Please enter both team number!!!";
              $match_num=$_POST["match_number"];
            }else{
              //match number and team number not empty
              $match_number = $_POST["match_number"];

              $team_number = $_POST["team_number"];
              $team_number2 = $_POST["team_number2"];

              //form validation
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

              //seconf team data
              $auto = $_POST["auto"];
              $auto2 = 100-$auto;

              $drive = $_POST["drive"];
              $drive2 = 100-$drive;

              //team one query
              $q = "INSERT INTO data_tmp (match_num, team_num, lift, lifted, auto, drive, user)
                  VALUES ({$match_number},'{$team_number}',{$lift},{$lifted},{$auto},{$drive},'{$login_session}')";
              $result = mysqli_query($conn, $q);

              //team two query
              $q2 = "INSERT INTO data_tmp (match_num, team_num, lift, lifted, auto, drive, user)
                  VALUES ({$match_number},'{$team_number2}',{$lift2},{$lifted2},{$auto2},{$drive2}, '{$login_session}')";
              $result2 = mysqli_query($conn, $q2);

              //make sure data was submitted
              if (!$result || !$result2){
                die("Query Failed!!");
              }else{
                echo "<div class='alert alert-success' role='alert'>
                <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
                <strong>Submitted!</strong>
                </div>";
              }

              //increase match number by one
              $match_num = $match_number + 1;

              //get teams bu color
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

              //get field
              $field=getField($match_num);
            }
          }elseif ($_POST["submit"] == "Get Teams") {
            //getting match datas
            $match_num = $_POST["match_number"];
            if (empty($match_num)){
              $error[] = "Please enter a match number!!!";
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
      <?php
        foreach ($error as $val) {
          echo "<div class='alert alert-danger' role='alert'>
          <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
          <strong>Error:</strong> $val
          </div>";
        }
      ?>
      <h1>Home</h1>
      <div id="space"></div>
      <div>
        <form method="post" >
          <!--match data-->
          <div class="form-group row">
            <lable class="col-md-2" for="match_num">Match Number:</lable>
            <div class="col-md-6">
              <input class="form-control" type="text" id="match_num" name="match_number" placeholder="Match Number" value= <?php echo isset($match_num) ?  $match_num :  "";?>>
            </div>
            <?php
              //colored buttons
              if($color == "blue"){
                echo "<input type='submit' name='submit' Value='Get Teams' class='btn btn-md btn-primary'>";
              }else if($color == "red"){
                echo "<input type='submit' name='submit' Value='Get Teams' class='btn btn-md btn-danger'>";
              }else if($color == "admin"){
                echo "<input type='submit' name='submit' Value='Get Teams' class='btn btn-md btn-warning'>";
              }else{
                echo "<input type='submit' name='submit' Value='Get Teams' class='btn btn-md btn-info'>";
              }
            ?>

          </div>

          <!--Field data-->
          <div class="form-group row">
            <lable class="col-md-1">Field: </lable>
            <div class="col-md-2">
              <span class="label label-default"><?php echo isset($field) ?  $field :  ""; ?></span>
            </div>
          </div>

          <!--team numbers-->
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

          <!--lift-->
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

          <!--lifted-->
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

          <!--contributions-->
          <hr>
          <div class="row">
            <lable class="col-md-2">Auto:</lable>
            <lable class="col-md-1"><?php echo !empty($team1) ?  $team1 :  "Team1";?></lable>
            <div class="col-md-1" align="center">
              <span id="auto_team_1" class="label label-default">50</span>
            </div>

            <div class="col-md-4">
              <input type="range" name="auto" value="50" step="10" oninput="update_auto(this.value)" onchange="update_auto(this.value)">
            </div>

            <div class="col-md-1" align="center">
              <span id="auto_team_2" class="label label-default">50</span>
            </div>
            <lable class="col-md-1"><?php echo !empty($team2) ?  $team2 :  "Team2";?></lable>
          </div>

          <div class="row">
            <lable class="col-md-2">Driver:</lable>
            <lable class="col-md-1"><?php echo !empty($team1) ?  $team1 :  "Team1";?></lable>
            <div class="col-md-1" align="center">
              <span id="drive_team_1" class="label label-default">50</span>
            </div>

            <div class="col-md-4">
              <input type="range" name="drive" value="50" step="10" id="drive" oninput="update_drive(this.value)" onchange="update_drive(this.value)">
            </div>

            <div class="col-md-1" align="center">
              <span id="drive_team_2" class="label label-default">50</span>
            </div>
            <lable class="col-md-1"><?php echo !empty($team2) ?  $team2 :  "Team2";?></lable>
          </div>
          <hr>
          <!--submit button-->
          <div class="col-md-11">
            <input type="submit" name="submit" Value="Submit" class="btn btn-lg btn-success btn-block">
          </div>

        </form>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    var drive = document.getElementById("drive").value;
    var auto = document.getElementById("auto").value;

    function update_auto(val){
      document.getElementById("auto_team_1").innerHTML=val;
      document.getElementById("auto_team_2").innerHTML=100-val;
    }

    function update_drive(val){
      document.getElementById("drive_team_1").innerHTML=val;
      document.getElementById("drive_team_2").innerHTML=100-val;
    }



    </script>

  </body>
</html>

<?php include("disconnect.php") ?>
