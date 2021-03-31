<?php
    require("../includes/header.php");
    require("../database/functions.php");
    $airlines = getAirlines();
    $airplanes = getAirplanes();
    $departureAirports = getAirports();
    $arrivalAirports = getAirports();
    $days = getDaysOffered();
    ?>

    <h2 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Create New Flight</h2>
   
    <form action="createFlight.php" method="post" class="bg-gray-300 m-16 mt-4 py-5 pl-12 rounded shadow-lg">

        <p class="font-bold pt-3 pb-2 text-xl">Enter a Flight Number</p>
        <input class="p-2 rounded bg-gray-100 shadow ml-4" required type="text" maxlength="3" placeholder="Flight Number" name="flightNumber">

       <p class="font-bold pt-3 pb-2 text-xl">Choose the preferred airline:</p>
       
        <? while ($row = $airlines->fetch()) { ?>
           <input class="airline-input ml-4" required type="radio" name="airlineCode" value="<?= $row['Code'] ?>">
            <? echo $row["Code"]." - ".$row["Name"]; ?>
            <br>
        <? } ?>

        <div class="airplane-list-section" style="display: none;">
            <p class="font-bold pt-3 pb-2 text-xl">Choose the preferred airplane :</p>
            <div class="airplane-list"></div>

            <p class="font-bold pt-3 pb-2 text-xl">Select Departure Airport:</p>
            <? while ($row = $departureAirports->fetch()) { ?>
            <input class="ml-4" required type="radio" name="departureCode" value="<?= $row['AirportCode'] ?>">
                <? echo $row["AirportCode"]." - ".$row["Name"]; ?>
                <br>
            <? } ?>

            <p class="font-bold pt-6 pb-2 text-xl">Select the New Departure Time</p>
            <input class="p-4 pt-6 rounded bg-gray-100 shadow ml-4" type="time" name="scheduledDepartureTime" min="00:00" max="24:00" value="00:00" required>
            <br>

            <p class="font-bold pt-3 pb-2 text-xl">Select Arrival Airport:</p>
            <? while ($row = $arrivalAirports->fetch()) { ?>
            <input class="ml-4" required type="radio" name="arrivalCode" value="<?= $row['AirportCode'] ?>">
                <? echo $row["AirportCode"]." - ".$row["Name"]; ?>
                <br>
            <? } ?>

            <p class="font-bold pt-6 pb-2 text-xl">Select the New Arrival Time</p>
            <input class="p-4 pt-6 rounded bg-gray-100 shadow ml-4" type="time" name="scheduledArrivalTime" min="00:00" max="24:00" value="00:00" required>
            <br>

            <p class="font-bold pt-3 pb-2 text-xl">Select an available day: </p>
            <?
            while ($row = $days->fetch()) {
            ?>
                <input class="ml-4" type="checkbox" name="day[]" value="<?= $row['Day']?>">
                <? echo $row["Day"]; ?> 
                <br>
            <?
            }
            ?>
        </div>        
        <div class="pt-6 pb-2 float-right"><input type="submit" id="submit_button" class="bg-yellow-400 hover:bg-yellow-300 p-4 rounded shadow ml-6" value="Create Flight"></div>
    </form>

<? $connection = NULL; ?>

<? require("../includes/footer.php"); ?>

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
                    inputElement.style.marginLeft = "16px";
                    airplaneList.appendChild(inputElement);

                    const spanElement = document.createElement("span")
                    spanElement.innerHTML = flights.AirplaneTypeName;
                    spanElement.style.marginLeft = "6px";
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






