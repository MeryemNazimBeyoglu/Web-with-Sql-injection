<?php

    $servername = "localhost";
    $db_username = "vulnerable_user";
    $db_password = "vulnerable_password";
    $dbname = "vulnerable_db";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql1 = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

        
        $result1 = $conn->query($sql1);

        
        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            echo '<div class="message success">Hoş geldiniz, ' . htmlspecialchars($row["username"]) . '!</div>';
        } else {
            echo '<div class="message error">Geçersiz kullanıcı adı veya şifre.</div>';
        }

        $conn->close();
    }
    ?>
</div>
