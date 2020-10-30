<?php
// 获取喂食的宠物id
$id = $_POST['Fid'];
$petFavorability = $_POST['petFavorability'];
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');
// 修改健康值
(int)$petFavorability += (int)3;
$sql = "UPDATE userandpet set `petFavorability` = '$petFavorability' WHERE id ='$id'";
$pdo->exec($sql);
echo "嘻嘻，主人和我玩耍了，开心鸭";