<?php
// 要充值的用户id
$name = $_POST['name'];
$usermoney = $_POST['usermoney'];
$money = $_POST['money'];
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');

$money = $money + $usermoney;

$sql = "UPDATE  petshop.userinfo SET  `money` = '$money' where `name`='$name'";

$flag = $pdo->exec($sql);

if ($flag) {
    echo "充值成功啦！";
} else {
    echo '异常错误，充值失败，充值金额将在两个工作日内返还。';
}

// 关闭连接
$pdoMysql->closeCon($pdo);