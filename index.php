<title> InstaGRABBER </title>
<link rel="stylesheet" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<center> <img id="logo-main" src="style/grabber.png" width="150" alt="Grabber"> </center>



<?php
set_time_limit(0);
error_reporting(0);
// Require usernames.php file.
require 'usernames.php';
// Success message
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo 'Success';
}

$extended = '';
$count = count($usernames);
$i = 0;
// Loop to display usernames.
function getJSON($name, $extended)
{
    global $url, $content, $json;
    $url = 'https://instagram.com/'.$name.'/media/?max_id='.$extended.'';
    $content = file_get_contents($url);
    $json = json_decode($content, true);
}
for ($x = 0; $x < $count; $x++) {
    echo '<center><h2>';
    echo strtoupper($usernames[$x]);
    echo '<hr>';
    $user = $usernames[$x];
    echo "<a href='download.php?user=$user'>Download All </a>";
    echo ' | ';
    echo "<a href='all.php?username=$user' target='_blank'>Show all ".$user.' photos</a>';
    echo ' | ';
    echo '</center><hr></h2>';

    getJSON($user, $extended); ?>



<?php
    // Start foreach loop
    foreach ($json['items'] as $item) {
        $i++; ?>  
    <div id="content">
        
    <a href="<?php $photo = $item['images']['standard_resolution']['url'];
        if (strpos($photo, 's640x640') !== false) {
            echo strtr($photo, ['s640x640' => 's1080x1080']);
        } else {
            echo $photo;
        } ?>" target='_blank'><img src="<?php echo $item['images']['thumbnail']['url']; ?>" ></a>

    </div>
<?php 
  // Print first 12 pictures (by default printing 20 pics, but 12 pics looks good in full hd).
  if ($i == 12) {
      break;
  }
    }
// End of foreach loop.
$i = 0;

//End of for loop
}
?>