<br>
<div class= "container">
  <a href="newActivity.php" id="activityIcon"></a>
</div>

<?php
  $date = date('Y-m-d');
  $user_id = $_SESSION['user_id'];
  $query = mysqli_query($conn, 
            "SELECT * FROM activity JOIN app_user ON activity.user_id = app_user.user_id WHERE app_user.user_id = $user_id AND activity.state = 'active'");
  if(mysqli_num_rows($query) == 0){
    echo "<p>You currently have no activities.</p>";
  }
else{
    echo "<ol class='activityList'>";
    while($row = mysqli_fetch_assoc($query)){
      $msg = "";
      if($row['end'] == $date){
        $msg = "Expiring soon!";
      }
      
      if($row['end'] < $date){
        $expired = "UPDATE activity SET state='abandoned' WHERE activity_id='".$row['activity_id']."'";
        mysqli_query($conn, $expired);
      }
      else{
        echo 
          "<li class='activity'>
          <h5>".$row['name']."</h5><span class='errorMsg'>$msg</span>
          <a href='updateActivity.php?activity_id=".$row['activity_id']."' id='updateIconSmall'></a>
          <a href='../scripts/php/removeActivityScript.php?activity_id=".$row['activity_id']."' id='deleteIconSmall'></a>
          </li>";
      }
    }
    echo "</ol>";
  }

?>