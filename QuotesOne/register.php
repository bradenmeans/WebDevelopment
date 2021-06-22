<!DOCTYPE html>
<!-- author: Braden Means -->
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php 
session_set_cookie_params(0);
session_start();
?>
<h2>Register</h2>
<div class='registerLoginContainer'>
<form action="controller.php" method="post"> 
<input type='text' name='username' class='userPassField' placeholder='Username' required><br>
<input type='password' name='password' class='userPassField' placeholder='Password' required><br>
<input type='submit' value='Submit' class='rlButton'><br>
<?php 
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
</form>
</div>
</body>
</html>