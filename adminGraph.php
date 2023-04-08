<?php
include 'connectDB.php';

//retrieve data from database
$sql = "SELECT community_name, COUNT(*) AS post_count
        FROM posts
        JOIN communities ON posts.community_id = communities.community_id
        GROUP BY community_name";

//run query
$result = mysqli_query($conn, $sql);

//formatting chart
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['community_name'];
    $data[] = $row['post_count'];
}
$data = json_encode($data);
$labels = json_encode($labels);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/style.css">
    <script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
    <!-- Jquery and chart.js scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <title>Statistics</title>
    
</head>
<body>
<a href= "admin.php" class = "button">Admin</i></a>

<canvas id="myChart"></canvas>
    <script>
        //chart 1
        const data = <?php echo $data; ?>;
        const labels = <?php echo $labels; ?>;
        
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Posts in each Community',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        
    </script>

</body>
</html>