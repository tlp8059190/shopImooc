<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<form action="doAction.php" method="post" enctype="multipart/form-data">
<!--    <input type = "hidden" name = "MAX_FILE_SIZE" value = "512000">-->
<!--    请选择上传文件：<input type="file"  name="myFile"  accept = "image/jpeg,image/gif,image/png" /><br/>-->
<!--    单文件上传/多个单文件上传-->
    请选择上传文件：<input type="file"  name="myFile0"  /><br/>
    请选择上传文件：<input type="file"  name="myFile1"  /><br/>
<!--    请选择上传文件：<input type="file"  name="myFile2"  /><br/>-->
<!--    请选择上传文件：<input type="file"  name="myFile3"  /><br/>-->

<!--    多文件上传-->
    请选择上传文件：<input type="file"  name="myFile[]"  /><br/>
    请选择上传文件：<input type="file"  name="myFile[]"  /><br/>
<!--    请选择上传文件：<input type="file"  name="myFile[]"  /><br/>-->

    请选择上传文件：<input type="file"  name="myFile4"  /><br/>
    请选择上传文件：<input type="file"  name="myFile5"  /><br/>

    请选择上传文件：<input type="file"  name="myFile10[]"  /><br/>
    请选择上传文件：<input type="file"  name="myFile10[]"  /><br/>

    <input type="submit" value="上传"/>
</form>

</body>
</html>