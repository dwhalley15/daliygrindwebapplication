<?php
  session_start();
  if(!isset($_SESSION['dglogin']) || $_SESSION['dglogin'] !== true){
    header("location: home.php");
    exit;
  }
  include "header.php";
  include '../resources/database.php';
  $user_id = $_SESSION['user_id'];
  $conn = connect();
  $query = mysqli_query($conn, 
            "SELECT * FROM activity JOIN app_user ON activity.user_id = app_user.user_id WHERE app_user.user_id = $user_id AND activity.state = 'active'");
  $categories = array("task", "study", "exercise", "social", "clean", "eat", "drink", "meditate");
  if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $existingCategory = $row['category'];
        $index = array_search($existingCategory, $categories);
        if ($index !== false) {
            unset($categories[$index]);
        }
    }
  }
  $randomCategory = $categories[array_rand($categories)];
  $msg = "";
  if(!empty($randomCategory)){
    $msg = "We recommend creating a $randomCategory activity!";
  }
?>

<div class="misc">
  <div class='container'>
    <a href="home.php" id="dailyGrindWords"></a>
  </div>
  <div class='container'>
    <p><?php if(!empty($msg)) echo $msg;?></p>
  </div>
  <div class='container'>
    <form class="newActivity" name="newActivity" method="post" action="../scripts/php/newActivityScript.php">
      <input type="text" class="textInput" id="name" name="name" placeholder="Activity Name" maxlength="25" required>
      <input type="text" class="textInput" id="description" name="description" placeholder="Activity Description" maxlength="255" required>

      <input type="hidden" name="category" id="category" value="task" required>
      
      <select class="textInput" id="categories" name="categories" maxlength="255" required>
                <option value="task">task</option>
                <option value="study">study</option>
                <option value="exercise">exercise</option>
                <option value="social">social</option>
                <option value="clean">clean</option>
                <option value="eat">eat</option>
                <option value="drink">drink</option>
                <option value="meditate">meditate</option>
      </select> 
      <input type="date" class="textInput" id="startTime" name="startTime" placeholder="name" maxlength="10" required maxlength="10" required required pattern = "[0-3][0-9]-[0-1][0-9]-[0-9]{4}">
      <input type="date" class="textInput" id="endTime" name="endTime" placeholder="name" maxlength="10" required maxlength="10" required required pattern = "[0-3][0-9]-[0-1][0-9]-[0-9]{4}">
      <input type="submit" class="submitBtn" id="activityIcon" value="">
      <p id='errorHidden'>All fields must be completed and filled in correctly!</p>
    </form>
  </div>
</div>
<script src="../scripts/js/newActivity.js"></script>
</body>