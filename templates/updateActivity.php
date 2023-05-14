<?php
  session_start();
  if(!isset($_SESSION['dglogin']) || $_SESSION['dglogin'] !== true){
    header("location: home.php");
    exit;
  }
  include '../resources/database.php';
  include "header.php";
  $activity_id = $_GET["activity_id"];
  $conn = connect();
  $result = mysqli_query($conn, "SELECT * FROM activity WHERE activity_id = '$activity_id'");
  $activity = mysqli_fetch_assoc($result);
?>
<div class="misc">
  <div class='container'>
    <a href="home.php" id="dailyGrindWords"></a>
  </div>
  <br>
  <div class='container'>
    <a href="../scripts/php/completeActivityScript.php?activity_id=<?php echo $activity['activity_id'];?>" id='yesIcon'></a>
  </div>
  <br>
  <div class='container'>
    <form class="updateActivity" name="updateActivity" method="post" action="../scripts/php/updateActivityScript.php">
      <input type="hidden" name="activity_id" id="activity_id" value="<?php echo $activity['activity_id']?>" required>
      <input type="text" class="textInput" id="name" name="name" value="<?php echo $activity['name']?>" placeholder="Activity Name" maxlength="25" required>
      <input type="text" class="textInput" id="description" name="description" value="<?php echo $activity['description']?>" placeholder="Activity Description" maxlength="255" required>

      <input type="hidden" name="category" id="category" value="<?php echo $activity['category']?>" required>
      
      <select class="textInput" id="categories" name="categories" maxlength="255" required>
                <option value="task"<?php if($activity['category'] == "task") echo "selected" ?>>task</option>
                <option value="study"<?php if($activity['category'] == "study") echo "selected" ?>>study</option>
                <option value="exercise"<?php if($activity['category'] == "exercise") echo "selected" ?>>exercise</option>
                <option value="social"<?php if($activity['category'] == "social") echo "selected" ?>>social</option>
                <option value="clean"<?php if($activity['category'] == "clean") echo "selected" ?>>clean</option>
                <option value="eat"<?php if($activity['category'] == "eat") echo "selected" ?>>eat</option>
                <option value="drink"<?php if($activity['category'] == "drink") echo "selected" ?>>drink</option>
                <option value="meditate"<?php if($activity['category'] == "meditate") echo "selected" ?>>meditate</option>
      </select> 
      <input type="date" class="textInput" id="startTime" name="startTime" value="<?php echo $activity['start']?>" maxlength="10" required maxlength="10" required required pattern = "[0-3][0-9]-[0-1][0-9]-[0-9]{4}">
      <input type="date" class="textInput" id="endTime" name="endTime" value="<?php echo $activity['end']?>" maxlength="10" required maxlength="10" required required pattern = "[0-3][0-9]-[0-1][0-9]-[0-9]{4}">
      <input type="submit" class="submitBtn" id="updateIcon" value="">
      <p id='errorHidden'>All fields must be completed and filled in correctly!</p>
    </form>
  </div>
</div>
<script src="../scripts/js/updateActivity.js"></script>
</body>