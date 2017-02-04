<link rel="stylesheet" href="style/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$name = $_GET['username'];
set_time_limit(0);
$check = 1;
$i=0;
$extended="";
echo "<title>".$name. " photos </title>";

function getJSON($name,$extended) {
  global $url, $content, $json;
  $url = 'https://instagram.com/'.$name. '/media/?max_id='.$extended.'';
  $content = file_get_contents($url);
  $json = json_decode($content, true);

  
}
/// While loop ///
while($check == 1) {

getJSON($name,$extended);

      foreach($json['items'] as $item) { 
       $i++;
            ?>  
    <div id="content">
        
    <a href="<?php $photo = $item['images']['standard_resolution']['url']; if(strpos($photo, 's640x640') !== false) {echo strtr ($photo, array ('s640x640' => 's1080x1080'));}else{echo $photo;}?>" target='_blank'><img src="<?php echo $item['images']['thumbnail']['url']; ?>" ></a>

    </div>
  <?php  
        
 }
/// While loop end //   
//// Check /////
/// Get last id /// 
$last_id = $i - 1 ;
$extended = $json['items']["$last_id"]['id'];
$total = $i;
$i=0;

/// Check if available ///
$urlcheck = 'https://instagram.com/'.$name. '/media/?max_id='.$extended.'';
$contentcheck = file_get_contents($urlcheck);
$jsoncheck = json_decode($contentcheck, true);
$checkmore = $jsoncheck['more_available'];
$checkelem = count($checkmore);

  if($checkmore==1 || $checkelem > 1) {
    $check=1;
  }else{
    break;
}


}
/// More ///
    getJSON($name,$extended);


    foreach($json['items'] as $item) {
       $i++;
            ?>  
    <div id="content">
        
    <a href="<?php $photo = $item['images']['standard_resolution']['url']; if(strpos($photo, 's640x640') !== false) {echo strtr ($photo, array ('s640x640' => 's1080x1080'));}else{echo $photo;}?>"><img src="<?php echo $item['images']['thumbnail']['url']; ?>" ></a>

    </div>
  <?php  
        


 }   



?>