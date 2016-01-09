<!--navbar-fixed-top-->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-header">
    <!--Logo-->
    <a href="#" class="navbar-brand">211 Scouting Systam</a>
    <!--Navbar toggle button-->
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="navBar">
    <ul class="nav navbar-nav">
      <li <?php echo $name=="Home" ? "class='active'": ""; ?>>
        <a href="index.php">Home</a>
      </li>
      
      <li <?php echo $name=="Search" ? "class='active'": ""; ?>>
        <a href="search.php">Search</a>
      </li>

      <li <?php echo $name=="Stats" ? "class='active'": ""; ?>>
        <a href="stats.php">Stats</a>
      </li>

      <!--Graph drop down menu-->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Graphs<span class="caret"><span></a>
        <ul class="dropdown-menu">
          <li <?php echo $name=="Team Data" ? "class='active'": ""; ?>>
            <a href="graph.php">Team Data</a>
          </li>
          <li <?php echo $name=="Leaderboard Graph" ? "class='active'": ""; ?>>
            <a href="graph2.php">Leaderboard Graph</a>
          </li>
        </ul>
      </li>

      <li <?php echo $name=="Leaderboard" ? "class='active'": ""; ?>>
        <a href="leaderboard.php">Leaderboard</a>
      </li>


      <!--User(only visible to admins)-->
      <?php
      if($color == "admin"){
        echo "<li ";
        echo $name=="User" ? "class='active'": "";
        echo ">
          <a href='user.php'>Users</a>
        </li>";
      }
      ?>

      <?php
      if($color == "admin"){
        echo "<li ";
        echo $name=="Confirmation" ? "class='active'": "";
        echo">
          <a href='confirmation.php'>Confirmation</a>
        </li>";
      }
      ?>
    </ul>
    <!--Username and logout-->
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
        >Logged in as: <?php echo $login_session;?></span>
      </li>
      <li>
        <a href="logout.php">Log Out</a>
      </li>
    </ul>

  </div>
</nav>