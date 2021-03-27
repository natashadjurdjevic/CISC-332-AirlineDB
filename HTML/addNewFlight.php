<?php
    require("../includes/header.php");
    require("../database/functions.php");
    $airlines = getAirlines();
    $airplanes = getAirplanes();
    $departureAirports = getAirports();
    $arrivalAirports = getAirports();
    $days = getDaysOffered();
    ?>

    <h2>Create New Flight</h2>
   
    <form action="createFlight.php" method="post">

        <p>Enter a Flight Number</p>
        <input required type="text" name="flightNumber">

       <p>Choose the preferred airline:</p>
        <? while ($row = $airlines->fetch()) { ?>
           <input class="airline-input" required type="radio" name="airlineCode" value="<?= $row['Code'] ?>">
            <? echo $row["Code"]." - ".$row["Name"]; ?>
            <br>
        <? } ?>

        <div class="airplane-list-section" style="display: none;">
            <p>Choose the preferred airplane :</p>
            <div class="airplane-list"></div>

            <p>Select Departure Airport:</p>
            <? while ($row = $departureAirports->fetch()) { ?>
            <input required type="radio" name="departureCode" value="<?= $row['AirportCode'] ?>">
                <? echo $row["AirportCode"]." - ".$row["Name"]; ?>
                <br>
            <? } ?>

            <p>Select Arrival Airport:</p>
            <? while ($row = $arrivalAirports->fetch()) { ?>
            <input required type="radio" name="arrivalCode" value="<?= $row['AirportCode'] ?>">
                <? echo $row["AirportCode"]." - ".$row["Name"]; ?>
                <br>
            <? } ?>

            <p>Select an available day: </p>
            <?
            while ($row = $days->fetch()) {
            ?>
                <input type="checkbox" name="day[]" value="<?= $row['Day']?>">
                <? echo $row["Day"]; ?> 
                <br>
            <?
            }
            ?>
        </div>


        
        <input type="submit" id="submit_button" value="Create Flight">
    </form>



<?php
$connection = NULL;
?>

</body>
</html>

<script>
    const airlineSelectors = document.querySelectorAll('.airline-input');
    
    airlineSelectors.forEach(function(selector) {
        selector.addEventListener('change', (event) => {
            // Handle request
            const airlineCode = event.target.value;
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function(){
                // Response
                const response = JSON.parse(httpRequest.responseText);

                // Show airplane section
                const airplaneListSection = document.querySelector('.airplane-list-section');
                airplaneListSection.style.display = "block";

                // Populate list
                const airplaneList = document.querySelector('.airplane-list');
                airplaneList.innerHTML = '';

                response.forEach(function (flights) {
                    const inputElement = document.createElement("input");
                    inputElement.type = "radio";
                    inputElement.name = "airplaneID";
                    inputElement.value = flights.AssignedAirplaneID;
                    airplaneList.appendChild(inputElement);

                    const spanElement = document.createElement("span")
                    spanElement.innerHTML = flights.AirplaneTypeName;
                    airplaneList.appendChild(spanElement);

                    const brElement = document.createElement("br");
                    airplaneList.appendChild(brElement);
                });
            };
            httpRequest.open('GET', 'http://localhost:8080/site/api/getAirplanesByID.php?airlineCode=' + airlineCode, true);
            httpRequest.send();
        });
    });

</script>






