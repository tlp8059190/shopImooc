<?php

/***
 * 检查管理员登录是否正确
 * @param $sql
 * @return multitype
 */
function checkAdmin($sql){
    return fetchOne($sql);
}

/**
 * 检查是否登录
 */
function checkLogined(){
    if($_SESSION['adminID'] == "" && $_COOKIE['admadminIDinID'] == ""){
        alertMes("请先登录","login.php");
    }
}

/**
 * 注销管理员
 */
function logout(){

    $_SESSION[] = array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminID'])){
        setcookie('adminID',"",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie('adminName',"",time()-1);
    }

    session_destroy();
    header("location:login.php");
}

/***
 * 添加管理员
 * @return string
 */
function addAdmin(){
    $arr = $_POST;
    $table = "imooc_admin";
    $arr['password'] = md5($_POST['password']);
    if(insert($table,$arr)){
        $mes = "添加成功！<br/><a href='addAdmin.php'>继续添加</a>|
                <a href='listAdmin.php?page=1'>查看管理员列表</a>";
    }else{
        $mes = "添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

/***
 * 得到所有管理员
 * @return multitype
 */
function getAllAdmin(){
    $sql = "select id, username, email from imooc_admin";
    $rows = fetchAll($sql);
    return $rows;
}

/***
 * 编辑管理员
 * @param $id
 * @return string
 */
function editAdmin($id){
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    $table = 'imooc_admin';
    $where = "id= {$id}";
    if(update($table,$arr,$where)){
        $mes = "编辑成功！<br/><a href = 'listAdmin.php?page=1'>查看管理员列表</a>";
    }else{
        $mes = "编辑失败！<br/><a href = 'listAdmin.php?page=1'>请重新修改</a>";
    }
    return $mes;
}

/***
 * 删除管理员
 * @param $id
 * @return string
 */
function delAdmin($id){
    $table = 'imooc_admin';
    if(delete($table,"id = {$id}")){
        $mes = "删除成功！<br/><a href = 'listAdmin.php?page=1'>查看管理员列表</a>";
    }else{
        $mes = "删除失败！<br/><a href = 'listAdmin.php?page=1'>请重新删除</a>";
    }
    return $mes;
}

/***
 * 得到当前页的管理员列表
 * @param $page
 * @param int $pageSize
 * @return multitype
 */
function getAdminByPage($page ,$pageSize = 2)
{
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from imooc_admin limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return $rows;
}

?>