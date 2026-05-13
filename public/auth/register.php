<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
</head>

<body>
    <?php
    require_once '../../config/Database.php';
    require_once '../../classes/Auth.php';

    $database = new Database();
    $conn = $database->getConnection();
    $auth = new Auth($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($auth->register($name, $email, $password)) {
            echo "Registration successful!";
        } else {
            echo "Email already registered.";
        }
    }
    ?>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br /><br />
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br /><br />
        <button type="submit">Register</button>
    </form>
</body>

</html>