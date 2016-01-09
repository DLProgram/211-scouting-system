<?php
  include("connect.php");
  include('lock.php'); 
  $name="Search"
?>
<?php
  if (isset($_GET["submit"])){
    $match_number = $_GET["match_number"];
    $team_number = $_GET["team_number"];

    if (!empty($match_number)&&!empty($team_number)){
      $q = "SELECT * FROM data WHERE match_num = {$match_number} AND team_num = '{$team_number}';";
    }elseif (!empty($match_number)){
      $q = "SELECT * FROM data WHERE match_num = {$match_number};";
    }elseif(!empty($team_number)){
      $q = "SELECT * FROM data WHERE team_num = '{$team_number}';";
    }else{
      $q = "SELECT * FROM data;";
    }

    $result = mysqli_query($conn, $q);
  }
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
    <link rel="icon" href="1.ico" type="image/x-icon" sizes="256x256">

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
      <h1>Search</h1>
      <div class="row">
        <div class="col-md-2">
          <form method="get"> 
            Match Number: <input type="text" name="match_number" value=<?php echo isset($match_number) ?  $match_number :  "";?>><br />
            Team Number: <input type="text" name="team_number" value=<?php echo isset($team_number) ?  $team_number :  "";?>><br />
            <hr>
            <input type="submit" name="submit" Value="Search" class="btn btn-lg btn-success">
          </form>
        </div>
      </div>

      <?php
      if(isset($result)){
        if($result){
          echo "<hr>";
          echo "<table class='table table-striped'>
          <tr> <th>ID</th> <th>Match Number</th> <th>Team Number</th> <th>Lift</th> <th>Lifted</th> <th>Auto</th> <th>Drive</th> </tr>";
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>" .
             "<td>" . $row["id"]. "</td>" . 
             "<td>" . $row["match_num"]. "</td>" . 
             "<td>" . $row["team_num"]. "</td>" . 
             "<td>" . $row["lift"]. "</td>" . 
             "<td>" . $row["lifted"]. "</td>" . 
             "<td>" . $row["auto"]. "</td>" . 
             "<td>" . $row["drive"]. "</td>" . 
             "</tr>";
          }
          echo" </table>";
        }
      }
      ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>
