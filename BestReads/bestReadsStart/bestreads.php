<?php
  // File name: bestreads.php
  // Author: Braden Means
  

$action = $_GET['action'];


$arr = glob('books/*');

if($action === 'one') {
    echo json_encode($arr);
}
if($action === 'two') {
    $book = $_GET['book'];
    $infoArr = file($arr[intval($book)]."/info.txt");
    $descriptionArr = file($arr[intval($book)]."/description.txt");
    $reviewArr = file($arr[intval($book)]."/review.txt");
    echo "<div class='onereview'><img src=". $arr[intval($book)]."/cover.jpg>
        <p class='thedetails'><b>".$infoArr[0]."</b><br>"
        .$infoArr[1]. "<br><br>".
        $descriptionArr[0]."<br><br>".
        "<b>".$reviewArr[0];
        for($i=0; $i<$reviewArr[1]; $i++) {
            echo "*";
        }
    echo "</b><br>".$reviewArr[2]. "</p></div>";
}

?>