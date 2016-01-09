<?php
  if(isset($_POST["submit"])){
    if ($_POST["submit"] == "Submit"){
      if (empty($_POST["match_number"]) || empty($_POST["team_number"])){
        echo "<div class='alert alert-danger' role='alert'> 
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
          <strong>Submitted!</strong>
          </div>";
        }

        $match_num = $match_number + 1;

        if($color = "red"){
          $team1 = getTeams($match_num, 'red1');
          $team2 = getTeams($match_num, 'red2');
        }
        elseif ($color = "blue"){
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
        <strong>Error:</strong> Please enter a team number!!!
        </div>";
      }else{
        if($color = "red"){
          $team1 = getTeams($match_num, 'red1');
          $team2 = getTeams($match_num, 'red2');
        }
        elseif ($color = "blue"){
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