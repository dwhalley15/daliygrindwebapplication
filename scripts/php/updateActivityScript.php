<?php
  session_start();
  include '../../resources/database.php';
  if($_SERVER['REQUEST_METHOD'] == "POST"){
      $user_id = $_SESSION['user_id'];
      $activity_id = $_POST['activity_id'];
      $newName = $_POST["name"];
      $newDesc = $_POST["description"];
      $newCat = $_POST["category"];
      $newStart = $_POST["startTime"];
      $newEnd = $_POST["endTime"];
      $conn = connect();
      $query = "UPDATE activity SET name='".$newName."', description='".$newDesc."', category='".$newCat."', start='".$newStart."', end='".$newEnd."' WHERE activity_id='".$activity_id."'";
      mysqli_query($conn, $query);
      disconnect($conn);
      header("location: ../../templates/account.php"); 
  }
?>