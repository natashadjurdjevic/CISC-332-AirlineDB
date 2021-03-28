
    <?php
        require("../includes/header.php");
        require("../database/functions.php");
        $days = getDaysOffered();
        $airlines = getAirlines();
    ?>

    <h2 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Find Available Flights</h2>

    <form action="fetchFlightByDay.php" method="post" class="bg-gray-300 m-16 mt-4 py-5 pl-12 rounded shadow-lg">

        <p class="font-bold pt-3 pb-2 text-xl">Choose the preferred airline: </p>
        <?php
        while ($row = $airlines->fetch()) {
        ?>
            <input class="ml-4" type="radio" name="airlineCode" value="<?= $row['Code'] ?>">
            <? echo $row["Code"]." - ".$row["Name"]?>
           <br>
        <?
        }
        ?>

        <p class="font-bold pt-3 pb-2 text-xl">Select an available day: </p>
        <?
        while ($row = $days->fetch()) {
        ?>
           <input class="ml-4" type="radio" name="day[]" value="<?= $row['Day']?>">
            <? echo $row["Day"]; ?> 
            <br>
        <?
        }
        ?>

<div class="pt-6 pb-2 float-right"><input type="submit" id="submit_button" class="bg-yellow-400 hover:bg-yellow-300 p-4 rounded shadow" value="Get Flights"></div>
    </form>

<?php
$connection = NULL;
?>
<? 
    require("../includes/footer.php");
?>