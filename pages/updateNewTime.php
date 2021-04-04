<?php
require("../includes/header.php");
require("../database/functions.php");
$newTime = updateDepartureTime($_POST["flightNumber"], $_POST["airlineCode"], $_POST["scheduledDepartureTime"]);
$flights = getAllFlights();
?>

<div class="bg-gray-300 m-16 py-4 px-12 content-center rounded">
    <p class="text-center text-xl pb-4 font-bold text-green-900">Departure time for flight <span class="text-green-600"><?php echo $_POST["airlineCode"] . "-" . $_POST["flightNumber"] ?></span> has been updated.</p>
    <table class="content-center border-separate border border-yellow-400 table-auto m-auto">
        <thead>
            <tr>
                <th class="border bg-yellow-400 border-gray-800 p-4 text-gray-600">Airline Code</th>
                <th class="border bg-yellow-400 border-gray-800 p-4 text-gray-600">Flight Number</th>
                <th class="border bg-yellow-400 border-gray-800 p-4 text-gray-600">Scheduled Departure Time</th>
            </tr>
        </thead>

        <?php while ($row = $flights->fetch()) {
        ?>
            <tr>
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row['AirlineCode'] ?></td>
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row["FlightNumber"] ?></td>
                <td class="border border-gray-800 bg-gray-200 px-4 py-2"><?= $row['ScheduledDepartureTime'] ?></td>
            </tr>
        <?php         }
        ?>
    </table>
</div>

<?php
require("../includes/footer.php");
?>