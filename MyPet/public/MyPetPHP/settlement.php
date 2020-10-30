<?php
// 引入外部文件
function autoload($class)
{
    include $class . ".php";
}
spl_autoload_register("autoload");
// 获取存储在session的用户金钱信息
session_start();
$master = $_SESSION['master'];
// 获取ajax传来的数据
$id = $_POST["id"];
$type = $_POST["type"];
$price = $_POST["price"];
$sex = $_POST["sex"];
$age = $_POST["age"];
// 存储在animal类
$animal = new animal($id, "旺财", $type, $price, $sex, $age, 50, 80);
// 存储名字
$master->setPet($animal);
$_SESSION["master"] = $master;

// 判断金钱是否充足
if ($master->getMoney() > $price) {
    $flag = "true";
    // $master->money -= $price;
    // $_session['$master'] = $master;
} else {
    $flag = "false";
}
echo $flag;