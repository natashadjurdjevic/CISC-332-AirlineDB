<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $airlines = getAirlines();
?>

<form action="updateNewTime.php" method="post">
    <p>Choose the preferred airline:</p>
    <? while ($row = $airlines->fetch()) { ?>
        <input class="airline-input" type="radio" name="airlineCode" value="<?= $row['Code'] ?>" required>
        <? echo $row["Code"]." - ".$row["Name"]; ?>
        <br>
    <? } ?>

    <div class="flight-list-section" style="display: none;">
        <p>Select a flight code to update the time</p>
        <div class="flight-list"></div>

        <p>Select the new departure time</p>
        <input type="time" name="scheduledDepartureTime" min="00:00" max="24:00" value="00:00" required>

        <br>

        <input type="submit" id="submit_button" value="Change departure time">
    </div>
</form>

<script>
    const airlineSelectors = document.querySelectorAll('.airline-input');
    
    airlineSelectors.forEach(function(selector) {
        selector.addEventListener('change', (event) => {
            // Handle request
            const airlineCode = event.target.value;
            console.log(airlineCode);
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function(){
                // Response
                const response = JSON.parse(httpRequest.responseText);
                console.log(response);

                // Show flight section
                const flightListSection = document.querySelector('.flight-list-section');
                flightListSection.style.display = "block";

                // Populate list
                const flightList = document.querySelector('.flight-list');
                flightList.innerHTML = '';

                response.forEach(function (flight) {
                    const inputElement = document.createElement("input");
                    inputElement.type = "radio";
                    inputElement.name = "flightNumber";
                    inputElement.value = flight.FlightNumber;
                    flightList.appendChild(inputElement);

                    const spanElement = document.createElement("span")
                    spanElement.innerHTML = flight.FlightNumber;
                    flightList.appendChild(spanElement);

                    const brElement = document.createElement("br");
                    flightList.appendChild(brElement);
                });
            };
            httpRequest.open('GET', 'http://localhost:8080/site/api/getFlightByAirline.php?airlineCode=' + airlineCode, true);
            httpRequest.send();
        });
    });

</script>
