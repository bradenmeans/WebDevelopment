<?php
// This file contains a bridge between the view and the model and redirects back to the proper page
// with after processing whatever form this code absorbs. This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and Braden Means
//  
session_set_cookie_params(0);
session_start (); // Not needed until a future iteration

require_once './DatabaseAdaptor.php';

$theDBA = new DatabaseAdaptor();

if (isset ( $_GET ['todo'] ) && $_GET ['todo'] === 'getQuotes') {
    $arr = $theDBA->getAllQuotations();
    unset($_GET ['todo']);
    echo getQuotesAsHTML ( $arr );
}

if (isset($_GET['logout']) && $_GET ['logout'] === 'userLogout') {
    unset($_SESSION['logged in']);
    $arr = $theDBA->getAllQuotations();
    echo getQuotesAsHTML ( $arr );
}

if(isset($_POST['author']) && isset($_POST['quote'])) {
    $theDBA->addQuote($_POST['quote'],$_POST['author']);
    header("Location: view.php"); 
}

if(isset($_POST['update']) && $_POST['update'] == "increase") {
    $theDBA->increaseRating($_POST['ID']);
    header("Location: view.php"); 
}
if(isset($_POST['update']) && $_POST['update'] == "decrease") {
    $theDBA->decreaseRating($_POST['ID']);
    header("Location: view.php");
}
if(isset($_POST['update']) && $_POST['update'] == "delete") {
    $theDBA->deleteQuote($_POST['ID']);
    header("Location: view.php");
}

if(isset($_POST['username']) && isset($_POST['password']) && $theDBA->validUsername($_POST['username'])) {
    $theDBA->addUser($_POST['username'], $_POST['password']);
    header("Location: view.php");
}
else if (isset($_POST['username']) && isset($_POST['password']) && !$theDBA->validUsername($_POST['username'])) {
    $_SESSION['error'] = "<p class='error'><b>Account name taken</b></p>";
    header("Location: register.php");
}

if (isset($_POST['loginUsername']) && isset($_POST['loginPassword']) && $theDBA->verifyCredentials($_POST['loginUsername'], $_POST['loginPassword'])) {
    $_SESSION["logged in"] = "Now logged in.";
    header("Location: view.php");
}
else if (isset($_POST['loginUsername']) && isset($_POST['loginPassword']) && !$theDBA->verifyCredentials($_POST['loginUsername'],$_POST['loginPassword'])) {
    $_SESSION['error'] = "<p class='error'><b>Invalid username/password</b></p>";
    header("Location: login.php");
}


function getQuotesAsHTML($arr) {
    $result = '';
    if (!isset($_SESSION["logged in"])) {
        echo "<a href='./register.php'><button>Register</button></a>";
        echo "<a href='./login.php' ><button>Login</button></a>";
    }
    else if (isset($_SESSION["logged in"])) {
        echo "<a href='./addQuote.php'><button>Add Quote</button></a>";
        echo "<button id='loggedout' onclick='logout()'>Log out</button>";
    }
    foreach ($arr as $quote) {
        $result .= '<div class="container">';
        $result .= '"' . $quote ['quote'] . '"';
        $result .= "<br><p class = author>";
        $result .= "--" . $quote['author'] . "<br></p>";
        $result .= "<form action='controller.php' method ='post'>";
        $result .= "<input type='hidden' name='ID' value='". $quote['id'] ."'>&nbsp;&nbsp;&nbsp;";
        $result .= "<button name='update' value='increase'>+</button>";
        $result .= "&nbsp;<span id='rating'>" . $quote['rating'] . "</span>&nbsp;&nbsp;";
        $result .= "<button name='update' value='decrease'>-</button>&nbsp;&nbsp;";
        if(isset($_SESSION["logged in"])) {
            $result .= "<button name='update' value='delete'>Delete</button>";
        }
        $result .= "</form>";
        $result .= "</div>";
        
              
    }
    
    return $result;
}
?>