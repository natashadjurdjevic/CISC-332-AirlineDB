<?php
require("../includes/header.php");
require("../database/functions.php");
$flights = getAirplanesForFlight($_POST["day"]);
$avgSeats = calculateAvgSeats($flights);

?>


<p class="text-center text-xl pb-4 font-bold text-green-900">The average number of seats available on
    <span class="text-green-600">
        <?php
        $days = $_POST["day"];
        print implode(", ", $days);
        ?></span> is <span class="text-green-600"><?php echo $avgSeats ?></span>
</p>