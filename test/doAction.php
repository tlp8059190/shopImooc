<?php
require_once '../lib/string_func.php';
print_r($_FILES);
echo "<br/>";

$filename = $_FILES['myFile']['name'];
$type = $_FILES['myFile']['type'];
$tmp_name = $_FILES['myFile']['tmp_name'];
$error = $_FILES['myFile']['error'];
$size = $_FILES['myFile']['size'];

//判断错误信息
$mes = "";
$ext = getExt($filename);
$filename = getUniName().".".$ext;
$destination = "./uploads/".$filename;
if( $error == UPLOAD_ERR_OK ){
    if(move_uploaded_file($tmp_name,$destination)){
        $mes = "文件上传成功";
    }else{
        $mes = "文件移动失败";
    }
}else{
    switch($error){
        case UPLOAD_ERR_INI_SIZE:
            $mes = "超过了配置文件上传文件的大小";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $mes = "超过了表单设置上传文件的大小";
            break;
        case UPLOAD_ERR_PARTIAL:
            $mes = "文件被部分上传";
            break;
        case UPLOAD_ERR_NO_FILE:
            $mes = "没有文件上传";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $mes = "没有找到临时目录";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $mes = "文件不可写";
            break;
        case UPLOAD_ERR_EXTENSION:
            $mes = "由于PHP的扩展程序，中断了文件上传";
            break;
        default :
            break;
    }
}

echo $mes;

//服务器端进行的配置
//1》file_uploads = On,支持通过HTTP POST方式上传文件
//2》;upload_tmp_dir =临时文件保存目录
//3》upload_max_filesize = 2M默认值是2M，上传的最大大小2M
//4》post_max_size = 8M，表单以POST方式发送数据的最大值，默认8M
//客户端进行配置
//<input type="hidden" name="MAX_FILE_SIZE" value="1024"  />
//<input type="file" name="myFile" accept="文件的MIME类型,..."/>

?>
