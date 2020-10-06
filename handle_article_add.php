<?php
    require('conn.php');
    require('utilities.php');
    session_start();
    
    if(!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header('Location: ./index.php');
    }

    if(empty($_POST['edit-article-title']) || empty($_POST['edit-article-type']) || empty($_POST['editor1'])){
        header('Location: ./article_add.php?errMsg=1');
    }
    $title = $_POST['edit-article-title'];
    $type = $_POST['edit-article-type'];
    $content = $_POST['editor1'];

    // 拿取使用者 id
    $user = getUserInfos($username) ;

    $sql = "INSERT INTO rock070_blog_articles (user_id, title, type, content) VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('dsss', $user['user_id'], $title, $type, $content);
    $result = $stmt->execute();

    if(!$result){
        die('error: ' . $conn->error);
    }

    header('Location: ./index.php');

        
    


?>
