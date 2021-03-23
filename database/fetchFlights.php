<!-- show all the flights (flight code and arrival time) with scheduled arrival times the same as 
the actual arrival times. -->

<?php  
require("db.php");
$result = $connection->query("select * from Flight");
?>