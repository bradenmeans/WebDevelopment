<!-- Name: Braden Means -->

<!DOCTYPE html>
<html>
<head>
<title>Rancid Server</title>
<link href="movie.css" type="text/css" rel="stylesheet">
</head>
<body>

	<div class="banner">
<?php
echo "<img src='images/rancidbanner.png' alt='Rancid Tomatoes'>";
?>
</div>

<?php
$movieDir = $_GET['movieDir'] ?? "";

echo info($movieDir);

function info($movieDir) {
    $arr = file($movieDir . '/info.txt');
    $result = '<h1>' . $arr[0] . ' (' . $arr[1] . ') </h1>';
    return $result;
}
?>


<div class="container">
		<div class="background">
<?php
$arr = file($movieDir . '/info.txt');
if ($arr[2] >= 50) {
    echo "<img src='images/freshlarge.png' alt='Fresh'> <span>" . $arr[2] . "%</span>";
} else {
    echo "<img src='images/rottenlarge.png' alt='Rotten'> <span>" . $arr[2] . "%</span>";
}
?>
</div>

		<div class="generalInfoImage">
<?php
$image = $movieDir . '/overview.png';
echo "<img src=" . "'" . $image . "'" . ' alt=overview ><br>';

?>
</div>

		<div class="reviews">
<?php
echo reviewsLeft($movieDir);

function reviewsLeft($movieDir)
{
    $result = "";
    $numReviews = 1;

    while (file_exists($movieDir . "/review" . $numReviews . ".txt")) {
        $numReviews ++;
    }

    for ($index = 1; $index <= floor($numReviews / 2); $index ++) {
        $arr = file($movieDir . '/review' . $index . '.txt');
        $reviewText = $arr[0];
        $rating = $arr[1];
        $name = $arr[2];
        $publisher = $arr[3];

        if ($rating === "FRESH\n") {
            $result .= "<p class='reviewsText'><img src='images/fresh.gif' alt='Fresh' />";
        } else {
            $result .= "<p class='reviewsText'><img src='images/rotten.gif' alt='Rotten' />";
        }
        $result .= "<q>" . $reviewText . "</q></p>";
        $result .= "<p class='names'><img src='images/critic.gif' alt='Critic'/>" . $name . "<br/>" . $publisher;
    }
    return $result;
}
?>

</div>

		<div class="reviews">
<?php
echo reviewsRight($movieDir);

function reviewsRight($movieDir)
{
    $result = "";
    $numReviews = 1;

    while (file_exists($movieDir . "/review" . $numReviews . ".txt")) {
        $numReviews ++;
    }

    for ($index = floor($numReviews / 2) + 1; $index < $numReviews; $index ++) {
        $arr = file($movieDir . '/review' . $index . '.txt');
        $reviewText = $arr[0];
        $rating = $arr[1];
        $name = $arr[2];
        $publisher = $arr[3];

        if ($rating === "FRESH\n") {
            $result .= "<p class='reviewsText'><img src='images/fresh.gif' alt='Fresh' />";
        } else {
            $result .= "<p class='reviewsText'><img src='images/rotten.gif' alt='Rotten' />";
        }
        $result .= "<q>" . $reviewText . "</q></p>";
        $result .= "<p class='names'><img src='images/critic.gif' alt='Critic'/>" . $name . "<br/>" . $publisher;
    }
    return $result;
}
?>
</div>


		<div class="generalOverview">
<?php
echo overview($movieDir);

function overview($movieDir)
{
    $arr = file($movieDir . '/overview.txt');
    $result = '<dl>';

    for ($i = 0; $i < count($arr); $i ++) {
        $pieces = explode(":", $arr[$i]);
        $result = $result . '<dt>' . $pieces[0] . '</dt>';
        $result = $result . '<dd>' . $pieces[1] . '</dd>';
    }
    $result .= '</dl>';
    return $result;
}

?> 
</div>
	</div>


</body>
</html>