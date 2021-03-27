<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getFlights($_POST["airlineCode"], $_POST["day"]);
?>

<table border='1'>
    <tr>
        <th>Flight Number</th>
        <th>Departing Airport Code</th>
        <th>Arrival Airport Code</th>
    </tr>

    <?
    while ($row = $flights->fetch()) {
    ?>
        <tr>
            <td><?= $row["FlightNumber"] ?></td>        
            <td><?= $row['DepartingAirportCode'] ?></td>               
            <td><?= $row['ArrivalAirportCode'] ?></td>
        </tr>  
    <?
    }
    ?>
</table>

<?php
    require("../includes/footer.php");
?>