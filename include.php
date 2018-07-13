<?php
    session_start();
    header("content-type:text/html;charset=utf-8");
    define("ROOT",dirname(__FILE__));
    define("LIB_PATH","/lib");
    define("CORE_PATH","/core");
    define("CONFIGS_PATH","/configs");

//    echo "get_include_path = ".get_include_path()."<br/>";
    set_include_path(ROOT);
//    echo "get_include_path = ".get_include_path()."<br/>";
    //echo "root = ".ROOT."<br/>";
//    set_include_path(".".PATH_SEPARATOR.ROOT.LIB_PATH.
//                                        PATH_SEPARATOR.ROOT.CORE_PATH.
//                                        PATH_SEPARATOR.ROOT.CONFIGS_PATH.
//                                        PATH_SEPARATOR.get_include_path()
//                                        );
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".
    PATH_SEPARATOR.ROOT."/core".
    PATH_SEPARATOR.ROOT."/configs".
    PATH_SEPARATOR.get_include_path());

    require_once 'string_func.php';
    require_once 'image_func.php';
    require_once 'common_func.php';
    require_once 'page_func.php';
    require_once "configs.php";
    require_once 'mysql_func.php';
    require_once 'admin_inc.php';
    require_once 'cate_inc.php';

//    echo "get_include_path = ".get_include_path()."<br/>";
?>