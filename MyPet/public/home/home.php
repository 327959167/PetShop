<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="../../css/home.css">
</head>

<body>
    <?php
    // 引入外部文件
    function autoload($class)
    {
        include "../MyPetPHP/" . $class . ".php";
    }
    spl_autoload_register("autoload");
    session_start();
    $master = $_SESSION['master'];
    $_SESSION['nnmm'] = $master->getUsername();

    ?>

    <div class="container box">
        <!-- 欢迎头部 -->
        <div class="header">
            <h1>柚乐趣宠物店</h1>
            <p>尊敬的<mark><?php echo $master->getName(); ?></mark>欢迎您光临宠物商店 φ(>ω<*) </p> <a
                        class="glyphicon glyphicon-home" id="myhome" href="../MyHome/myHome.php">我的宠物</a>
        </div>
        <!-- 商品展示 -->
        <div class="body">
            <ul>
                <li>
                    <h4><mark>狗狗</mark></h4>
                    <img src="../../images/dog1.jpg" alt="图片丢失">
                    <a class="btn btn-success" href="javascript:pet('狗')">狗狗详情</a>
                </li>
                <li>
                    <h4><mark>猫猫</mark></h4>
                    <img src="../../images/cat.jpg" alt="图片丢失">
                    <a class="btn btn-success" href="javascript:pet('猫')">猫猫详情</a>
                </li>
                <li>
                    <h4><mark>鸟儿</mark></h4>
                    <img src="../../images/bird.jpg" alt="图片丢失">
                    <a class="btn btn-success" href="javascript:pet('鸟')">鸟儿详情</a>
                </li>
                <li>
                    <h4><mark>羊驼</mark></h4>
                    <img src="../../images/house1.jpg" alt="图片丢失">
                    <a class="btn btn-success" href="javascript:pet('羊驼')">小马详情</a>
                </li>
            </ul>
        </div>
    </div>
    <script>
    function pet(txt) {
        window.location = "../Animal/pet.php?ptype=" + txt;
    }
    </script>
</body>

</html>