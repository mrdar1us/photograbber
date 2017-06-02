<?php

set_time_limit(0);
// Get our name from URL.
$name = $_GET['user'];
$check = 1;
$i = 0;
$extended = '';

// Start while loop.
while ($check == 1) {

// Get JSON
    $url = 'https://instagram.com/'.$name.'/media/?max_id='.$extended.'';
    $content = file_get_contents($url);
    $json = json_decode($content, true);

// Foreach loop
    foreach ($json['items'] as $item) {
        $i++;
        $img = $item['images']['standard_resolution']['url'];
        $imgurl = substr($img, 0, strpos($img, '?'));
        if (strpos($imgurl, 's640x640') !== false) {
            $imgurl = strtr($imgurl, ['s640x640' => 's1080x1080']);
        } else {
            $imgurl = substr($img, 0, strpos($img, '?'));
        }

        $imagename = basename($imgurl);

        $profile_Image = $imgurl;
        $userImage = $imagename;
        $path = 'images/'.$name.'/';
        $thumb_image = file_get_contents($profile_Image);

        if ($http_response_header != null) {
            $thumb_file = $path.$userImage;
            if (!is_dir('images/'.$name)) {
                mkdir('images/'.$name);
            }
            file_put_contents($thumb_file, $thumb_image);
        }
    }
// End of foreach loop.
//// Check if we can get more photos ////
$last_id = $i - 1;
    $extended = $json['items']["$last_id"]['id'];
    $total = $i;
    $i = 0;

    $urlcheck = 'https://instagram.com/'.$name.'/media/?max_id='.$extended.'';
    $contentcheck = file_get_contents($urlcheck);
    $jsoncheck = json_decode($contentcheck, true);
    $checkmore = $jsoncheck['more_available'];

    if ($checkmore == 1) {
        $check = 1;
    } else {
        break;
    }

// End of while loop
}
// Breaks and gets pics.
// Get JSON
    $url = 'https://instagram.com/'.$name.'/media/?max_id='.$extended.'';
    $content = file_get_contents($url);
    $json = json_decode($content, true);

   foreach ($json['items'] as $item) {
       $i++;
       $img = $item['images']['standard_resolution']['url'];
       $imgurl = substr($img, 0, strpos($img, '?'));
       if (strpos($imgurl, 's640x640') !== false) {
           $imgurl = strtr($imgurl, ['s640x640' => 's1080x1080']);
       } else {
           $imgurl = substr($img, 0, strpos($img, '?'));
       }

       $imagename = basename($imgurl);

       $profile_Image = $imgurl;
       $userImage = $imagename;
       $path = 'images/'.$name.'/';
       $thumb_image = file_get_contents($profile_Image);

       if ($http_response_header != null) {
           $thumb_file = $path.$userImage;
           if (!is_dir('images/'.$name)) {
               mkdir('images/'.$name);
           }
           file_put_contents($thumb_file, $thumb_image);
       }
   }

header('Location: index.php?success=1');
