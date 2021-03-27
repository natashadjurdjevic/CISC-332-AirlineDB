<?php
    require("../database/db.php");
    header("Content-type: text/json");

    $flights = [];

    if (empty($_GET['airlineCode'])) {
        echo json_encode($flights);
        return;
    }

    $airlineCode = $_GET['airlineCode'];

    $query = "
        SELECT * FROM Flight
        WHERE AirlineCode='$airlineCode' 
    ";

    $result = $connection->query($query);

    while ($row = $result->fetch()) {
        array_push($flights, $row);
    }

    echo json_encode($flights);
?>