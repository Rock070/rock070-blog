<?php
    require('conn.php');
    require('utilities.php');
    session_start();
    $username = NULL;



    if(!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = getUserInfos($username);
    } else {
        header('Location: ./index.php');
    }

    if(!empty($_GET['errMsg'])){
        if($_GET['errMsg'] === '1') {
            echo "<script>alert('標題、類型或留言輸入不完整！')</script>";
        }
    }


    

?>

<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="./article_add.css">
    <title>AboutMe部落格</title>
</head>
<body>
    <nav>
        <div class="nav">
            <div class="nav-left">
                <a href='./index.php'><h2>About Me</h2></a>
                <a href='./article_list.php'><span>文章列表</span></a>
                <a href='./index.php'><span>分類專區</span></a>
                <?php if($username != NULL) {?>
                    <a href='./index.php'><span>關於我</span></a>
                <? } ?>
            </div>
            <div class="nav-right">
                <?php if($username == NULL) {?>
                    <a href='./login.php'><span>登入</span></a> 
                <? } ?>
                <?php if($username != NULL) {?>
                    <a href='./article_add.php'><span>新增文章</span></a>
                    <a href='./admin.php'><span>管理後台</span></a>
                    <a href='./handle_logout.php'><span>登出</span></a>
                    <a href='./admin.php'><span style='color: black; font-weight: bold; font-size: 20px;'><?=$user['nickname']?></span></a>
                <? } ?>
            </div>
        </div>
    </nav>
    <section id="edit-article">
        <h3>發表文章</h3>
        <form action="./handle_article_add.php" method='POST'>
            <input name='edit-article-title' type="text" placeholder='請輸入文章標題'>
            <input name='edit-article-type' type="text" placeholder='請輸入文章分類'>

            <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
            <textarea name="editor1"></textarea>
            <script>CKEDITOR.replace("editor1");</script>

            <input type="submit">
        </form>
    </section>
   
        
    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>