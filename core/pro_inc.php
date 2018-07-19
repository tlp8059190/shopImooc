<?php
//require_once '../lib/upload_func.php';

function addpro()
{
//    echo "<br/>pro_inc.php------addpro()----start<br/>";
    $arr = $_POST;
//    print_r($arr);
//    exit(0);
    $arr['pubTime'] = time();
//    echo "<br/>pro_inc.php------addpro()----0<br/>";
//    print_r($arr);

    $path = "./uploads";
    $fileNames = uploadFiles($path);
//    echo "<br/>pro_inc.php------addpro()----1<br/>";
//    print_r($fileNames);
    if(is_array($fileNames) && !empty($fileNames)){
        foreach ($fileNames as $key => $fileName){
            resizeImage($path."/".$fileName['name'],"image_50"."/".$fileName['name'],true,50,50);
            resizeImage($path."/".$fileName['name'],"./image_150"."/".$fileName['name'],true,150,150);
            resizeImage($path."/".$fileName['name'],"./image_350"."/".$fileName['name'],true,350,350);
            resizeImage($path."/".$fileName['name'],"./image_520"."/".$fileName['name'],true,520,520);
        }
    }

    $res = insert("imooc_pro",$arr);
    $pid = getInsertID();
//    echo "<br/>pro_inc.php------addpro()----2<br/>";
//    echo $res."---".$pid;
//    echo "<br/>pro_inc.php------addpro()----3<br/>";
    $arr1 = array();
    $mes = "";
    if($res && $pid){
        foreach($fileNames as $fileName){
            $arr1['pid'] = $pid;
            $arr1['albumPath'] = $fileName['name'];
            addAlbum($arr1);
        }
        $mes =  "<p>添加成功！</p><a href = 'addPro.php' target = 'mainFrame'>继续添加</a>
                |<a href = 'listPro.php?page=1' target='mainFrame'>查看商品列表</a>";
    }else {
        foreach($fileNames as $fileName){
            $tmpPath = "./image_50"."/".$fileName['name'];
            if(file_exists($tmpPath)){
                unlink($tmpPath);
            }
            $tmpPath = "./image_150"."/".$fileName['name'];
            if(file_exists($tmpPath)){
                unlink($tmpPath);
            }
            $tmpPath = "./image_350"."/".$fileName['name'];
            if(file_exists($tmpPath)){
                unlink($tmpPath);
            }
            $tmpPath = "./image_520"."/".$fileName['name'];
            if(file_exists($tmpPath)){
                unlink($tmpPath);
            }
        }
        $mes =  "<p>添加失败！</p><a href = 'addPro.php' target = 'mainFrame'>重新添加</a>
                |<a href = 'listPro.php?page=1' target='mainFrame'>查看商品列表</a>";
    }
//    echo "<br/>pro_inc.php------addpro()----end<br/>";
    return $mes;
}

/***
 * 得到所有商品
 * @return array
 */
function getAllPros(){
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,
            p.isShow,p.isHot,c.cName from imooc_pro as p join imooc_cate c on p.cId = c.id";
    $rows = fetchAll($sql);
    return $rows;
}

function getAllImgByProId($id){
    $sql = "select a.albumPath from imooc_album a where pid = {$id}";
    echo $sql;
    $rows = fetchAll($sql);
    return $rows;
}

function getProImgById($id){
    $sql="select albumPath from imooc_album where pid={$id} limit 1";
    $row=fetchOne($sql);
    return $row;
}


function getProById($id){
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,
                p.isShow,p.isHot,p.cId,c.cName from imooc_pro as p join imooc_cate c on p.cId = c.id
                where p.id = {$id}";
    $rows = fetchOne($sql);
    return $rows;
}

/***
 * 得到四条产品
 * @param $Cid
 * @return multitype
 */
function getProsByCid($Cid){
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,
                p.isShow,p.isHot,p.cId,c.cName from imooc_pro as p join imooc_cate c on p.cId = c.id
                where p.cId = {$Cid} limit 4";
    $rows = fetchAll($sql);
//    print_r($rows);
//    echo "-----------<br/>";
    return $rows;
}

/***
 * 得到下四条产品
 * @param $cid
 * @return multitype
 */

function getSmallProsByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,
          p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id 
          where p.cId={$cid} limit 4";//本来应该是(limit 4,4),但是没有多的数据，所以只能从1开始
