<?php
$id = $_POST['pid'];
$petname = $_POST['petname'];
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');
// 修改姓名
$sql = "UPDATE userandpet set `petname` = '$petname' WHERE id ='$id'";
$pdo->exec($sql);
echo  $id . $petname;