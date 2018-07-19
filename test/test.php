<?php
    require_once '../include.php';
    $arr['cName'] = 'asdasd5555';
    $res = -1; $pid = -1;
    $res = insert("imooc_cate",$arr);
    if($res == null){
        echo "res = null<br/>";
    }
    $pid = getInsertID();
    echo "<br/>res=".$res.""."<br/>";
    echo "<br/>pid="."".$pid."<br/>";
?>