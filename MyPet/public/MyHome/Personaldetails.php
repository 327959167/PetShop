<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人详情页</title>
    <link rel="stylesheet" type="text/css" href="../../font-awesome-4.7.0/css/font-awesome.min.css" />
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/Personal_details.css">
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
        <!-- 头像 -->
        <div class="UserPic">
            <img src="../../images/bird.jpg" alt="未上传头像">
        </div>
        <!-- 表单 -->
        <div class="formBox">
            <!-- 昵称 -->
            <div class="form-group">
                <label class="col-sm-1 control-label">昵称</label>
                <div class="col-sm-10 ">
                    <input type="text" class="form-control nickname" readonly
                        value="<?php echo $userrow['username'] ?>">
                </div>
            </div>
            <!-- 实名 -->
            <div class="form-group">
                <label class="col-sm-1 control-label">实名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control name" readonly value="<?php echo $userrow['name'] ?>">
                </div>
            </div>
            <!-- 密码 -->
            <div class="form-group">
                <label class="col-sm-1 control-label">密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control password" name="password" readonly
                        value="<?php echo $userrow['password'] ?>">
                </div>
                <label class="col-sm-1" id="fafa">
                    <i class="fa fa-eye-slash" aria-hidden="true" id="eye"></i>
                    <span class="tsk2"></span>
                </label>
            </div>
            <!-- 确认密码 -->
            <div class="form-group">
                <label class="col-sm-1 control-label">确认密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control passwordConfirm" name="passwordConfirm" readonly
                        placeholder="Please enter you confirm password">
                </div>
                <label class="col-sm-1" id="fafa">
                    <i class="fa fa-eye-slash" aria-hidden="true" id="eye2"></i>
                    <span class="tsk3"></span>
                </label>
            </div>
            <!-- 确认密码 -->
            <!-- 头像上传 -->
            <div class="form-group">
                <label class="col-sm-1 control-label">头像</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8 errorTxt">

                </div>
            </div>
            <!-- 按钮 -->
            <div class="form-group">
                <label class="col-sm-1 control-label"></label>
                <button class="btn btn-info" id="updata">修改</button>
                <button class="btn btn-info" id="cancle">取消</button>
                <input type="submit" class="btn btn-info" value="确定" id="sure">

            </div>
        </div>
    </div>
    <?php // 关闭连接
    $pdoMysql->closeCon($pdo); ?>

    <script>
    var password = document.querySelector('.password');
    var eye = document.getElementById('eye');
    var passwordConfirm = document.querySelector('.passwordConfirm');
    var eye2 = document.getElementById('eye2');
    //eye
    eye.onclick = function() {
        if (eye.className == "fa fa-eye-slash") {
            eye.className = "fa fa-eye";
            password.type = "text";
        } else {
            eye.className = "fa fa-eye-slash"
            password.type = "password";
        }
    }
    // eye2
    eye2.onclick = function() {
        if (eye2.className == "fa fa-eye-slash") {
            eye2.className = "fa fa-eye";
            passwordConfirm.type = "text";
        } else {
            eye2.className = "fa fa-eye-slash"
            passwordConfirm.type = "password";
        }
    }
    // 昵称
    $('.nickname').blur(function() {
        var nickname = $('.nickname').val();
        if (nickname.trim().length == 0) {
            $('.errorTxt').text('昵称不能为空！');
        } else if (nickname.trim().length > 12) {
            $('.errorTxt').text('昵称长度不能超过12位！');
            $('.nickname').val('');
        }
    });
    // 密码
    $('.password').blur(function() {
        var password = $('.password').val();
        if (password.trim().length == 0) {
            $('.errorTxt').text('密码不能为空！');
        } else if (password.trim().length < 6 || password.trim().length > 24) {
            $('.errorTxt').text('密码长度为6~24位！');
            $('.password').val('');
        }
    });
    // 确认密码
    $('.passwordConfirm').blur(function() {
        var passwordConfirm = $('.passwordConfirm').val();
        if (passwordConfirm.trim().length == 0) {
            $('.errorTxt').text('确认密码不能为空！');
        }
    });
    // 修改
    $("#updata").click(function() {
        $('.nickname').css({
            border: "2px solid red"
        });
        $('.password').css({
            border: "2px solid red"
        });
        $('.passwordConfirm').css({
            border: "2px solid red"
        });

        $(".nickname").attr("readOnly", false);
        $(".password").attr("readOnly", false);
        $(".passwordConfirm").attr("readOnly", false);
    });
    // 取消
    $("#cancle").click(function() {
        $('.nickname').css({
            border: "1px solid #ccc"
        });
        $('.password').css({
            border: "1px solid #ccc"
        });
        $('.passwordConfirm').css({
            border: "1px solid #ccc"
        });

        $(".nickname").attr("readOnly", true);
        $(".password").attr("readOnly", true);
        $(".passwordConfirm").attr("readOnly", true);

        $(".nickname").val("");
        $(".password").val("");
        $(".passwordConfirm").val("");

        location.reload();

    });
    // 确定
    $(function() {
        // 注册
        $('#sure').click(function() {
            // 取出实名，用于传值判断
            var name = $('.name').val();
            // 昵称
            var nickname = $('.nickname').val();
            // 密码
            var password = $('.password').val();
            // 确认密码
            var passwordConfirm = $('.passwordConfirm').val();


            // 密码验证
            if (password != passwordConfirm) {
                alert('确认密码与密码不一致！');
                $('.passwordConfirm').val("");
                return;
            }

            if (nickname.trim().length != 0 && password.trim()
                .length != 0 && passwordConfirm.trim().length != 0) {
                $.ajax({
                    type: 'post',
                    url: '../MyHome/peopleUpdata.php',
                    data: {
                        name: name,
                        nickname: nickname,
                        password: password,
                    },
                    success: function(responseText) {
                        if (responseText == "1") {
                            alert("修改成功！");
                            window.location = "../login.html";
                        } else {
                            alert("修改失败！");
                        }

                    },
                    error: function() {
                        alert("致命错误！！！");
                    }

                });
            } else {
                alert('请填写完整信息！');
            }

        });
    })
    </script>
</body>

</html>