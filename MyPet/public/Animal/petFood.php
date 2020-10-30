<?php
// 获取喂食的宠物id
$id = $_POST['Fid'];
$pethealth = $_POST['pethealth'];
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');
// 修改健康值
(int)$pethealth += (int)5;
$sql = "UPDATE userandpet set `pethealth` = '$pethealth' WHERE id ='$id'";
$pdo->exec($sql);
echo "隔，Master，我吃饱了";