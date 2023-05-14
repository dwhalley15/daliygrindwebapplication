<?php
  session_start();
  include '../../resources/database.php';
  $user_id = $_SESSION["user_id"];
  $activiy_id = $_GET["activity_id"];
  $conn = connect();
  $query = "DELETE FROM activity WHERE activity_id = $activiy_id AND user_id=$user_id";
  mysqli_query($conn, $query);
  disconnect($conn);
  header("location: ../../templates/account.php");
  exit;
?>