<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $airlines = getAirlines();
?>

<div>
    <h1 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Update Flight Departure Time</h1>
    <form action="updateNewTime.php" method="post"  class="bg-gray-300 m-16 mt-4 py-5 pl-12 rounded shadow-lg">
        <p class="font-bold pb-2 pt-3 text-xl">Choose the preferred airline:</p>
        <? while ($row = $airlines->fetch()) { ?>
            <input class="airline-input pr-2 ml-4" type="radio" name="airlineCode" value="<?= $row['Code'] ?>" required>
            <? echo $row["Code"]." - ".$row["Name"]; ?>
            <br>
        <? } ?>

        <div class="flight-list-section" style="display: none;">
            <p class="font-bold pt-6 pb-2 text-xl">Select a flight code to update the time</p>
            <div class="flight-list"></div>

            <p class="font-bold pt-6 pb-2 text-xl">Select the new departure time</p>
            <input class="p-4 pt-6 rounded bg-gray-100 shadow ml-4" type="time" name="scheduledDepartureTime" min="00:00" max="24:00" value="00:00" required>
            <br>

        </div>
        <div class="pt-6 pb-2 float-right"><input type="submit" id="submit_button" value="Change departure time" class="bg-yellow-400 hover:bg-yellow-300 p-4 rounded shadow"></div>
    </form>
</div>

<?php
    require("../includes/footer.php");
?>

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
                    inputElement.style.marginLeft = "16px"
                    flightList.appendChild(inputElement);

                    const spanElement = document.createElement("span")
                    spanElement.innerHTML = flight.FlightNumber;
                    spanElement.style.paddingLeft = "6px";
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
