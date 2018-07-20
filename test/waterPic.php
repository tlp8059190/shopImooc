<?php
$srcFile = "../logo.jpg";
$dstFile = "des_big1.jpg";
waterPic($dstFile);
function waterPic($dstFile, $srcFile = "../logo.jpg")
{
    $srcFileInfo = getimagesize($srcFile);
    $dstFileInfo = getimagesize($dstFile);
    $src_w = $srcFileInfo[0];
    $src_h = $srcFileInfo[1];
    $srcMime = $srcFileInfo['mime'];
    $dstMime = $dstFileInfo['mime'];
    $createSrcFun = str_replace("/", "createfrom", $srcMime);
    $createDstFun = str_replace("/", "createfrom", $dstMime);
    $outDstFun = str_replace("/", null, $dstMime);
    $src_image = $createSrcFun($srcFile);
    $dst_image = $createDstFun($dstFile);
    imagecopymerge($dst_image, $src_image, 0, 0, 0, 0, $src_w, $src_h, 30);
    header("content-type:" . $dstMime);
    $dstFilePath = "../".$dstFile;
    $outDstFun($dst_image,$dstFilePath);
    imagedestroy($src_image);
    imagedestroy($dst_image);
}

?>