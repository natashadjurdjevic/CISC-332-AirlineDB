<?php
    require("db.php");

    /**
     * Begin a transaction
     */
    function startTransaction() {
        global $connection;
        $connection->query("START TRANSACTION");
    }

    /**
     * Commit a pending transaction
     */
    function commitTransaction() {
        global $connection;
        $connection->query("COMMIT");
    }

    /**
     * This gets a list of flights by airline code and day
     * 
     * @param airlineCode - The code of the airline
     * @param day - Day to search on
     * @return flights - List of flights
     */
    function getFlights($airlineCode, $day) {
        global $connection;
        foreach ($day as $key=>$val) {
            $query = "
                SELECT * FROM DaysOfWeekFlightOffered
                JOIN Flight ON  
                    DaysOfWeekFlightOffered.AirlineCode = Flight.AirlineCode AND
                    DaysOfWeekFlightOffered.FlightNumber = Flight.FlightNumber
                WHERE 
                    DaysOfWeekFlightOffered.AirlineCode='$airlineCode' AND 
                    DaysOfWeekFlightOffered.DaysOfWeekOffered='$val'
            ";
        }

        $flights = $connection->query($query);

        return $flights;
    }
    /**
     * This gets a list of flights that arrived at their scheduled arrival time
     * 
     * @return flights - List of flights
     */
    function getFlightsOnTime() {
        global $connection;
        $query = "SELECT * FROM Flight WHERE ScheduledArrivalTime = ActualArrivalTime";

        $flights = $connection->query($query);

        return $flights;
    }

    /**
     * This returns all the days in the week
     * 
     * @return days - List of days
     */
    function getDaysOffered() {
        global $connection;
        $query = "SELECT * FROM DaysOfWeek ORDER BY sort";

        $days = $connection->query($query);
        return $days;
    }

    /**
     * This returns all data associated with the Airlines
     * 
     * @return airlines - List of airlines
     */
    function getAirlines() {
        global $connection;
        $query = "SELECT *  FROM Airline";

        $airlines = $connection->query($query);
        return $airlines;
    }


    function getAirports() {
        global $connection;
        $query = "SELECT * FROM Airport";

        $airports = $connection->query($query);
        return $airports;
    }

    function getAirplanes() {
        global $connection;
        $query = "SELECT * FROM Airplane";
        $airplanes = $connection->query($query);
        return $airplanes;
    }

    function getAllFlights() {
        global $connection;
        $query = " SELECT * FROM Flight
      ";

        $flights = $connection->query($query);
        return $flights;
    }

    function addFlight($flightNumber, $airlineCode, $assignedAirplaneID, $departingAirportCode, $arrivalAirportCode) {
        global $connection;
        $insertFlight = "
            INSERT INTO 
            Flight (
                FlightNumber, 
                AirlineCode, 
                AssignedAirplaneID, 
                DepartingAirportCode, 
                ArrivalAirportCode
            )
            VALUES (
                $flightNumber, 
                '$airlineCode', 
                $assignedAirplaneID , 
                '$departingAirportCode', 
                '$arrivalAirportCode'
            )
        ";

        $newFlight = $connection->exec($insertFlight);
       
        return $newFlight;
    }

    function addFlightDay($flightNumber, $airlineCode, $daysOffered) {
        global $connection;

        foreach ($daysOffered as $key=>$val) {
            $setDay = "
                INSERT INTO 
                DaysOfWeekFlightOffered (
                    FlightNumber, 
                    AirlineCode, 
                    DaysOfWeekOffered
                )
                VALUES (
                    $flightNumber, 
                    '$airlineCode', 
                    '$val'
                )
            ";

            $connection->exec($setDay);
        }
    }

    function updateDepartureTime($flightNumber, $airlineCode, $scheduledDepartureTime) {
        global $connection;

        $updateTime = "
            UPDATE Flight 
            SET ScheduledDepartureTime = '$scheduledDepartureTime'
            WHERE
            FlightNumber = '$flightNumber' AND AirlineCode = '$airlineCode'
        ";

        $newTime = $connection->exec($updateTime);

        return $newTime;
    }

    function getAirplanesForFlight($day) {
        global $connection;
        foreach ($day as $key=>$val) {

        $query = "
            SELECT * FROM 
                Airplane, 
                AirplaneType, 
                DaysOfWeekFlightOffered, 
                Flight
            WHERE 
                Flight.FlightNumber = DaysOfWeekFlightOffered.FlightNumber
            AND
                Flight.AssignedAirplaneID = Airplane.AirplaneID
            AND 
                Airplane.AirplaneTypeName = AirplaneType.Name
            AND 
                DaysOfWeekFlightOffered.DaysOfWeekOffered = '$val'
        ";
        }

        $planes = $connection->query($query);
        return $planes;
    }

    function calculateAvgSeats($flights) {
        $count = 0;
        $totalSeats = 0;
        while ($row = $flights->fetch()) {
            $count = $count + 1;
            $totalSeats = $totalSeats + $row['MaxSeats'];
        }

        $avgSeats = $totalSeats / $count;

        return $avgSeats;
    }
?>