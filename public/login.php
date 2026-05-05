<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    require_once '../config/Database.php';
    require_once '../classes/Auth.php';

    $db = new Database();
    $conn = $db->getConnection();
    $auth = new Auth($conn);

    // Proses login ketika form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Panggil method login
        if ($auth->login($email, $password)) {
            // Redirect jika berhasil
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username atau Password salah!";
            echo $error;
        }
    }
?>

    <form method="post">
    <input type="text" name="email" id="email" required>
    <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
</form>
</body>
</html>