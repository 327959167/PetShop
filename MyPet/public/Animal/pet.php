<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>狗狗领养</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="../../css/dog.css">
</head>

<body>
    <div class="container box">
        <a class="glyphicon glyphicon-home" id="myhome" href="../MyHome/myHome.php">我的宠物</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <td>种属</td>
                    <td>类型</td>
                    <td>价格</td>
                    <td>性别</td>
                    <td>年龄</td>
                    <td colspan="2">操作</td>
                </tr>
            </thead>
            <!-- 商品展示列表 -->
            <tbody class="tbody">
                <!-- 显示数据到页面 -->
                <?php
                include '../Modelconnect/pdoConn.php';
                $pdoMysql = new pdoMysql();
                $pdo = $pdoMysql->getConnection();
                $pdo->exec('set names utf8');
                // 查询对应类型的宠物
                $pype = $_GET['ptype'];
                $sql = "select * from pet where type ='$pype'";
                $row = $pdo->query($sql);
                // 循环遍历生成tr
                foreach ($row as $rows) {
                    if ($rows["status"] == 0) {
                        echo "<tr>";
                        echo "<td>" . $rows["type"] . "</td>";
                        echo "<td>" . $rows["attribute"] . "</td>";
                        echo "<td>" . $rows["price"] . "<span>￥</span>" . "</td>";
                        echo "<td>" . $rows["sex"] . "</td>";
                        echo "<td>" . $rows["age"] . "</td>";
                        // 为领养事件传递该行数据的id和price
                        echo "<td><a class='btn btn-success btn-sm'
                            href='javascript:del(" . $rows["id"] . "," . $rows["price"] . ")'>领养<a></td>
                    </td>";
                        echo "</tr>";
                    }
                }
                // 关闭连接
                $pdoMysql->closeCon($pdo);
                ?>
            </tbody>
        </table>
    </div>
    <script>
    function del(id, price) {
        // 数据库状态值变为1，
        // console.log(id);
        // console.log(price);
        // 将对应要领养动物的id和price传给领养功能实现页面
        $.ajax({
            type: 'post',
            url: './delpet.php',
            data: {
                id: id,
                price: price
            },
            success: function(responseText) {
                // 返回结果，并刷新页面
                location.reload();
                alert(responseText);
            },
            error: function() {
                alert("失败");
            }
        })

    }
    </script>
</body>

</html>