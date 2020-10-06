<?php
    require('conn.php');
    session_start();

    if(empty($_POST['username']) || empty($_POST['password'])) {
        header('Location: ./login.php?errMsg=1');
        exit();
    } else {


        $username = $_POST['username'];
        



        $sql = "SELECT * FROM rock070_blog_users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);

        $result = $stmt->execute();

        if(!$result){
            die('error: ' . $conn->error);
        }
        
        $result = $stmt->get_result();

        if($result->num_rows < 1) {
            header('Location: ./login.php?errMsg=2');
            exit();
        }

        $row = $result->fetch_assoc();
        $password_hash = $row['password'];

        $is_password = password_verify($_POST['password'], $password_hash);

        if($is_password) {
            $_SESSION['username'] = $username;
            header('Location: ./index.php');
        } else {
            header('Location: ./login.php?errMsg=2');
        }



       

        
    }


?>
