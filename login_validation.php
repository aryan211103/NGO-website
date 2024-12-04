<?php

use function PHPSTORM_META\type;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = $_POST["email"];
    $login_password = $_POST["password"];

    // Validate and sanitize input
    $login_username = htmlspecialchars(trim($login_username));

    // Check user credentials against the database
    $servername = "127.0.0.1";
    $username_db = "root";
    $password_db = "";
    $dbname = "userdata";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $login_username);
        $stmt->bindParam(':password',$login_password);
        $stmt->execute();
        

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Verify password
            echo $user['password'];
            echo $login_password;
            echo gettype($login_password);
            echo gettype($user['password']);
            if ($user['password'] == $login_password) {
                // Password is correct, login successful
                session_start();
                $_SESSION['user'] = $user;
                echo "Login successful! Redirecting...";
                header('Location: donations.html');
                exit();
            } else {
                // Invalid password
                echo "Invalid password!";
            }
        } else {
            // User not found
            echo "User not found!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
