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
          if(isset($_GET["action"])){
            if($color == "admin"){
              if($_GET["action"] == "ok"){
                $id=$_GET["id"];
                $q = "SELECT * FROM data_tmp WHERE id=$id;";
                $result = mysqli_query($conn, $q);
                $count = mysqli_num_rows($result);
                if($count == 1){
                  $row = mysqli_fetch_assoc($result);

                  $match_number=$row["match_num"];
                  $team_number=$row["team_num"];
                  $lift=$row["lift"];
                  $lifted=$row["lifted"];
                  $auto=$row["auto"];
                  $drive=$row["drive"];
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
              }elseif ($_GET["action"] == "cancel") {
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
        <table class='table table-striped'>
          <tr>
            <th>ID</th> <th>Match Number</th> <th>Team Number</th> <th>Lift</th> <th>Lifted</th> <th>Auto</th> <th>Drive</th> <th>User</th> <th>Ok</th> <th>Cancel</th>  
          </tr>

          <?php 
            echo "</tr>";
            while($row = mysqli_fetch_assoc($dbresult)){
              echo "<tr>" .
               "<td>" . $row["id"]. "</td>" . 
               "<td>" . $row["match_num"]. "</td>" . 
               "<td>" . $row["team_num"]. "</td>" . 
               "<td>" . $row["lift"]. "</td>" . 
               "<td>" . $row["lifted"]. "</td>" . 
               "<td>" . $row["auto"]. "</td>" . 
               "<td>" . $row["drive"]. "</td>" . 
               "<td>" . $row["user"] . "</td>".
               "<td><a href=?action=ok&id=".$row["id"]. ">
               <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
               </a></td>".
               "<td><a href=?action=cancel&id=".$row["id"]. ">
               <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
               </a></td>";
               echo "</tr>";
            }
          ?>
        </table>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php include("disconnect.php") ?>