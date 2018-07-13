<?php
function buildRandomString($type = 1, $length = 4)
{

    if ($type == 1) {
        $chars = join("", range(0, 9));
    } else if ($type == 2) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z")));
    } else if ($type == 3) {
        $chars = join("", array_merge(range(0, 9), range("a", "z"), range("A", "Z")));
    }
    if ($length > strlen($chars)) {
        print_r($chars);
        exit(" 字符串长度不够！");
    }
    $chars = str_shuffle($chars);
    $result = substr($chars, 0, $length);
    return $result;
}

/***
 * 生成唯一字符串
 * @return string
 */
function getUniName()
{
    return md5(uniqid(microtime(true), true));
}

/***
 * 取文件扩展名
 * @param $filename
 * @return string
 */
function getExt($filename)
{
//    $result = explode(".",$filename);
//    print_r($result);
//    echo " 1 <br/>";
//    $str = end($result);
//    echo $str." 2 <br/>";
//    $extStr = strtolower($str);
//    echo $extStr." 3 <br/>";
//    return $extStr;

    $extStr = end(explode(".", $filename));
    return $extStr;
}

?>