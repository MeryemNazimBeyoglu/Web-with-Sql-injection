<?php
    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $db_username = "vulnerable_user";
    $db_password = "vulnerable_password";
    $dbname = "vulnerable_db";

    // POST ile gelen verileri al
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Veritabanı bağlantısını oluştur
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Bağlantı kontrolü
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Giriş formundan gelen verileri almak için
        $username = $_POST['username'];
        $password = $_POST['password'];

        // SQL sorgusunu hazırla (Vulnerability : Bypassing Login with SQL Injection)
        $sql1 = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

        // Sorguyu çalıştır ve sonucu al ( zafiyet )
        $result1 = $conn->query($sql1);

        // Kullanıcı adı ve şifre doğruysa başarılı mesajı göster
        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            echo '<div class="message success">Hoş geldiniz, ' . htmlspecialchars($row["username"]) . '!</div>';
        } else {
            echo '<div class="message error">Geçersiz kullanıcı adı veya şifre.</div>';
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
    }
    ?>
</div>