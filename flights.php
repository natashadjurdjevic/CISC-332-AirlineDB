<?php  
require("database/fetchFlights.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Flights</title>
</head>
<body>
    <h1>Welcome to the Airline site!</h1>
    <h2>planes we look after</h2>
    <ol>
        <?php
            while ($row = $result->fetch()) {
                echo "<li>";
                echo $row["FlightNumber"];
                echo " ";
                echo $row["ScheduledArrivalTime"];
                echo "</li>";
            }
        ?>
    </ol>
</body>
</html>