<?php
require_once '../include.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
$autoFlag = $_POST['autoFlag'];


//echo "username :<br/> {$username} <br/>";
//echo "password :<br/> {$password} <br/>";
//echo "verify :<br/> {$verify} <br/>";
//echo "verify1 :<br/> {$verify1} <br/>";


if($verify == $verify1){
    $table = 'imooc_admin';
    $sql = "select * from {$table} where username = '{$username}' and password = '{$password}'";
//    echo "sql :<br/>{$sql}<br/>";
    $row = checkAdmin($sql);
//    print_r($res);
//    var_dump($res);
//    echo "row[id]:<br/> {$row['id']}";
    if($row){
        if($autoFlag){
            setcookie("adminID",$row['id'],time()+7*24*3600);
            setcookie("adminName",$row['username'],time()+7*24*3600);
        }
        $_SESSION['adminName'] = $row['username'];
        $_SESSION['adminID'] = $row['id'];
//        header("location:index.php");
        alertMes("登录成功","index.php");
    }else{
        alertMes("登录失败","login.php");
    }
}else{

    alertMes("验证码错误","login.php");
//    echo "<script>alert('验证码错误');</script>";
//    echo "<script>window.location = 'login.php';</script>";

}

?>