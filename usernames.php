<?php

// Get values from form. 
$values = empty($_POST['text']) ? '': $_POST['text'];
// Count number of words.
$count = str_word_count($values);

// Add our usernames to array.
// For loop.
for($b=0;$b<$count;$b++) {
	$usernames = explode(";",$values);
}
// For loop end.


?>

<html>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class = "form">
<form action="index.php" method="POST" >
    <input type="text" name="text" />
    <input type="submit" id="sub" value="Submit"/>
</form>
</div>


 <div class="message">
  <center><h2> HOW TO USE INSTAGRABBER </h2><center>
  	<p> Put username/usernames in textbox and seperate with ';' symbol. For example: instagram;8factapp </p>
  	
</div>




</html>