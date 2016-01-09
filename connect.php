<?php
//open mysql connection
$conn = mysqli_connect("localhost", "dr211", "pass","211");
  if (mysqli_connect_errno()){
    die("Database Connection Failed!!!" . mysqli_connect_error() . " ( " . mysqli_connect_errno() ." )");
  }

$match_database = "matches";
?>