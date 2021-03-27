<?php  
require("database/fetchAirplane.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>
<header>
    <button onclick="document.location='flightsOnTime.php'">Find Flights by Day</button>
    <button onclick="document.location='HTML/showFlightDays.php'">Find Flights by Day</button>
    <button onclick="document.location='HTML/addFlight.php'">Add New Flight</button>
    <button onclick="document.location='HTML/updateFlight.php'">Update Flight Departure Time</button>
    <button onclick="document.location='HTML/averageSeats.php'">Calculate Average Number of Seats</button>
</header>
<body>
    <h1>Welcome to the Airline site!</h1>
    <!-- <ol>
        <?php
            while ($row = $result->fetch()) {
                echo "<li>";
                echo $row["AirplaneTypeName"];
                echo "</li>";
            }
        ?>
    </ol> -->

  
</body>
</html>