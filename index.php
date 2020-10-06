<?php
    // 大頭照設計

    require('conn.php');
    require('utilities.php');
    session_start();
    $username = NULL;
    
    if(!empty($_SESSION['username'])){
        $username = $_SESSION['username'];
        $user = getUserInfos($username);
        $nickname = $user['nickname'];
    }
    

    if(!empty($_GET['Msg'])) {
        if($_GET['Msg'] === '1') {
            echo "<script> alert('註冊成功！') </script>";
        }
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
        "WHERE A.is_deleted is NULL ".
        "ORDER BY article_id desc ".
        "limit 5";


        $stmt = $conn->prepare($sql);

        $result = $stmt->execute();

        if(!$result){
            die('error: ' . $conn->error);
        }

        $result = $stmt->get_result();
?>

<html>
<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
    <link rel="stylesheet" href="./index.css">
    <title>AboutMe部落格</title>
</head>
<body>
    <nav>
        
        <div class="nav">
            <div class="nav-left">
                <a href='./index.php'><h2>About Me</h2></a>
                <a href='./article_list.php?page=1'><span>文章列表</span></a>
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
                    <a href='./article_add.php'><span>新增文章</span></a>
                    <a href='./admin.php'><span>管理後台</span></a>
                    <a href='./handle_logout.php'><span>登出</span></a>
                    <a href='./admin.php'><span style='color: black; font-weight: bold; font-size: 20px;'><?=$user['nickname']?></span></a>
                <? } ?>
            </div>
        </div>
    </nav>
    <header>
        <div class="img">
            <h3>about Me</h3>
            <h4>Publish and share story about life</h4>
            <?php if($username == NULL) {?>
                <a href='./register.php'><span>Get started</span></a>
            <? } ?>
        </div>
    </header>
    <section id='body'>


        <section id='articles'>
            <div class="article-list">
                <h3 style="left: 6%;">Latest Five on AboutMe</h3>
                <hr style="width: 88%; ">
                <?php while($row = $result->fetch_assoc()) { ?>
                    
                    <a href="./page.php?article_id=<?= htmlspecialchars($row['article_id'])?>">
                        <div class="article">
                            <div class="article-type"><?=htmlspecialchars($row['type'])?></div>
                            <div class="article-title"><?=htmlspecialchars($row['title'])?></div>
                            <div class="article-content">
                                <?=
                                ((mb_strlen($row['content'],'utf8') > 41) ? mb_substr($row['content'], 0, 41, 'utf8') : $row['content']).((mb_strlen($row['content'],'utf8') > 41) ? " ..." : "")
                                ?>
                            </div>
                            <div class="article-host"><?=htmlspecialchars($row['nickname'])?></div>
                            <div class="article-create-at"><?=htmlspecialchars($row['create_at'])?></div>
                            <hr>
                        </div>
                        </a>
                <?php }?>
            </div>
        </section>
        <section id="popular-article">
            <h3>Popular on AboutMe</h3>
            <hr>
            <div class="popular-article-list">
                <div class="popular-article">
                    <div class="popular-article-id">01</div>
                    <div class="popular-article-infos">
                        <div class="popular-article-title">台南之旅心得</div>
                        <div class="popular-article-host">Rock Wang</div>
                        <div class="popular-article-create-at">2010/12/02 10:20:10</div>
                    </div>
                    
                </div>

                <div class="popular-article">
                    <div class="popular-article-id">01</div>
                    <div class="popular-article-infos">
                        <div class="popular-article-title">台南之旅心得</div>
                        <div class="popular-article-host">Rock Wang</div>
                        <div class="popular-article-create-at">2010/12/02 10:20:10</div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>

