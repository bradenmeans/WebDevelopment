<?php
// Name: Braden Means

include "DatabaseAdaptor.php";

$info = $_GET['info'];
$type = $_GET['type'];
$theDBA = new DatabaseAdaptor();
if (isset($info) && $type === 'actorList') {
    echo json_encode($theDBA->getAllActors($info));
} 

if (isset($info) && $type === 'movieList') {
    echo json_encode($theDBA->getAllMovies($info));
}


if (isset($info) && $type === 'roleList') {
    echo json_encode($theDBA->getAllRoles($info));
}


if (isset($_GET['first']) && isset($_GET['last'])) {
    echo json_encode($theDBA->getRoles($_GET['first'],$_GET['last']));
}


?>