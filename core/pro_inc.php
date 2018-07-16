<?php
require_once '../lib/upload_func.php';
function addpro()
{
    echo "pro_inc.php------addpro()----start<br/>";
    $arr = $_POST;
//    print_r($arr);
//    exit(0);
    $arr['pubTime'] = time();
//    print_r($arr);

    $path = "./uploads";
    $fileNames = uploadFiles($path);
    echo "pro_inc.php------addpro()----1<br/>";
//    print_r($fileNames);
    if(is_array($fileNames) && !empty($fileNames)){
        foreach ($fileNames as $key => $fileName){
            resizeImage($path."/".$fileName['name'],"image_50",true,50,50);
            resizeImage($path."/".$fileName['name'],"./image_150",true,150,150);
            resizeImage($path."/".$fileName['name'],"./image_350",true,350,350);
            resizeImage($path."/".$fileName['name'],"./image_520",true,520,520);
        }
    }
    echo "pro_inc.php------addpro()----end<br/>";
    $res = insert("imooc_pro",$arr);
    $pid = getInsertID();
    if($res && $pid){
        foreach($fileNames as $fileName){
            $arr1['pid'] = $pid;
            $arr1['albumPath'] = $fileName;
        }
        addAlbum($arr1);
    }

}
?>