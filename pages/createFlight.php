<?php  
    require("../includes/header.php");
    require("../database/functions.php");    
    startTransaction();
    $newFlight = addFlight($_POST["flightNumber"], $_POST["airlineCode"], $_POST["airplaneID"], $_POST["departureCode"], $_POST["arrivalCode"]);
    $newFlightDay = addFlightDay($_POST["flightNumber"], $_POST["airlineCode"], $_POST["day"]);
    commitTransaction();
    
    $flights = getAllFlights();
?>

<div class="bg-gray-300 m-16 py-4 px-12 content-center rounded">
    <p class="text-center text-xl pb-4 font-bold text-green-900" >The flight was succesfully created. </p>   

    <table class="content-center border-separate border border-yellow-400 table-auto m-auto">
        <tr>
            <th class="border bg-yellow-400 border-gray-800 p-4">Airline Code</th>
            <th class="border bg-yellow-400 border-gray-800 p-4">Flight Number</th>
            <th class="border bg-yellow-400 border-gray-800 p-4">Assigned Airplane ID</th>
            <th class="border bg-yellow-400 border-gray-800 p-4">Departing Airport Code</th>
            <th class="border bg-yellow-400 border-gray-800 p-4">Arrival Airport Code</th>        
        </tr>

        <?
        while ($row = $flights->fetch()) {
        ?>
            <tr>
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row['AirlineCode'] ?></td>  
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row["FlightNumber"] ?></td>             
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row['AssignedAirplaneID'] ?></td>
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row["DepartingAirportCode"] ?></td>        
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row['ArrivalAirportCode'] ?></td>               
            </tr>  
        <?
        }
        ?>
    </table>
</div>

<?php
    require("../includes/footer.php");
?>