<?php
// 引入外部文件，用于获取当前用户的username，以便匹配数据库相应用户
function autoload($class)
{
    include "../MyPetPHP/" . $class . ".php";
}
spl_autoload_register("autoload");

// 获取前台传递的动物name，price
$id = $_POST["id"];
$price = $_POST["price"];
// 获取master的username值
session_start();
$master = $_SESSION['master'];
$username = $_SESSION['nnmm'];
// $username = $master->username;
// 连接数据库
include '../Modelconnect/pdoConn.php';
$pdoMysql = new pdoMysql();
$pdo = $pdoMysql->getConnection();
$pdo->exec('set names utf8');
// 数据库查询对应用户
$Msql = "select * from userinfo where username='$username'";
$row = $pdo->query($Msql);
foreach ($row as $rows) {
    // 判断用户余额是否大于宠物价格
    if ($rows['money'] >= $price) {
        // 1.将领养的动物状态改为1
        $sql = "UPDATE  petshop.pet SET  `status` =  '1' WHERE  pet.`id` = $id";
        $gomysql = $pdo->exec($sql);

        // 2.减去用户的金钱
        $money = $rows['money'] - $price;
        $sqlM = "UPDATE  petshop.userinfo SET  `money` =  $money where username='$username'";
        $pdo->exec($sqlM);

        // 3.将领养的动物添加加用户宠物表里
        // username、pid领养宠物、pettype宠物类型--attribute、petage、petsex、pethealth、petFavorability
        $sqlAni = "select * from pet where id = '$id'";
        $resAni = $pdo->prepare($sqlAni); //准备查询语句
        $resAni->execute();
        $Anirow = $resAni->fetch(PDO::FETCH_ASSOC);
        // 向petanduser插入数据
        $petuser = $username;
        $petid = $Anirow['id'];
        $pettype = $Anirow['attribute'];
        $petage = $Anirow['age'];
        $petsex = $Anirow['sex'];
        $pethealth = $Anirow['health'];
        $petFavorability = $Anirow['Favorability'];

        $sqlpet = "INSERT INTO userandpet (id,username, pid, pettype, petage, petsex, pethealth, petFavorability) VALUES ('$id','$petuser', '$petid','$pettype','$petage','$petsex','$pethealth','$petFavorability')";

        $pdo->exec($sqlpet);
        // 输出领养结果
        if ($gomysql) {
            echo "领养成功！";
        } else {
            echo "领养失败！";
        }
    } else {
        echo "领养失败，余额不足！";
    }
}
// 关闭连接
$pdoMysql->closeCon($pdo);