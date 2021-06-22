<!DOCTYPE html>
<html>
<head>
<title>Rancid Start</title>
<link href="movie.css" type="text/css" rel="stylesheet">
</head>
<body>

<?php
//$movieDir = $_GET['movieDir'] ?? "";
$movieDir = 'princessbride';
$image = $movieDir . '/overview.png';

echo  info($movieDir);
echo "<img src=" . "'" . $image . "'" . ' alt=overview ><br>';
echo overview($movieDir);


function info($movieDir) {
    $arr = file($movieDir . '/info.txt');
    $result ='<h3>'. $arr[0] . ' was released in '. $arr[1]. '. It has a rating of ' . $arr[2] . '</h3>';
    return $result;
}

function overview($movieDir) {
    $arr = file($movieDir . '/overview.txt');
    $result = '<dl>';
    
    for($i = 0; $i <count($arr); $i++) {
        $pieces = explode(":", $arr[$i]);
        $result = $result . '<dt>' . $pieces[0] . '</dt>';
        $result = $result . '<dd>' . $pieces[1] . '</dd>';
    }
    $result .= '</dl>';
    return $result;
}


?> 

</body>
</html>