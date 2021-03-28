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

    /**
     * This returns all data associated with Aiports
     * 
     * @return airports - List of airports
     */
    function getAirports() {
        global $connection;
        $query = "SELECT * FROM Airport";

        $airports = $connection->query($query);
        return $airports;
    }

     /**
     * This returns all data associated with Airplanes
     * 
     * @return airplanes - List of airplanes
     */
    function getAirplanes() {
        global $connection;
        $query = "SELECT * FROM Airplane";
        $airplanes = $connection->query($query);
        return $airplanes;
    }

    /**
     * This returns all data associated with Flights
     * 
     * @return flights - List of flights
     */
    function getAllFlights() {
        global $connection;
        $query = " SELECT * FROM Flight
      ";

        $flights = $connection->query($query);
        return $flights;
    }

    /**
     * This inserts a new flight into the Flights table
     * 
     * @param flightNumber - new flight number
     * @param airlineCode - selected airline code
     * @param assignedAirplaneID - the selected airplane for the flight
     * @param departingAirportCode - departing location for flight
     * @param arrivalAirportCode - arrival location for flight
     * 
     * @return flights - List of flights
     */
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

    /**
     * This inserts a new flight into the DaysOfWeekFightOffered table
     * 
     * @param flightNumber - new flight number
     * @param airlineCode - selected airline code
     * @param daysOffered - days the flight will be offered
     */
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

    /**
     * Updates the departure time of a flight in Flight table
     * 
     * @param flightNumber - selected flight number
     * @param airlineCode - selected airline code
     * @param scheduledDepartureTime - new departure time for flight
     * 
     * @return newTime - new flight departure time
     */
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

    /**
     * Returns the airplane, airplaneType and flight information for flights on a specific weekday
     * 
     * @param day - day of week to search
     * 
     * @return planes - plane information for that day
     */
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
?>