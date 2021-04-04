<?php
    /**
     * calculates average number of seats on all flights offered on a specific day
     * 
     * @param flights - the flights on the specific day
     */
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
