<!DOCTYPE html>
<!-- author: Braden Means -->
<html>
<head>
<title>Add a Quote</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h2>Add a Quote</h2>
<div class='quoteContainer'>
<form action="controller.php" method="post"> 
<textarea name='quote' class='quoteField' placeholder="Enter a quote..." required></textarea><br>
<input type='text' name='author' class='authorField' placeholder="Author" required><br>
<input type='submit' value='Add a Quote' class='addQuoteButton'>
</form>
</div>
</body>
</html>