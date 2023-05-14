<?php
  $userName = $_SESSION['name'];
  $userScoreQuery = mysqli_query($conn, 
            "SELECT score FROM app_user WHERE user_id=$user_id");
  $row = mysqli_fetch_array($userScoreQuery);
  $userScore = $row[0];
  $data = array();
  $data[] = ['Friend', 'Score'];
  $data[] = [(string)$userName, (int)$userScore];
  $query = mysqli_query($conn, 
            "SELECT u.user_id, u.full_name, u.score
            FROM app_user u
            INNER JOIN friend_list f ON u.user_id = f.user_id_req OR u.user_id = f.user_id_rec
            WHERE (f.user_id_req = $user_id OR f.user_id_rec = $user_id) AND u.user_id != $user_id AND f.accepted = 'true'");

if($query){
  while($row = mysqli_fetch_assoc($query)){
    $friendName = $row['full_name'];
    $friendScore = $row['score'];
    $data[] = [(string)$friendName, (int)$friendScore];
  }
}
$encodedData = json_encode($data);

echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable(' . $encodedData . ');
                var options = {
                    title: "Scores Comparison",
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
                chart.draw(data, options);
            }
        </script>

        <div id="chart_div" style="width: 500px; height: 500px;"></div>
        '

?>