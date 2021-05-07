<?php




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

