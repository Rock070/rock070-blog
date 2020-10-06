<?php
    require('conn.php');
    function getUserInfos($username) {
        global $conn;
        $sql = "SELECT * FROM rock070_blog_users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $result = $stmt->execute();

        if(!$result) {
            die('error: ' . $conn->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

?>  