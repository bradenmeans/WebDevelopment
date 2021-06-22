<?php
// Name: Braden Means

include "DatabaseAdaptor.php";

$theDBA = new DatabaseAdaptor();
$arr = $theDBA->getAllMovies("a");
print_r($arr);

?>