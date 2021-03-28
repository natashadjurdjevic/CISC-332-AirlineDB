<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getFlights($_POST["airlineCode"], $_POST["day"]);
?>

<div class="bg-gray-300 m-16 py-4 pl-12 content-center rounded">
    <p class="text-center text-xl pb-4 font-bold text-green-900" >The following flights are available on 
        <span class="text-green-600"><? 
            $days = $_POST["day"]; 
            print implode(", ", $days);
        ?></span>
    </p>
    <table class="content-center border-separate border border-green-800 table-auto m-auto">
        <thead>
            <tr>
                <th class="border bg-gray-200 border-green-700 p-4">Flight Number</th>
                <th class="border bg-gray-200 border-green-700 p-4">Departing Airport Code</th>
                <th class="border bg-gray-200 border-green-700 p-4">Arrival Airport Code</th>
            </tr>
        </thead>
        <?
        while ($row = $flights->fetch()) {
        ?>
            <tr>
                <td class="border border-green-700 px-4 py-2"><?= $row["FlightNumber"] ?></td>        
                <td class="border border-green-700 px-4 py-2"><?= $row['DepartingAirportCode'] ?></td>               
                <td class="border border-green-700 px-4 py-2"><?= $row['ArrivalAirportCode'] ?></td>
            </tr>  
        <?
        }
        ?>
    </table>

</div>

<?php
    require("../includes/footer.php");
?>