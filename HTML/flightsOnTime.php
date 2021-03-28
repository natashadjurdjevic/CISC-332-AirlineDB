<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getFlightsOnTime();
?>

<h2 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Flights</h2>
<div class="bg-gray-300 m-16 mt-4 py-4 pl-20 rounded shadow-lg">
    <p class="text-center text-xl pb-4 font-bold text-green-900" >The following flights arrived on time: </p>

    <table class="content-center border-separate border border-green-800 table-auto m-auto">
        <tr>
            <th class="border bg-gray-200 border-green-700 p-4">Flight Number</th>
            <th class="border bg-gray-200 border-green-700 p-4">Scheduled Arrival Time</th>
            <th class="border bg-gray-200 border-green-700 p-4">Actual Arrival Time</th>
        </tr>
        <?
            while ($row = $flights->fetch()) {
        ?>
            <tr>
                <td class="border border-green-700 px-4 py-2"><?= $row['FlightNumber'] ?></td>                
                <td class="border border-green-700 px-4 py-2"><?= $row['ScheduledArrivalTime'] ?></td>               
                <td class="border border-green-700 px-4 py-2"><?= $row['ActualArrivalTime'] ?></td>
            </tr>  
        <?
        }
        ?>
    </table>
</div>
<?
    require("../includes/footer.php");
?>