<html>

<head>
    <meta charset="utf-8">
    <link href="tailwind.css" rel="stylesheet">
</head>
<header class="flex justify-around bg-yellow-400 max-h-20">
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/airline.php'>Home</a>
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/flightsOnTime.php'>Find Flights On Time</a>
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/flightByDay.php'>Find Flights by Day</a>
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/addNewFlight.php'>Add New Flight</a>
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/updateDepartureTime.php'>Update Departure Time</a>
    <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='pages/averageSeats.php'>Calculate Average Seats</a>
</header>
<div class="bg-gray-200 h-6 shadow-lg"></div>

<body class="bg-gray-600 flex-1 font-sans">
    <div>
        <div class="ml-8 mt-8 text-9xl font-bold text-yellow-400 text-gray-100 hover:text-gray-200"> Flight Maintenance System</div>
    </div>
    <?php
    require("includes/footer.php");
    ?>