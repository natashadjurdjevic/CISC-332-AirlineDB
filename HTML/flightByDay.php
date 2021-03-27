
    <?php
        require("../includes/header.php");
        require("../database/functions.php");
        $days = getDaysOffered();
        $airlines = getAirlines();
    ?>

    <h2>Find Available Flights</h2>

    <form action="fetchFlightByDay.php" method="post">

        <p>Choose the preferred airline: </p>
        <?php
        while ($row = $airlines->fetch()) {
        ?>
            <input type="radio" name="airlineCode" value="<?= $row['Code'] ?>">
            <? echo $row["Code"]." - ".$row["Name"]?>
           <br>
        <?
        }
        ?>

        <p>Select an available day: </p>
        <?
        while ($row = $days->fetch()) {
        ?>
           <input type="radio" name="day[]" value="<?= $row['Day']?>">
            <? echo $row["Day"]; ?> 
            <br>
        <?
        }
        ?>

        <input type="submit" id="submit_button" value="Get Flights">
    </form>

<?php
$connection = NULL;
?>
<? 
    require("../includes/footer.php");
?>