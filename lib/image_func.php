<?php
require_once 'string_func.php';
/***
 * 生产验证码图片
 * @param int $type
 * @param int $length
 * @param int $pixel
 * @param int $line
 * @param string $sess_name
 */
function verifyImage($type = 1, $length = 4, $pixel = 0, $line = 0, $sess_name = 'verify')
{
    session_start();
    //通过GD库做验证码
    //创建画布
    $width = 80;
    $height = 40;
    $image = imagecreatetruecolor($width, $height);
    //创建颜色
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    //用填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);

    $chars = buildRandomString($type, $length);
    //print_r($chars);
    //echo "<br/>";

    $_SESSION[$sess_name] = $chars;
    $fontfiles = array("arial.ttf", "arialdb.ttf", "arialbi.ttf", "ariali.ttf", "ariblk.ttf", "calibri.ttf");
    $fontfiles = array("SIMYOU.TTF");
    for ($i = 0; $i < strlen($chars); $i++) {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(20, 26);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
//            $fontfile = "../fonts/" . $fontfiles[mt_rand(0, count($fontfiles)-1)];
        //上一句有错,不知道为啥
        $fontfile = "D:/MyPHP/shopImooc/fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
        //echo $fontfile."<br/>";

        $text = substr($chars, $i, 1);
        //echo $text . "<br/>";
        //        $text = $chars[$i];
        //        echo $text . "<br/>";
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    if ($pixel) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }
    if ($line) {
        for ($i = 0; $i < $line; $i++) {
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1),
                mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }


    //php里面header是设定http协议标头的函数。
    //HTTP协议是基于请求／响应范式的。
    //一个客户机与服务器建立连接后，发送一个请求给服务器。服务器端返回响应，可以告知客户端相关的信息。
    //header("Content-type: image/jpeg")表明请求页面的内容是jpeg格式的图像。
    header("content-type:image/jpeg");
    imagejpeg($image);
    imagedestroy($image);

}

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
//    echo "<br/>image_func.php------resizeImage()----start<br/>";
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
//    echo "image_func.php------resizeImage()----1<br/>";
//        echo dirname($destination);
//        exit(0);
//    echo "<br/>----".file_exists(dirname($destination))."------<br/>";
    if ($destination && !file_exists(dirname($destination))) {
        mkdir(dirname($destination), 777, true);
//        echo "<br/>----------<br/>";
    }
//        header("content-type:".$mime);
    $outFun($dst_image, $destination);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    if ($isReservedSource == false) {
        unlink($filename);
    }
//    echo "<br/>image_func.php------resizeImage()----end<br/>";
    return $destination;
}

?>