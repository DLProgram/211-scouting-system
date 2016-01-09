<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-header">
    <a href="index.php" class="navbar-brand">211 Scouting Systam</a>
  </div>
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li <?php echo $name=="Home" ? "class='active'": ""; ?>>
        <a href="index.php">Home</a>
      </li>
      <li <?php echo $name=="Search" ? "class='active'": ""; ?>>
        <a href="search.php">Search</a>
      </li>
      <?php
      if($color == "admin"){
        echo "<li>
          <a href='user.php'>Users</a>
        </li>";
      }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <span class=<?php
          if ($color == "red"){
            echo "'label label-danger'";
          }elseif ($color == "blue") {
            echo "'label label-primary'";
          }else{
            echo "'label label-warning'";
          }
        ?>
        >Loged in as: <?php echo $login_session;?></span>
      </li>
      <li>
        <a href="logout.php">Log Out</a>
      </li>
    </ul>

  </div>
</nav>