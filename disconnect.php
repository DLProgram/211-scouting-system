<?php
//close connection and free memery
if(isset($result) && gettype($result) != 'boolean'){
  mysqli_free_result($result);
}
mysqli_close($conn);
?>
