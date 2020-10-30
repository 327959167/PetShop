<?php
// 引入外部文件
function autoload($class)
{
    include $class . ".php";
}
spl_autoload_register("autoload");

// 获取login表单的username、password
$username = $_POST["username"];
$password = $_POST["password"];
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
// 防止中文乱码
$pdo->exec('set names utf8');
// 查询所有用户名和密码
$sql = "select * from userinfo where username = '$username' and password = '$password' ";
// 输出结果到数组$rows
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// 循环遍历结果
foreach ($rows as $row) {
    if ($row['username'] == $username && $row['password'] == $password) {
        $name = $row['name'];
        $money = $row['money'];
        $master = new Master($name, $money, $username, $password);
        session_start();
        $_SESSION["master"] = $master;
        $flag = true;
    } else {
        $flag = false;
    }
    echo $flag;
}
// 关闭连接
$pdoMysql->closeCon($pdo);