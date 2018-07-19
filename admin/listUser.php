<?php
require_once '../include.php';
$pageSize = 2;
$table = "imooc_user";
$totalPages = getTotalPages($pageSize,$table);
$page = getCurPage($totalPages);
$rows = getUserByPage($page, $pageSize);
//    print_r($rows);
//    echo "<br/>";
if(!$rows){
    alertMes("没有管理员，请先添加！","addUser.php");
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
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addUser()">
        </div>

    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="25%">用户名称</th>
            <th width="30%">用户邮箱</th>
            <th width="10%">是否激活</th>
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
                <td><?php echo $row['activeFlag']==0?"未激活":"激活"?></td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="editUser('<?php echo $row['id'];?>')">
                    <input type="button" value="删除" class="btn"  onclick="delUser(<?php echo $row['id']?>)"></td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
        <?php endforeach?>
        <!--            下面这个判断有问题-->
        <!--            --><?php //if( $rows > $pageSize):?>
        <tr>
            <td colspan = "5"><?php echo showPage($page,$totalPages)?></td>
        </tr>
        <!--            --><?php //endif?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">
    function editUser(id) {
        window.location = "editUser.php?id="+id;
    }
    function delUser(id) {
        window.location = "doAdminAction.php?act=delUser&id="+id;
    }
    function addUser(){
        window.location="addUser.php";
    }

</script>
</html>