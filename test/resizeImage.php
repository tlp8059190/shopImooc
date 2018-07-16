<?php
    $filename = "des_big.jpg";
    $filePath = "uploads";
    $scale = 0.5;
    $src_image = @imagecreatefromjpeg($filename);
    if($src_image == true) {
//        var_dump($src_image);
        $tmpsize = getimagesize($filename);
        print_r($tmpsize);
        exit(0);
        list($src_w,$src_h) = getimagesize($filename);
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
        $dst_image = @imagecreatetruecolor($dst_w,$dst_h) or die("Cannot Initialize new GD image stream");
//        var_dump($dst_image);
//        print_r($dst_image);
        imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
        header("content-type:image/jpeg");
        imagejpeg($dst_image,$filePath."/".$filename);
        imagedestroy($src_image);
        imagedestroy($dst_image);
    }else {
//        var_dump($src_image);
        echo "图像错误";
    }
?>