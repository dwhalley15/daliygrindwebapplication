<?php
  session_start();
  include '../../resources/database.php';
  $activity_id = $_GET["activity_id"];
  $user_id = $_SESSION['user_id'];
  $conn = connect();
  $updateActivity = "UPDATE activity SET state='complete' WHERE activity_id='".$activity_id."'";
  $selectScore = "SELECT score FROM app_user WHERE user_id=$user_id";
  $scoreResult = mysqli_query($conn, $selectScore);
  $row = mysqli_fetch_array($scoreResult);
  $score = $row[0];
  $score = $score + 1;
  $updateScore = "UPDATE app_user SET score=$score WHERE user_id=$user_id";
  mysqli_query($conn, $updateActivity);
  mysqli_query($conn, $updateScore);
  disconnect($conn);
  header("location: ../../templates/account.php"); 
?>