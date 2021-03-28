<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $days = getDaysOffered();
?>

<div>
    <h1 class="ml-16 mt-12 text-4xl font-bold text-yellow-400 hover:text-gray-200">Calculate Average Number Of Seats</h1>
    <form action="calculateSeats.php" method="post" class="bg-gray-300 m-16 mt-4 py-4 pl-20 rounded shadow-lg">
        <p class="font-bold pt-3 pb-2 text-xl">Select a day to find average number of seats: </p>
        <?
        while ($row = $days->fetch()) {
        ?>
        <input class="ml-4" type="radio" name="day[]" value="<?= $row['Day']?>">
            <? echo $row["Day"]; ?> 
            <br>
        <?
        }
        ?>

    <div class="pt-6 pb-2 float-right"><input type="submit" id="submit_button" value="Calculate" class="bg-yellow-400 hover:bg-yellow-300 p-4 rounded shadow"></div>
    </form>
</div>

<?php
    require("../includes/footer.php");
?>

