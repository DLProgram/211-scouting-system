<?php
//close connection and free memery
if(isset($result) && !$result){
  mysqli_free_result($result);
}
mysqli_close($conn);
?>
