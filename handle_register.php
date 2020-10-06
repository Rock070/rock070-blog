<?php
    require('conn.php');
    session_start();

    if(empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password-2'])){
        header('Location: ./register.php?errMsg=1');
        exit();
    } else {

        if($_POST['password'] !== $_POST['password-2']) {
            header('Location: ./register.php?errMsg=2');
            exit();
        }

        $nickname = $_POST['nickname'];
        $username = $_POST['username'];
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT username FROM rock070_blog_users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $result = $stmt->execute();

        if(!$result){
            
            die('error: ' . $conn->error);
        }
        
        $result = $stmt->get_result();

        $sql = "INSERT INTO rock070_blog_users (nickname, username, password) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('sss', $nickname, $username, $password);
        $result = $stmt->execute();

        if(!$result){
            if($conn->errno == 1062) {
                header('Location: ./register.php?errMsg=3');
                exit();
            }
            die('error: ' . $conn->error);
        }
       

        $_SESSION['username'] = $username;

        header('Location: ./index.php?Msg=1');

        
    }

?>
