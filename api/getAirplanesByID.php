<?php
    require("../database/db.php");
    header("Content-type: text/json");

    $airplanes = [];

    if (empty($_GET['airlineCode'])) {
        echo json_encode($airplanes);
        return;
    }

    $airlineCode = $_GET['airlineCode'];

    $query = "
        SELECT DISTINCT AirplaneTypeName, AssignedAirplaneID FROM Flight, Airplane
        WHERE AirlineCode='$airlineCode'
        AND Airplane.AirplaneID = Flight.AssignedAirplaneID
    ";

    $result = $connection->query($query);

    while ($row = $result->fetch()) {
        array_push($airplanes, $row);
    }

    echo json_encode($airplanes);
?>