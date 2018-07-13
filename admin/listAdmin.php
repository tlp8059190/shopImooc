<?php
    require_once '../include.php';

//    print_r($rows);
//    $rows = array();
    $pageSize = 2;
    $table = "imooc_admin";
    $totalPages = getTotalPages($pageSize,$table);
    $page = getCurPage($totalPages);
    $rows = getAdminByPage($page, $pageSize);
//    print_r($rows);
//    echo "<br/>";
    if(!$rows){
        alertMes("没有管理员，请先添加！","addAdmin.php");
        exit();
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
        </div>

    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="25%">管理员名称</th>
            <th width="30%">管理员邮箱</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach ($rows as $row):
            ?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['email']?></td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="editAdmin('<?php echo $row['id'];?>')">
                    <input type="button" value="删除" class="btn"  onclick="delAdmin(<?php echo $row['id']?>)"></td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <?php endforeach?>
<!--            下面这个判断有问题-->
<!--            --><?php //if( $rows > $pageSize):?>
            <tr>
                <td colspan = "4"><?php echo showPage($page,$totalPages)?></td>
            </tr>
<!--            --><?php //endif?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">
    function editAdmin(id) {
        window.location = "editAdmin.php?id="+id;
    }
    function delAdmin(id) {
        window.location = "doAdminAction.php?act=delAdmin&id="+id;
    }
    function addAdmin(){
        window.location="addAdmin.php";
    }

</script>
</html>