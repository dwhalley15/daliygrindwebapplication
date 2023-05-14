<?php
  session_start();
  if(!isset($_SESSION['dglogin']) || $_SESSION['dglogin'] !== true){
    header("location: home.php");
    exit;
  }
  include '../resources/database.php';
  include "header.php";
  $conn = connect();
?>
<div class="misc">
  <div class='container'>
    <a href="home.php" id="dailyGrindWords"></a>
  </div>
  <div class="container">
    <ul class="navBar">
      <li class="navItem active" id="tasksBtn">ACTIVITIES</li>
      <li class="navItem" id="profileBtn">PROFILE</li>
      <li class="navItem" id="friendsBtn">FRIENDS</li>
    </ul>
  </div>
</div>

<div class="visibleTab" id="tasksTab">
  <?php include "activities.php" ?>
</div>

<div class="hiddenTab" id="profileTab">
  <?php include "profile.php" ?>
</div>

<div class="hiddenTab" id="friendsTab">
  <?php include "friends.php" ?>
</div>

<script src="../scripts/js/account.js"></script>

</body>

<footer>
  <?php 
    if($_SESSION['status'] != "premium"){
      include "footer.php";
    }
  ?>
</footer>
