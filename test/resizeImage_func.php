<?php
require_once '../include.php';
$filename = "des_big.jpg";

resizeImage($filename, "image-50"."/".$filename, true, 50, 50);
resizeImage($filename, "image-150"."/".$filename, true, 200, 200);
resizeImage($filename, "image-250"."/".$filename, true, 350, 350);
resizeImage($filename, "image-350"."/".$filename, true, 400, 500);
/***
 * 生产缩略图
 * @param $filename
 * @param null $destination
 * @param bool $isReservedSource
 * @param null $dst_w
 * @param null $dst_h
 * @param float $scale
 * @return null|string
 */
function resizeImage($filename, $destination = null, $isReservedSource = true, $dst_w = null, $dst_h = null, $scale = 0.5)
{
    $desfilename = getUniName() . "." . getExt($filename);
    if ($destination == null) {
        $destination = $desfilename;
    } else {
        $destination = $destination . "/" . $desfilename;
    }
    list($src_w, $src_h, $imagetype) = getimagesize($filename);
    if (is_null($dst_w) || is_null($dst_h)) {
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
    }
    //image/jpeg
    $mime = image_type_to_mime_type($imagetype);
////        jpeg
//        $ext = image_type_to_extension($imagetype);
//        echo $mime." && ".$ext."<br/>";
    //创建图像函数名，例imagecreatefromjpeg()
    $createFun = str_replace("/", "createfrom", $mime);
    $src_image = $createFun($filename);

    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    //输出图像函数名，例imagejpeg()
    $outFun = str_replace("/", null, $mime);
//        echo dirname($destination);
//        exit(0);
    if ($destination && !file_exists(dirname($destination))) {
        mkdir(dirname($destination), 777, true);
    }
//        header("content-type:".$mime);
    $outFun($dst_image, $destination);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    if ($isReservedSource == false) {
        unlink($filename);
    }
    return $destination;
}

?>