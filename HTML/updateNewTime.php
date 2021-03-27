<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getAllFlights();
    $newTime = updateDepartureTime($_POST["flightNumber"], $_POST["airlineCode"], $_POST["scheduledDepartureTime"]);
?>


<table border='1'>
    <tr>
        <th>AirlineCode</th>
        <th>Flight Number</th>
        <th>Scheduled Departure Time</th>
    </tr>

    <?
    while ($row = $flights->fetch()) {
    ?>
        <tr>
            <td><?= $row['AirlineCode'] ?></td>   
            <td><?= $row["FlightNumber"] ?></td>                              
            <td><?= $row['ScheduledDepartureTime'] ?></td>
        </tr>  
    <?
    }
    ?>
</table>