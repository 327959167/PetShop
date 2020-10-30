<?php
// header("Content-type:text/html;charset=utf-8");
// 解决中文乱码
// header("Content-type:text/html;charset=utf-8");
// 保持格式
// echo "<pre>";
// 数据库连接
// $server = "localhost";
// $username = "root";
// $password = "123456";
// $database = "petshop";
// 创建连接
// $conn = new mysqli($server, $username, $password, $database);
// 解决中文乱码
// mysqli_query($conn, 'set names utf8');
// 检测连接
// if ($conn) {
//     echo "连接成功";
// } else {
//     echo "连接失败";
// }

// 查询
// $result = mysqli_query($conn, "select * from pet");
// var_dump($res);

// 判断
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         // echo "id:" . $row["id"] . "name" . $row["name"] . "type" . $row["type"] . "<br>";
//     }
// }

// while ($row = mysqli_fetch_array($result)) {
//     echo $row["id"] . " " . $row["name"];
//     echo "<br>";
// }
// mysqli_close($conn);

//pdoMysqlMysql.php文件: 创建连接、关闭连接
// class pdoMysql
// {
//     function getConnection()
//     { //建立连接
//         try { //可能发生异常的代码
//             $pdo = new PDO("mysql:host=localhost;dbname=petshop", "root", "123456");
//             return $pdo;
//         } catch (Exception $e) { //处理异常
//             echo "数据库连接失败" . $e->getMessage();
//             return;
//         }
//     }
//     function query($sql, $pdo)
//     {
//         $result = $pdo->query($sql);
//         $row = $result->fetch();
//         return $row;
//     }
//     function closeCon($pdo)
//     { //关闭数据库连接
//         if (!empty($pdo)) {
//             $pdo = null;
//         }
//     }
// }

// $pdo = new PDO("mysql:host=localhost;dbname=petshop", "root", "123456");
// $pdo->exec('set names utf8');
// $sql = "select * from userinfo where username = '黄敏' and password = '654321' ";
// $row = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// implode($row['username']);

// foreach ($row as $aa) {
//     if (implode($aa) == 123456) {
//         echo implode($aa);
//     }
// }

// $db = null;