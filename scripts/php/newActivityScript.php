<?php

session_start();

if(!empty($_POST) && isset($_POST)){

 $user_id = $_SESSION['user_id'];
  $name = $_POST["name"];
  $desc = $_POST["description"];
  $cat = $_POST["category"];
  $startDate = $_POST["startTime"];
  $endDate = $_POST["endTime"];
  
  include '../../resources/database.php';

  $conn = connect();
  $activities = mysqli_query($conn, "SELECT * FROM activity WHERE user_id=$user_id AND state='active'");

  if(!empty($activities)){
    foreach($activities as $activity){
      if($activity['end'] == $endDate){
        header("location: ../../templates/account.php");
        exit;
      }
    }
  }
  
  $query = "INSERT INTO activity (user_id, name, description, category, start, end, state) VALUES ('".$user_id."', '".$name."', '".$desc."', '".$cat."', '".$startDate."', '".$endDate."', 'active')";
    mysqli_query($conn, $query);
 
    disconnect($conn);
    
    header("location: ../../templates/account.php");
  }
  else{
    header("location: ../../templates/account.php");
    exit; 
  }

?>