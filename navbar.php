<!--navbar-fixed-top-->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-header">
    <a href="#" class="navbar-brand">211 Scouting Systam</a>
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

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Graphs<span class="caret"><span></a>
        <ul class="dropdown-menu">
          <li <?php echo $name=="Team Data" ? "class='active'": ""; ?>>
            <a href="graph.php">Team Data</a>
          </li>
          <li <?php echo $name=="All Teams" ? "class='active'": ""; ?>>
            <a href="graph2.php">All Teams</a>
          </li>
        </ul>
      </li>

      <li <?php echo $name=="Leaderboard" ? "class='active'": ""; ?>>
        <a href="leaderboard.php">Leaderboard</a>
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