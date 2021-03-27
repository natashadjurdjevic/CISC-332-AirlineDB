<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $flights = getAirplanesForFlight( $_POST["day"]);
    $avgSeats = calculateAvgSeats($flights);
    var_dump($avgSeats);

?>

<? 
    echo "The average number of seats for ".$_POST["day"]."is ".$avgSeats?>