<?php
require_once '../lib/string_func.php';
print_r($_FILES);
echo "<br/>";
//exit;

//$filename = $_FILES['myFile']['name'];
//$type = $_FILES['myFile']['type'];
//$tmp_name = $_FILES['myFile']['tmp_name'];
//$error = $_FILES['myFile']['error'];
//$size = $_FILES['myFile']['size'];

//单文件
//$fileInfo = $_FILES['myFile'];
//$mes = uploadFile($fileInfo);
//echo $mes;


//多个单文件
//foreach($_FILES as $val){
//    $mes = uploadFile($val);
//    echo $mes."<br/>";
//}

uploadFiles();

function buildInfo()
{
    //多文件 或者 单文件
    $filesInfo = null;
    $i = 0;
    foreach ($_FILES as $V) {
        if (is_string($V['name'])) {
            //单文件，则$V是一维数组
            $filesInfo[$i] = $V;
            $i++;
        } else {
            //多文件时,则$V是二维数组
            $sum = 0;
            foreach ($V as $ke => $val) {
                $sum = count($val);
                foreach ($val as $key => $value) {
                    $filesInfo[$i+$key][$ke] = $value;
                }
            }
            $i += $sum;
        }
    }
    print_r($filesInfo);
    echo "<br/> ********** <br/>";
    return $filesInfo;
}


function uploadFiles($path = "uploads", $allowExt = array("gif", "jpeg", "png", "jpg", "wbmp"), $maxSize = 2097152, $imgFlag = true)
{
    $filesInfo = buildInfo();
    foreach ($filesInfo as $file) {
        $mes = uploadFile($file, $path, $allowExt, $maxSize, $imgFlag);
        echo "<br/>".$mes."<br/>";
    }
}

//单文件上传
function uploadFile($fileInfo, $uploadPath = "uploads", $allowExt = array("gif", "jpeg", "jpg", "png", "wbmp"), $maxSize = 5120000, $imgFlag = true)
{
    //判断错误信息
//    print_r($fileInfo);
//    echo "66666666666<br/>";
    $ext = getExt($fileInfo['name']);
//    echo $ext."<br/>";
    $mes = substr($fileInfo['name'], 0, strlen($fileInfo['name'])-strlen($ext)-1);
//    echo $mes."<br/>";
    $fileInfo['name'] = getUniName() . "." . $ext;
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 777, true);
    }
    $destination = $uploadPath . "/" . $fileInfo['name'];
    if ($fileInfo['error'] == UPLOAD_ERR_OK) {
        if (in_array($ext, $allowExt) == false) {
            exit($mes."非法文件类型");
        }
        if ($fileInfo['size'] > $maxSize) {
            exit($mes."文件过大");
        }
        if ($imgFlag == true) {
            //getimagesize（）函数可验证文件是否为图片类型
            if($fileInfo['size'] > 0){
                $info = getimagesize($fileInfo['tmp_name']);
//                echo $fileInfo['tmp_name']."----<br/>";
//                var_dump($info);
//                echo "----<br/>";
                if (!$info) {
                    exit($mes."不是真正的图片类型");
                }
            }else{
                exit($mes."文件为空");
            }
        }
        if(!is_uploaded_file($fileInfo['tmp_name'])){
            exit($mes."不是通过HTTP POST方式上传上来的");
        }
        if (move_uploaded_file($fileInfo['tmp_name'], $destination)) {
            $mes .= "文件上传成功";
        } else {
            $mes .= "文件移动失败";
        }
    } else {
        switch ($fileInfo['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $mes .= "超过了配置文件上传文件的大小";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $mes .= "超过了表单设置上传文件的大小";
                break;
            case UPLOAD_ERR_PARTIAL:
                $mes .= "文件被部分上传";
                break;
            case UPLOAD_ERR_NO_FILE:
                $mes .= "没有文件上传";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $mes .= "没有找到临时目录";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $mes .= "文件不可写";
                break;
            case UPLOAD_ERR_EXTENSION:
                $mes .= "由于PHP的扩展程序，中断了文件上传";
                break;
            default :
                break;
        }
    }

    return $mes;
}


//服务器端进行的配置
//1》file_uploads = On,支持通过HTTP POST方式上传文件
//2》;upload_tmp_dir =临时文件保存目录
//3》upload_max_filesize = 2M默认值是2M，上传的最大大小2M
//4》post_max_size = 8M，表单以POST方式发送数据的最大值，默认8M
//客户端进行配置
//<input type="hidden" name="MAX_FILE_SIZE" value="1024"  />
//<input type="file" name="myFile" accept="文件的MIME类型,..."/>

?>
