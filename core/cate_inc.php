<?php

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

function delCate($id){
    $table = "imooc_cate";
    $where = "id = {$id}";
    if (delete($table, $where)){
        $mes = "删除成功！<a href = 'listCate.php?page=1'>查看列表</a>";
    }else{
        $mes = "删除失败！<a href = 'listCate.php?page=1'>查看列表</a>";
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


?>