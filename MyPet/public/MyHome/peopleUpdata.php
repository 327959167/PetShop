<?php
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$name = $_POST['name'];

include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');

// 判断是否相等
$sqlUser = "select * from userinfo where `name` ='$name'";
$res = $pdo->prepare($sqlUser); //准备查询语句
$res->execute();
$userrow = $res->fetch(PDO::FETCH_ASSOC);

if ($userrow['username'] == $nickname && $userrow['password'] == $password) {
    $flag = false;
} else {
    $sql = "UPDATE userinfo set username = '$nickname' WHERE `name` ='$name'";
    $slq1 = $pdo->exec($sql);

    $sql = "UPDATE userinfo set `password` = '$password' WHERE `name` ='$name'";
    $slq2 = $pdo->exec($sql);

    if ($slq1 || $slq2) {
        $flag = true;
    } else {
        $flag = false;
    }
}

echo $flag;

// 关闭连接
$pdoMysql->closeCon($pdo);