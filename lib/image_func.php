<?php
    require_once 'string_func.php';
    function verifyImage($type = 1,$length = 4,$pixel = 0,$line = 0,$sess_name = 'verify')
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
//    verifyImage();
?>