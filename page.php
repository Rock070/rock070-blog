<?php
    require('conn.php');
    require('utilities.php');

    session_start();

    $username = NULL;

    if(!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = getUserInfos($username);
    }
    

    if(!empty($_GET['article_id'])) {
        $article_id = $_GET['article_id'];
    }

    $sql = 
    "SELECT ".
        "U.nickname as nickname, ".
        "A.article_id as article_id, ".
        "A.type as type, ".
        "A.title as title, ".
        "A.content as content, ".
        "A.create_at as create_at ".
    "from rock070_blog_articles as A ".
    "JOIN rock070_blog_users as U ".
    "ON A.user_id = U.user_id ".
    "WHERE article_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $article_id);
        $result = $stmt->execute();


        if(!$result){
            die('error: ' . $conn->error);
        }

        $result = $stmt->get_result();



?>

<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="./page.css">
    <title>AboutMe部落格</title>
</head>
<body>
    <nav>
        
        <div class="nav">
            <div class="nav-left">
                <a href='./index.php'><h2>About Me</h2></a>
                <a href='./index.php'><span>文章列表</span></a>
                <a href='./index.php'><span>分類專區</span></a>
               <?php if($username != NULL) {?>
                    <a href='./index.php'><span>關於我</span></a>
               <? } ?>
            </div>
            <div class="nav-right">
                <?php if($username == NULL) {?>
                    <a href='./register.php'><span>註冊</span></a>
                    <a href='./login.php'><span>登入</span></a>
                <? } ?>
                <?php if($username != NULL) {?>
                    <a href='./admin.php'><span>管理後台</span></a>
                    <a href='./handle_logout.php'><span>登出</span></a>
                    <a href='./admin.php'><span style='color: black; font-weight: bold; font-size: 24px;'><?=$user['nickname']?></span></a>
                <? } ?>
            </div>
        </div>
    </nav>
    <?php while($row = $result->fetch_assoc()) { ?>
        <header>
            
            <div class="img">
                <div class="article-infos">
                    <div class="article-title"><?= htmlspecialchars($row['title']) ?></div>
                    <div class="article-type"><?= htmlspecialchars($row['type']) ?></div>
                    <div>Posted by <span class="article-host"><?= htmlspecialchars($row['nickname']) ?></span> on <span class="article-create-at"><?= htmlspecialchars($row['create_at']) ?></span> </div>
                
                    
                </div>
            </div>
        </header>
            <section id='articles'>
                <div class="article-list">
                    <div class="article">
                        <!-- <button class='article-btn-edit'>編輯</button> -->
                        <div class="article-content"><?= $row['content'] ?>
                        </div>
                    
                    </div>
                
                </div>
            </section>
    <?php } ?>


    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>