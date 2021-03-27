<?php  
    require("../includes/header.php");
    require("../database/functions.php");

    var_dump($_POST["airplaneID"]);
    
    startTransaction();
    $newFlight = addFlight($_POST["flightNumber"], $_POST["airlineCode"], $_POST["airplaneID"], $_POST["departureCode"], $_POST["arrivalCode"]);
    $newFlightDay = addFlightDay($_POST["flightNumber"], $_POST["airlineCode"], $_POST["day"]);
    commitTransaction();
    
    $flights = getAllFlights();
?>

<table border='1'>
    <tr>
        <th>Flight Number</th>
        <th>Departing Airport Code</th>
        <th>Arrival Airport Code</th>
        <th>Flight Number</th>
        <th>Departing Airport Code</th>
        <th>Arrival Airport Code</th>
        <th>Flight Number</th>
        <th>Departing Airport Code</th>
        <th>Arrival Airport Code</th>
    </tr>

    <?
    while ($row = $flights->fetch()) {
    ?>
        <tr>
            <td><?= $row["FlightNumber"] ?></td>        
            <td><?= $row['AirlineCode'] ?></td>               
            <td><?= $row['AssignedAirplaneID'] ?></td>
            <td><?= $row["DepartingAirportCode"] ?></td>        
            <td><?= $row['ArrivalAirportCode'] ?></td>               
            <td><?= $row['ScheduledDepartureTime'] ?></td>
            <td><?= $row["ActualDepartureTime"] ?></td>        
            <td><?= $row['ScheduledArrivalTime'] ?></td>               
            <td><?= $row['ActualArrivalTime'] ?></td>
        </tr>  
    <?
    }
    ?>
</table>