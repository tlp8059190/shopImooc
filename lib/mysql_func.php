<?php

/**
 * 连接数据库
 * @return resource
 */
function connect()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD) or
    die("连接失败Error:" . mysqli_connect_errno() . ":" . mysqli_connect_error());
    mysqli_set_charset($link, DB_CHARSET);
    mysqli_select_db($link, DB_DBNAME) or die("指定数据库打开失败！");
    return $link;
}

/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table, $array)
{
    $link = connect();
    $keys = join(",", array_keys($array));
    $values = "'" . join("','", array_values($array)) . "'";
    $sql = "insert into {$table} ($keys) value ({$values})";
//    echo $sql . "<br/>";
    $result = mysqli_query($link, $sql);
    if ($result) {
//        echo "~~insert success！<br/>";
        return true;
    } else {
        echo "~~插入数据失败！<br/>";
        return false;
    }
}

/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table, $array, $where = null)
{
    $link = connect();
    $str = "";
    foreach ($array as $key => $val) {
        if (empty($str)) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
//    echo "str :" . $str . "<br/>";
//    echo "sep :" . $sep . "<br/>";
    if ($where == null) {
        $sql = "update {$table} set {$str}";
    } else {
        $sql = "update {$table} set {$str} where {$where}";
    }
//    echo "$sql <br/>";
//    echo "{$sql}aaaa <br/>";
    $result = mysqli_query($link, $sql);
    if ($result) {
//        echo "~~update success！<br/>";
        return true;
    } else {
        echo "~~更新数据失败！<br/>";
        return false;
    }
}

/**
 *    删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table, $where = null)
{
    $link = connect();
    $sql = "delete from {$table} ";
    if ($where != null) {
        $sql .= " where {$where} ";
    }
//    echo "$sql <br/>";
//    echo "{$sql}aaaa <br/>";
    $result = mysqli_query($link, $sql);
    if ($result) {
//        echo "~~delete success！<br/>";
        return true;
    } else {
        echo "~~删除数据失败！<br/>";
        return false;
    }
}
/**
 * 得到结果集中所有记录 ...
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql, $resultType = MYSQLI_ASSOC)
{
    $link = connect();
    $result = mysqli_query($link, $sql);
//    echo "result:<br/>";
//    print_r($result);
//    echo "<br/>";
    if($result && mysqli_num_rows($result)){
        while($row = mysqli_fetch_array($result,$resultType)){
            $rows[] = $row;
        }
    }else{
        $rows[] = array();
    }
//    echo "rows:<br/>";
//    print_r($rows);
//    echo "<br/>";
    return $rows;
}

/**
 *得到指定一条记录 //第一条
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchOne($sql, $resultType = MYSQLI_ASSOC)
{
    $link = connect();
    $result = mysqli_query($link, $sql);
//    echo "result:<br/>";
//    print_r($result);
//    echo "<br/>";
//    if(!$result){
//        printf("Error: %s\n", mysqli_error($link));
//        exit();
//    }
    $row = mysqli_fetch_array($result,$resultType);
//    echo "row:<br/>";
//    print_r($row);
//    echo "<br/>";
    return $row;
}

/**
* 得到结果集中的记录条数
* @param unknown_type $sql
* @return number
*/
function getResultNum($sql){
    $link = connect();
    $result = mysqli_query($link,$sql);
    $num = mysqli_num_rows($result);
//    echo "num :<br/> {$num} <br/>";
    return $num;
}

/**
* 得到上一步插入记录的ID号
* @return number
*/
function getInsertID(){
    $link = connect();
    $tmpID = mysqli_insert_id($link);
//    echo "id :<br/> {$tmpID} <br/>";
    return $tmpID;
}



/***************   test   *****************/
//    connect();
//
//    $mtable = 'imooc_album';
//    $data = array("pid"=>"5","albumPath"=>"/lib/...");
//    insert($mtable ,$data);

//    $mtable = 'imooc_album';
//    $data = array("pid"=>"153","albumPath"=>"/lib/1233/...");
//    $mwhere = "id = 3";
//    update($mtable, $data, $mwhere);

//    $mtable = 'imooc_album';
//    $mwhere = "id = 22";
//    delete($mtable, $mwhere);
//    delete($mtable);

//    $mtable = 'imooc_album';
//    $msql = "select * from {$mtable}";
//    fetchAll($msql,MYSQLI_NUM);

//    $mtable = 'imooc_album';
//    $msql = "select * from {$mtable}";
//    fetchOne($msql,MYSQLI_NUM);

//    $mtable = 'imooc_album';
//    $msql = "select * from {$mtable}";
//    getResultNum($msql);

//    getInsertID();

?>