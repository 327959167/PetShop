<?php
$nickname = $_POST['nickname'];
$username = $_POST['username'];
$password = $_POST['password'];



include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');

$sql = "insert into userinfo(username,password,name) values('$nickname','$password','$username')";
$pdo->exec($sql);
echo "注册成功！";
// 关闭连接
$pdoMysql->closeCon($pdo);