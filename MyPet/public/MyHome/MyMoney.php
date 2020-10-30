<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>余额详情页</title>
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/MyMoney.css">
</head>

<body>
    <?php
    $username = $_GET['username'];

    include '../Modelconnect/pdoConn.php';
    $pdoMysql = new pdoMysql();
    $pdo = $pdoMysql->getConnection();
    $pdo->exec('set names utf8');

    $sqlUser = "select * from userinfo where username='$username'";
    $res = $pdo->prepare($sqlUser); //准备查询语句
    $res->execute();
    $userrow = $res->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container form-horizontal personBox">
        <p>是禅为你奏出了夏日的乐章，是猫为你抚慰了冬天的寂寞，是狗为你守候了温暖的家，是鸟为你装点了蔚蓝的天空，是动物为你谱写了最纯粹的友谊。世界动物日，一起关爱我们的朋友!</p>
        <!-- 用户名 -->
        <div class="form-group">
            <label class="col-sm-1 control-label">实名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control username" readonly value="<?php echo  $userrow['name'] ?>">
            </div>
        </div>
        <!-- 金钱余额 -->
        <div class="form-group">
            <label class="col-sm-1 control-label">我的余额</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control usermoney" readonly value="<?php echo  $userrow['money'] ?>">
            </div>
        </div>
        <!-- 金钱充值 -->
        <div class="form-group">
            <label class="col-sm-1 control-label">充值金额</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control topup" readonly placeholder="Please enter the number of recharge"
                    name="money">
            </div>
        </div>
        <!-- 按钮 -->
        <div class="form-group">
            <label class="col-sm-1 control-label"></label>
            <button class="btn btn-info" id="topup">我要充值</button>
            <button class="btn btn-info" id="cancle">取消</button>
            <input type="submit" class="btn btn-info" value="确定" id="sure">
        </div>
        <?php // 关闭连接
        $pdoMysql->closeCon($pdo); ?>

    </div>
    <script>
    $("#topup").click(function() {
        document.querySelector('.topup').style.border = "2px solid red";
        $(".topup").attr("readOnly", false);
    });
    $("#cancle").click(function() {
        document.querySelector('.topup').style.border = "1px solid #ccc";
        $(".topup").attr("readOnly", true);
        $(".topup").val("");
    });
    $("#sure").click(function() {
        // 用户充值的金钱数目
        var name = $('.username').val();
        var usermoney = $(".usermoney").val();
        var money = $(".topup").val();

        if (usermoney == "") {
            usermoney = 0;
        }

        if (money.trim().length != 0) {
            if (money > 0) {
                $.ajax({
                    type: 'post',
                    url: '../MyHome/moneypay.php',
                    data: {
                        name: name,
                        usermoney: usermoney,
                        money: money,
                    },
                    success: function(responText) {
                        alert(responText);
                        document.querySelector('.topup').style.border = "1px solid #ccc";
                        $(".topup").attr("readOnly", true);
                        $(".topup").val("");
                        location.reload();
                    },
                    error: function() {
                        console.log('error');
                    }
                })
            } else {
                alert('充值金额需大于0元！');
            }

        } else {
            alert('请填写充值金额！');
        }

    });
    </script>
</body>

</html>