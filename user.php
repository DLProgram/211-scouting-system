<?php 
include("connect.php");
include('lock.php'); 
$name="User"
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
    <div class="container">
      <div id="top"></div>
      <?php 
        $error=[];
        if(isset($_POST["submit"])){
          if ($color == "admin"){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];
            
            if (empty($username) || empty($password) || empty($password2)){
              $error[] = "Please enter a username, a password and re enter password!!";
            }
            if(!isset($_POST["color"])){
              $error[] = "please choose a color!";
            }else{
              $ccolor = $_POST["color"];
            }

            if ($password != $password2){
              $error[] = "Passwords does not match";
            }
            if (empty($error)){
              $q = "INSERT INTO users (username,password,color)
                    VALUES ('$username', '$password', '$ccolor') ";
              $result = mysqli_query($conn, $q);

              if (!$result){
                die("Query Failed!!");
              }else{
                echo "<div class='alert alert-success' role='alert'>
                <strong>User Created!</strong>
                </div>";
              }
            }
          }else{
            $error[] = "Adding user can only be done by an admin";
          }
        }
      ?>
        <?php 
          foreach ($error as $val) {
            echo "<div class='alert alert-danger' role='alert' > Error: $val</div>";
          }
        ?>
      <h1>Add Users</h1>
      <form method="post">
        <div class="row">
          <div class="col-md-2">Username</div>
          <div class="col-md-4"><input type="text" name="username" Value=""></div>
        </div>
        <div class="row">
          <div class="col-md-2">Password</div>
          <div class="col-md-4"><input type="password" name="password" Value=""></div>
        </div>
        <div class="row">
          <div class="col-md-2">Re-type Password</div>
          <div class="col-md-4"><input type="password" name="password2" Value=""></div>
        </div>
        <div class="row">
          <div class="col-md-2">Color</div>
          <div class="col-md-4">
            <input type="radio" name="color" value="red">Red
            <input type="radio" name="color" value="blue">Blue
          </div>
        </div>
        <div class="row">
          <div class="col-md-2"><input type="submit" name="submit" Value="Submit"></div>
        </div>
      </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>