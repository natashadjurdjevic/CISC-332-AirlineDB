<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
    <head>
        <meta charset="utf-8">
        <link href="../tailwind.css" rel="stylesheet">
    </head>
    <header class="flex justify-around bg-yellow-400 max-h-20">
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='../airline.php'>Home</a>
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='flightsOnTime.php'>Find Flights On Time</a>
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='flightByDay.php'>Find Flights by Day</a>
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='addNewFlight.php'>Add New Flight</a>
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='updateDepartureTime.php'>Update Departure Time</a>
        <a class="text-center font-bold py-6 px-2 hover:bg-yellow-300" href='averageSeats.php'>Calculate Average Seats</a>
    </header>
    <div class="bg-gray-200 h-6 shadow-lg"></div>
    <body class="bg-gray-600 flex-1 font-sans">