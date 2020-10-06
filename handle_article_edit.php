<?php
    require('conn.php');
    require('utilities.php');


    session_start();
    $username = $_SESSION['username'];


    if(empty($_POST['edit-article-title']) || empty($_POST['edit-article-type']) || empty($_POST['editor1'])){
        header('Location: ./article_edit.php?errMsg=1');

    } 

        if(!empty($_GET['article_id'])) {
            $article_id = $_GET['article_id'];
        }

        $title = $_POST['edit-article-title'];
        $type = $_POST['edit-article-type'];
        $content = $_POST['editor1'];

        // 拿取使用者 id
        $user = getUserInfos($username) ;

        $sql = "UPDATE rock070_blog_articles SET title = ?,  content = ?, type = ? WHERE article_id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('ssss', $title, $content, $type , $article_id);

        $result = $stmt->execute();

        if(!$result){
            die('error: ' . $conn->error);
        }

            if($conn->affected_rows < 1) {
                header('Location: ./admin.php');
            }

            header('Location: ./admin.php');

        
    


?>
