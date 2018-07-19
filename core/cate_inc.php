<?php
/***
 * 添加分类
 * @return string
 */
function addCate()
{
    $table = "imooc_cate";
    $arr = $_POST;
    if (insert($table, $arr)) {
        $mes = "添加成功！<a href = 'addCate.php'>继续添加</a>
            |<a href='listCate.php?page=1'>查看列表</a>";
    } else {
        $mes = "添加失败！<a href = 'addCate.php'>重新添加</a>
            |<a href='listCate.php?page=1'>查看列表</a>";
    }
    return $mes;
}

/***
 * 编辑分类
 * @param $id
 * @return string
 */
function editCate($id){
    $table = "imooc_cate";
    $arr = $_POST;
    $where = "id = {$id}";
    if ( update($table, $arr, $where) ){
        $mes = "修改成功！<a href = 'listCate.php?page=1'>查看列表</a>";
    }else{
        $mes = "修改失败！<a href = 'listCate.php?page=1'>查看列表</a>";
    }
    return $mes;
}

/***
 * 删除分类
 * @param $id
 * @return string
 */
function delCate($id){
    $mes = "";
    $table = "imooc_cate";
    $res = checkProExt($id);
    var_dump($res);
//    exit(0);
    if(empty($res)){
        alertMes("不能删除分类，请先删除该分类下的商品！","listPro.php");
    }else{
//        echo "可以删除<br/>";
//        exit(0);
        $where = "id = {$id}";
        if (delete($table, $where)){
            $mes = "删除成功！<a href = 'listCate.php?page=1'>查看列表</a>";
        }else{
            $mes = "删除失败！<a href = 'listCate.php?page=1'>查看列表</a>";
        }
    }
    return $mes;
}

function getCateByPage($page ,$pageSize = 2)
{
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from imooc_cate limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return $rows;
}

/***
 * 得到所有分类
 * @return multitype
 */

function getAllCate(){
    $sql = "select id, cName from imooc_cate";
    $rows = fetchAll($sql);
    return $rows;
}


?>