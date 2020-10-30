<?php
include "../Modelconnect/pdoConn.php";
class Bird
{
    var $pdoMysql;  //获取连接、关闭连接对象

    function __construct()
    {
        $this->pdoMysql = new pdoMysql();
    }
    /**
     * 查询所有宠物信息
     */
    function selectAllPetType()
    {
        $pdo = $this->pdoMysql->getConnection();
        $result = $pdo->query("select * from pet");
        $this->pdoMysql->closeCon($pdo);
        return $result;
    }
}
// 数组缩影
// include '../Modelconnect/pdoConn.php';
//         $pdoMysql = new pdoMysql();
//         $pdo = $pdoMysql->getConnection();
//         $pdo->exec('set names utf8');



//         $sqlUser = "select * from userinfo where username='$username'";
//         $res = $pdo->prepare($sqlUser); //准备查询语句
//         $res->execute();
//         $userrow = $res->fetch(PDO::FETCH_ASSOC)