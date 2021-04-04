<?php
require("../includes/header.php");
require("../database/functions.php");
$days = getDaysOffered();
?>

<div>
    <h1 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Calculate Average Number Of Seats</h1>

    <?php
    if (!empty($_POST["day"])) {
        require("../helpers/calculateAvgSeats.php");
        $flights = getAirplanesForFlight($_POST["day"]);
        $avgSeats = calculateAvgSeats($flights);
    ?>
        <div class="calculated-seats bg-gray-300 mx-16 my-8 mt-4 py-5 pl-12 rounded shadow-lg">
            <p class="calculated-seats text-center text-xl font-bold text-green-900">The average number of seats available on a
                <span class="text-green-600"><?php
                                                print implode(", ", $_POST["day"]);
                                                ?></span> is <span class="text-green-600"><?php echo number_format($avgSeats, 2) ?></span>
            </p>
        </div>
    <?php } ?>
    <form method="post" class="day-input bg-gray-300 m-16 mt-4 py-4 pl-20 rounded shadow-lg">
        <p class="font-bold pt-3 pb-2 text-xl">Select a day to find average number of seats: </p>
        <?php while ($row = $days->fetch()) {
        ?>
            <input required class="ml-4" type="radio" name="day[]" value="<?= $row['Day'] ?>">
            <?php echo $row["Day"]; ?>
            <br>
        <?php         }
        ?>
        <div class="pt-6 pb-2 float-right"><input type="submit" id="submit_button" value="Calculate" class="bg-yellow-400 hover:bg-yellow-300 p-4 rounded shadow"></div>
    </form>
</div>

<?php
require("../includes/footer.php");
?>