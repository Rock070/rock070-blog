<?php
    require('conn.php');
    

   if(!empty($_GET['errMsg'])){
       if($_GET['errMsg'] === '1') {
            echo "<script>alert('請填寫完整資料！')</script>";
       }
       if($_GET['errMsg'] === '2') {
            echo "<script>alert('兩次密碼不相同！')</script>";
        }

        if($_GET['errMsg'] === '3') {
            echo "<script>alert('此帳號已被註冊！')</script>";
        }

   }
?>

<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="./register.css">
    <title>AboutMe部落格</title>

</head>
<body>
    <nav>
        <div class="nav">
            <div class="nav-left">
                <a href='./index.php'><h2>About Me</h2></a>
               <a href='./index.php'><span>文章列表</span></a>
               <a href='./index.php'><span>分類專區</span></a>
               <a href='./index.php'><span>關於我</span></a>
            </div>
            <div class="nav-right">
               <a href='./index.php'><span>管理後台</span></a>
               <a href='./login.php'><span>登入</span></a>
            </div>
        </div>
    </nav>
    <section id="register">
        <h3>註冊</h3>
        <form action="handle_register.php" method='POST'>
            
                <div class="nickname">
                    <label for="nickname">名稱：</label>
                    <input type="text" name='nickname' id='nickname'>
                </div>
                <div class="usernamename"> 
                    <label for="username">帳號：</label>
                    <input type="text" name='username' id='username'> 
                </div>
                <div class="passwordname">  
                    <label for="password">密碼：</label>
                    <input type="password" name='password' id='password'>
                </div>
                <div class="password-2"> 
                    <label for="password-2">再輸入一次密碼：</label>
                    <input type="password" name='password-2' id='password-2'>
                </div>
               
               
                
                <input type="submit" class='btn-submit'>


        </form>
    </section>
    
    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>