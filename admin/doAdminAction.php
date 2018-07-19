<?php
require_once '../include.php';
$act = $_REQUEST['act'];
if($act == "logout"){
    logout();
}else if($act == "addAdmin"){
    $mes = addAdmin();
}else if($act == "editAdmin"){
    $id = $_REQUEST['id'];
    $mes = editAdmin($id);
}else if($act == "delAdmin"){
    $id = $_REQUEST['id'];
//    echo $id;
    $mes = delAdmin($id);
}else if($act == "addCate"){
    $mes = addCate();
}else if($act == "editCate"){
    $id = $_REQUEST['id'];
    $mes = editCate($id);
}else if($act == "delCate"){
    $id = $_REQUEST['id'];
    $mes = delCate($id);
}else if($act == "addPro"){
    $mes = addPro();
}else if($act == "editPro"){
    $id = $_REQUEST['id'];
    $mes = editPro($id);
}else if($act == "delPro"){
    $id = $_REQUEST['id'];
    $mes = delPro($id);
}else if($act == "addUser"){
    $mes = addUser();
}else if($act == "editUser"){
    $id = $_REQUEST['id'];
    $mes = editUser($id);
}else if($act == "delUser"){
    $id = $_REQUEST['id'];
    $mes = delUser($id);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<?php
if($mes){
    echo $mes;
}
?>
</body>
</html>
