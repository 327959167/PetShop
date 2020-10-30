 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>myHome</title>
     <script src="../../js/jquery-3.4.1.min.js"></script>
     <script src="../../bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/myhome.css">
 </head>

 <body>
     <div class="container" id="play">
         <div class="form">
             <div class="form-group">
                 <label>为你的爱宠取个名字吧٩(๑>◡<๑)۶<span></span>
                 </label> <input type="text" class="form-control petname" placeholder="Please enter the pet name"
                     name="pname">
             </div>
             <button class="btn btn-success" id="sure">确定</button>
             <button class="btn btn-warning" id="cancle">取消</button>
         </div>
     </div>
     <?php
        // 引入外部文件
        function autoload($class)
        {
            include "../MyPetPHP/" . $class . ".php";
        }
        spl_autoload_register("autoload");

        session_start();
        $master = $_SESSION["master"];
        $username = $_SESSION["nnmm"];

        include '../Modelconnect/pdoConn.php';
        $pdoMysql = new pdoMysql();
        $pdo = $pdoMysql->getConnection();
        $pdo->exec('set names utf8');

        $sqlUser = "select * from userinfo where username='$username'";
        $res = $pdo->prepare($sqlUser); //准备查询语句
        $res->execute();
        $userrow = $res->fetch(PDO::FETCH_ASSOC);
        ?>
     <div class="container box">
         <nav class="navbar navbar-default" id="navtop">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                         data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                     </button>
                     <a class="navbar-brand" style="color: #fff;">柚乐趣宠物店</a>
                 </div>

                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <span id="MyPet">
                         <label>我的宠物</label>
                     </span>

                     <ul class="nav navbar-nav navbar-right">
                         <li><img src="../../images/bird.jpg" id="userJpg"></li>
                         <li class="dropdown" id="dropd">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                 aria-haspopup="true" aria-expanded="false" style="color: black;font-size:18px;">
                                 <?php echo $username ?> <span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                 <li><a href="javascript:people('<?php echo $username ?>')">个人详情页</a></li>
                                 <li><a href="javascript:topup('<?php echo $username ?>')">余额详情页</a></li>
                                 <li role="separator" class="divider"></li>
                                 <li><a href="../login.html">退出登录</a></li>
                             </ul>
                         </li>
                     </ul>
                 </div>
             </div>
         </nav>

         <table class="table table-striped table-bordered">
             <thead>
                 <tr class="success">
                     <td>名字</td>
                     <td>类型</td>
                     <td>性别</td>
                     <td>年龄</td>
                     <td>健康值</td>
                     <td>好感度</td>
                     <td>操作</td>
                 </tr>
             </thead>
             <!-- 商品展示列表 -->
             <tbody class="tbody table-hover">
                 <?php
                    $sql = "select * from userandpet where username='$username'";
                    $row = $pdo->query($sql);
                    foreach ($row as $rows) {
                        echo "<tr>";
                        echo "<td>" . $rows['petname'] . "</td>";
                        echo "<td>" . $rows['pettype'] . "</td>";
                        echo "<td>" . $rows['petsex'] . "</td>";
                        echo "<td>" . $rows['petage'] . "</td>";
                        echo "<td>" . $rows['pethealth'] . "</td>";
                        echo "<td>" . $rows['petFavorability'] . "</td>";
                        echo "<td>
                                <a class='btn btn-success btn-sm petName' href='javascript:petName(" . $rows['pid'] . ")'>取爱称<a>
                                <a class='btn btn-info btn-sm' href='javascript:petFood(" . $rows['pid'] . "," . $rows['pethealth'] . ")'>喂食<a>
                                <a class='btn btn-warning btn-sm'  href='javascript:petPlay(" . $rows['pid'] . "," . $rows['petFavorability'] . ")'>玩耍<a>
                             </td>";
                        echo "</tr>";
                    }
                    // 关闭连接
                    $pdoMysql->closeCon($pdo);
                    ?>
             </tbody>
         </table>
     </div>
     <script>
     var pid;
     // 遮罩层
     function petName(id) {
         pid = id;
         $('#play').show();
     }
     $('#cancle').click(function() {
         $('#play').hide();

     });
     // 确定改名
     $('#sure').click(function() {
         var petname = $("input[name = 'pname']").val();
         var ppid = parseInt(pid);
         $.ajax({
             type: 'post',
             url: '../Animal/inserName.php',
             data: {
                 petname: petname,
                 pid: ppid,
             },
             success: function(responText) {
                 console.log(responText);
                 location.reload();
                 $('#play').hide();
             },
             error: function() {
                 alert('no');
             }
         });
     });
     // 喂食功能
     function petFood(id, pethealth) {
         var Fid = id;
         var pethealth = pethealth;
         var Fid = parseInt(Fid);
         var pethealth = parseInt(pethealth);
         $.ajax({
             type: 'post',
             url: '../Animal/petFood.php',
             data: {
                 Fid: Fid,
                 pethealth: pethealth
             },
             success: function(responText) {
                 alert(responText);
                 location.reload();
             },
             error: function() {
                 console.log('error!');
             }
         });
     }
     // 玩耍功能
     function petPlay(id, petFavorability) {
         var Fid = id;
         var petFavorability = petFavorability;
         var Fid = parseInt(Fid);
         var petFavorability = parseInt(petFavorability);
         $.ajax({
             type: 'post',
             url: '../Animal/petPlay.php',
             data: {
                 Fid: Fid,
                 petFavorability: petFavorability
             },
             success: function(responText) {
                 alert(responText);
                 location.reload();
             },
             error: function() {
                 console.log('error!');
             }
         });
     }
     // 余额充值
     function topup(username) {
         //  console.log(username);
         var username = username;
         $.ajax({
             type: 'get',
             url: '../MyHome/MyMoney.php',
             //  data: {
             //      username: username,
             //  },
             success: function(responText) {
                 window.location = "../MyHome/MyMoney.php?username=" + username;
                 //  console.log(responText);
             },
             error: function() {
                 console.log('error');
             }
         })
     }
     // 个人详情
     function people(username) {
         var username = username;
         $.ajax({
             type: 'post',
             url: '../MyHome/Personaldetails.php',
             success: function(responText) {
                 window.location = "../MyHome/Personaldetails.php?username=" + username;
                 //  console.log(responText);
             },
             error: function() {
                 console.log('error');
             }
         })
     }
     </script>
 </body>

 </html>