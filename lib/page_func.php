<?php
    require_once '../include.php';

//    $pageSize = 2;
//    $totalPages = getTotalPages($pageSize);
////    $page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
//    $page = 2;
//    if($page < 1 || $page == null || !is_numeric($page)){
//        $page = 1;
//    }else if($page > $totalPages ){
//        $page = $totalPages;
//    }
//    $offset = ($page-1)*$pageSize;
//    $sql = "select * from imooc_admin limit {$offset},{$pageSize}";
//    $rows = fetchAll($sql);
//    print_r($rows);
//    echo "<br/>";
//    foreach($rows as $row){
//        echo "编号：".$row['id'],"<br/>";
//        echo "管理员的名称:".$row['username'],"<hr/>";
//    }
//    echo showPage($page,$totalPages,"cid=5");
function getTotalPages($pageSize = 2,$table){
    $sql = "select * from {$table}";
    $totalRows = getResultNum($sql);
//    echo "totalrows:".$totalRows."<br/>";
    $Pages = ceil($totalRows/$pageSize);
//    echo "totalpages:".$Pages."<br/>";
    return $Pages;
}

function getCurPage($totalPages){
    $page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
//    echo "page:".$page."<br/>";
    if ($page < 1 || $page == null || !is_numeric($page)) {
        $page = 1;
    } else if ($page > $totalPages) {
        $page = $totalPages;
    }
    return $page;
}

function showPage($page,$totalPages,$where=null,$sep="&nbsp;")
{
    if($where != null){
        $where = "&".$where;
    }
    $url = $_SERVER['PHP_SELF'];
//    echo $url;
    $first = ($page == 1) ? "首页" : "<a href = '{$url}?page=1{$where}'>首页</a>";
    $last = ($page == $totalPages) ? "尾页" : "<a href = '{$url}?page={$totalPages}{$where}'>尾页</a>";
    $prev = ($page <= 1) ? "上一页" : "<a href = '{$url}?page=" . ($page - 1) . "{$where}'>上一页</a>";
    $next = ($page >= $totalPages) ? "下一页" : "<a href = '{$url}?page=" . ($page + 1) . "{$where}'>下一页</a>";
    $str = "总共 {$totalPages} 页，当前第 {$page} 页";
    $p = "";
    for ($i = 1; $i <= $totalPages; $i++) {
        //当前页无链接
        if ($page == $i) {
            $p .= "[{$i}]";
        } else {
            $p .= "<a href = '{$url}?page={$i}'>[{$i}]</a>";
        }
    }
//    echo "<hr/>";
    $pageStr = $prev . $sep . $first . $sep . $sep . $p . $sep . $sep . $last . $sep . $next . $sep . $str;
    return $pageStr;
}

?>