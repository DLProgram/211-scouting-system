<?php 
  include("connect.php");
  include('lock.php'); 
  include("match.php");
  $name="Confirmation"
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
      <div class="container" >
        <div id="top"></div>
        <?php 
          if(isset($_GET["submit"])){
            if($color == "admin"){
              if($_GET["submit"] == "Ok"){

                if(empty($_GET["score"])){
                  echo "<div class='alert alert-danger' role='alert'>
                      <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
                      <strong>Please enter a score!!!!</strong>
                      </div>";
                }else{
                  $id=$_GET["id"];
                  $q = "SELECT * FROM data_tmp WHERE id=$id;";
                  $result = mysqli_query($conn, $q);
                  $count = mysqli_num_rows($result);
                  if($count == 1){
                    $row = mysqli_fetch_assoc($result);

                    $match_number=$row["match_num"];
                    $team_number=$row["team_num"];

                    $score=$_GET["score"];

                    $lift=$row["lift"];
                    $lifted=$row["lifted"];
                    $auto= $score * $row["auto"] / 100;
                    $drive= $score * $row["drive"]  / 100;
                    $user=$row["user"];

                    $q = "INSERT INTO data (match_num, team_num, lift, lifted, auto, drive, user) 
                        VALUES ({$match_number},'{$team_number}',{$lift},{$lifted},{$auto},{$drive},'{$user}')";

                    $result = mysqli_query($conn, $q);


                    $q = "DELETE FROM `data_tmp` WHERE `id` = $id";
                    $result = mysqli_query($conn, $q);

                    if (!$result){
                      die("Query Failed!!");
                    }else{
                      echo "<div class='alert alert-success' role='alert'>
                      <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
                      <strong>Submitted!</strong>
                      </div>";
                    }
                  }
                }
              }elseif ($_GET["submit"] == "Cancel") {
                $id=$_GET["id"];

                $q = "DELETE FROM `data_tmp` WHERE `id` = $id";
                $result = mysqli_query($conn, $q);

                if (!$result){
                  die("Query Failed!!");
                }else{
                  echo "<div class='alert alert-success' role='alert'>
                  <a href='#'' class='close' data-dismiss='alert' aria-lable='close'>&times;</a>
                  <strong>Deleted!</strong>
                  </div>";
                }
              }
            }
          }
        ?>
        <?php 
        $q = "SELECT * FROM data_tmp;";
        $dbresult = mysqli_query($conn, $q);
        ?>

        <h1>Confirmation</h1>
        <div class='row'>
          <div class='col-md-1'>ID</div>
          <div class='col-md-1'>Match Number</div>
          <div class='col-md-1'>Team Number</div>
          <div class='col-md-1'>Lift</div>
          <div class='col-md-1'>Lifted</div>
          <div class='col-md-1'>Auto</div>
          <div class='col-md-1'>Drive</div>
          <div class='col-md-1'>User</div>
          <div class='col-md-2'>Score</div>
          <div class='col-md-1'>Ok</div>
          <div class='col-md-1'>Cancel</div>

        </div>

          <?php 
            while($row = mysqli_fetch_assoc($dbresult)){
              echo "<div class='row'><form method='get'>";
              
              echo "<div class='col-md-1'><span>" . $row['id'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['match_num'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['team_num'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['lift'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['lifted'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['auto'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['drive'] . "</span></div>";
              echo "<div class='col-md-1'><span>" . $row['user'] . "</span></div>";
              echo "<div class='col-md-2'><input name='score'></div>";
              echo "<input type='hidden' name='id' value='" . $row['id']."'>";
              
              echo "<div class='col-md-1'> 
              <input type='submit' name='submit' value='Ok' class='btn btn-md btn-primary'>
              </div>";

              echo "<div class='col-md-1'> 
              <input type='submit' name='submit' value='Cancel' class='btn btn-md btn-danger'>
              </div>";

              echo "</form> </div>";
            }
          ?>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php include("disconnect.php") ?>