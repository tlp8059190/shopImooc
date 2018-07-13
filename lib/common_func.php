<?php
    function alertMes($mes,$url){
        echo "<script>alert('{$mes}');window.location.href= '{$url}';</script>";
//        echo "<script>alert('{$mes}');</script>";
//        echo "window.location= '{$url}';</script>";
    }
?>