<?php
    require('conn.php');
    require('utilities.php');


    session_start();
    $username = $_SESSION['username'];

        if(!empty($_GET['article_id'])) {
            $article_id = $_GET['article_id'];
        }

        // 拿取使用者 id
        $user = getUserInfos($username) ;

        $sql = "UPDATE rock070_blog_articles SET is_deleted = 1 WHERE article_id= ? ";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $article_id);

        $result = $stmt->execute();

        if(!$result){
            die('error: ' . $conn->error);
        }

        header('Location: ./admin.php');

        
    


?>
