<?php
    require('conn.php');
    require('utilities.php');
    session_start();
    $username = NULL;


    if(!empty($_GET['errMsg'])){
        if($_GET['errMsg'] === '1') {
            echo "<script>alert('標題、類型或留言輸入不完整！')</script>";
        }
    }

    if(!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = getUserInfos($username);
        $user_id = $user['user_id'];
        if(!empty($_GET['article_id'])){
            $article_id = $_GET['article_id'];
            $sql = "SELECT * FROM rock070_blog_articles WHERE article_id = ? AND user_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $article_id, $user_id);
            $result = $stmt->execute();

            if(!$result) {
                die('error: ' . $conn->error);
            }

            $result = $stmt->get_result();
            if($result->num_rows>0) {
                $row = $result->fetch_assoc();
            } else {
                header('Location: admin.php');
            }
            
        } else {
            header('Location: admin.php');
        }
    } else {
        header('Location: index.php');
    }
    
    

?>

<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="./article_edit.css">
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
               <a href='./index.php'><span>登出</span></a>
            </div>
        </div>
    </nav>

    <section id="edit-article">
        <h3>發表文章</h3>
        <?if($row) {?>
            <form action="./handle_article_edit.php?article_id=<?= $article_id?>" method='POST'>
                <input name='edit-article-title' type="text" value=<?=htmlspecialchars($row['title'])?>>
                <input name='edit-article-type' type="text" value=<?=htmlspecialchars($row['type'])?>>

                <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                <textarea name="editor1" value=<?=$row['content']?>></textarea>
                <script>CKEDITOR.replace("editor1");</script>

                <input type="submit">
            </form>
        <?}?>
    </section>
   
        
    <footer>
        <div class="footer-copyright">Copyright © 2020 AboutMe All Rights Reserved.</div>
    </footer>

    


</body>
</html>