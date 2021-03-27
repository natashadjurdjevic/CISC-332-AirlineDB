<?php  
    require("../includes/header.php");
    require("../database/functions.php");
    $days = getDaysOffered();
?>

<form action="calculateSeats.php" method="post">

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

