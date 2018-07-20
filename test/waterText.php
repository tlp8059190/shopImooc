<?php
$filename = "des_big.jpg";
$fontfile = "D:/MyPHP/shopImooc/fonts/SIMYOU.TTF";
$text = "imooc.com";
waterText($filename);

function waterText($filename,$fontfile = "D:/MyPHP/shopImooc/fonts/SIMYOU.TTF",$text="imooc.com")
{
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun = str_replace("/", null, $mime);
    $image = $createFun($filename);
    $color = imagecolorallocatealpha($image, 255, 0, 0, 50);
    imagettftext($image, 14, 0, 0, 14, $color, $fontfile, $text);
    header("content-type:" . $mime);
    $dstFilePath = "../".$filename;
    $outFun($image,$dstFilePath);
//    $outFun($image);
    imagedestroy($image);
}


?>