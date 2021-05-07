<?php
include_once 'config/config.php';
include_once 'helpers/Database.php';
include_once 'helpers/functions.php';
include_once 'models/Visitor.php';

$conn = Database::connectDatabase($config);
$visitor = new Visitor($conn);
$ip = getIPAddress();
$url = getUrl();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$visitor->ip_address = $ip;
$visitor->user_agent = $user_agent;
$visitor->page_url = $url;
//
$visitor_get = $visitor->one($ip, $user_agent, $url);
//
if($visitor_get){
    $visitor->views_count = (int)$visitor_get['views_count']+ 1;
    $visitor->update();
}else{
    $visitor->save();
}


$my_img = imagecreate(400, 80);
$background = imagecolorallocate($my_img, 0, 0, 255);
$text_color = imagecolorallocate($my_img, 255, 255, 0);
$line_color = imagecolorallocate($my_img, 128, 255, 0);
imagestring($my_img, 4, 30, 25, "This image was created by Layiri Technologies", $text_color);
imagesetthickness($my_img, 5);
imageline($my_img, 30, 45, 380, 45, $line_color);
header("Content-type: image/png");
imagepng($my_img);
imagecolordeallocate($line_color);
imagecolordeallocate($text_color);
imagecolordeallocate($background);
imagedestroy($my_img);