//    echo "<br/>{$sql}<br/>";
    $rows=fetchAll($sql);
    return $rows;
}



function editPro($id){
//    echo "<br/>pro_inc.php------editpro()----start<br/>";
    $table = "imooc_pro";
    $arr = $_POST;
    $where = "id = {$id}";
    $path = "./uploads";
    $fileNames = uploadFiles($path);
    if(is_array($fileNames) && !empty($fileNames)){
        foreach ($fileNames as $key => $fileName){
            resizeImage($path."/".$fileName['name'],"image_50"."/".$fileName['name'],true,50,50);
            resizeImage($path."/".$fileName['name'],"./image_150"."/".$fileName['name'],true,150,150);
            resizeImage($path."/".$fileName['name'],"./image_350"."/".$fileName['name'],true,350,350);
            resizeImage($path."/".$fileName['name'],"./image_520"."/".$fileName['name'],true,520,520);
        }
    }

    $res = update($table,$arr,$where);
    $pid = $id;
    $arr1 = array();
    $mes = "";
//    echo "<br/1_inc.php------addpro()----3<br/>";

    if($res && $pid ){
        if(is_array($fileNames) && !empty($fileNames)){
            foreach($fileNames as $fileName){
                $arr1['pid'] = $pid;
                $arr1['albumPath'] = $fileName['name'];
                addAlbum($arr1);
            }
        }
        $mes =  "<p>修改成功！</p>
                <a href = 'listPro.php?page=1' target='mainFrame'>查看商品列表</a>";
    }else {
        if(is_array($fileNames) && !empty($fileNames)){
            foreach($fileNames as $fileName){
                $tmpPath = "./image_50"."/".$fileName['name'];
                if(file_exists($tmpPath)){
                    unlink($tmpPath);
                }
                $tmpPath = "./image_150"."/".$fileName['name'];
                if(file_exists($tmpPath)){
                    unlink($tmpPath);
                }
                $tmpPath = "./image_350"."/".$fileName['name'];
                if(file_exists($tmpPath)){
                    unlink($tmpPath);
                }
                $tmpPath = "./image_520"."/".$fileName['name'];
                if(file_exists($tmpPath)){
                    unlink($tmpPath);
                }
            }
        }

        $mes =  "<p>修改失败！</p><a href = 'listPro.php?page=1' target='mainFrame'>查看商品列表</a>";
    }
//    echo "<br/>pro_inc.php------editpro()----end<br/>";
    return $mes;
}

function delPro($id){
    $where = "id = {$id}";
    $table = "imooc_pro";
    $res = delete($table,$where);
    $proImgs = getAllImgByProId($id);
    if(is_array($proImgs) && !empty($proImgs) ){
       foreach ($proImgs as $proImg){
           $filePath = "uploads/".$proImg['albumPath'];
//           echo "filePath1 : {$filePath} <br/>";
           if(file_exists($filePath)){
               unlink($filePath);
           }
           $filePath = "image_50/".$proImg['albumPath'];
//           echo "filePath2 : {$filePath} <br/>";
           if(file_exists($filePath)){
               unlink($filePath);
           }
           $filePath = "image_150/".$proImg['albumPath'];
//           echo "filePath3 : {$filePath} <br/>";
           if(file_exists($filePath)){
               unlink($filePath);
           }
           $filePath = "image_350/".$proImg['albumPath'];
//           echo "filePath4 : {$filePath} <br/>";
           if(file_exists($filePath)){
               unlink($filePath);
           }
           $filePath = "image_520/".$proImg['albumPath'];
//           echo "filePath5 : {$filePath} <br/>";
           if(file_exists($filePath)){
               unlink($filePath);
           }
        }
    }
    $table1 = "imooc_album";
    $where1 = "pId = {$id}";
    $res1 = delete($table1,$where1);
    if($res && $res1){
        $mes = "删除成功！<br/><a href = 'listPro.php?page=1' target = 'mainFrame'>查看列表</a>";
    }else{
        $mes = "删除失败！<br/><a href = 'listPro.php?page=1' target = 'mainFrame'>查看列表</a>";
    }
    return $mes;
}

/***
 * 检查分类下是否有商品
 * @param $cId
 * @return multitype
 * */
function checkProExt($cId){
    $sql = "select * from imooc_pro where cId ={$cId}";
    $rows = fetchAll($sql);
    return $rows;
}

?>