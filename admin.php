<?php
    // 寫後台

    require('conn.php');
    session_start();
    $username = NULL;

    if(!empty($_SESSION['username'])){
        $username = $_SESSION['username'];
    } else {
        header('Location: ./index.php');
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
        "WHERE U.username = ? ".
        "AND A.is_deleted is NULL ".
        "ORDER BY article_id DESC";


        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $result = $stmt->execute();

        if(!$result){
            die('error: ' . $conn->error);
        }

        $result = $stmt->get_result();
?>

<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="./admin.css">
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
                    <a href='./login.php'><span>登入</span></a> 
                <? } ?>
                <?php if($username != NULL) {?>
                    <a href='./article_add.php'><span>新增文章</span></a>
                    <a href='./admin.php'><span>管理後台</span></a>
                    <a href='./handle_logout.php'><span>登出</span></a>
                <? } ?>
            </div>
        </div>
    </nav>
   
    <section id='admin'>
        <h2>管理文章</h2>
        <div class="article-list">
            <?php while($row = $result->fetch_assoc()){?>
                <a href="./page.php?article_id=<?=htmlspecialchars($row['article_id'])?>">   
                    <div class="article">
                        <div class="article-card">
                            <div class="left">
                                <h3><?=htmlspecialchars($row['title'])?></h3>
                            </div>
                            <div class="right">
                                <div class="article-create-at"><?=htmlspecialchars($row['create_at'])?></div>
                                <a href='article_edit.php?article_id=<?=htmlspecialchars($row['article_id'])?>'><div class="article-btn">編輯</div></a>
                                <a href="handle_article_delete.php?article_id=<?=htmlspecialchars($row['article_id'])?>"><div class="article-btn">刪除</div></a>
                            </div>
                        </div>
                        <hr>
                    </div>
                </a>
            <?php }?>
        </div>
            
    </section>
    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>

