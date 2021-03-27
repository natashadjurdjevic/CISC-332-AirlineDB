<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getFlightsOnTime();
?>
<table border='1'>
    <tr>
        <th>Flight Number</th>
        <th>Scheduled Arrival Time</th>
        <th>Actual Arrival Time</th>
    </tr>
    <?
        while ($row = $flights->fetch()) {
    ?>
        <tr>
            <td><?= $row['FlightNumber'] ?></td>                
            <td><?= $row['ScheduledArrivalTime'] ?></td>               
            <td><?= $row['ActualArrivalTime'] ?></td>
        </tr>  
    <?
    }
    ?>
</table>
<?
    require("../includes/footer.php");
?>