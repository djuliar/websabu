<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: white;
            border-bottom: none;
            padding-top: 30px;
        }

        .logo-icon {
            font-size: 60px;
            color: #0d6efd;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-register {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
        }

        .card-footer {
            background: white;
            border-top: none;
        }
    </style>
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
            $_SESSION['success'] = "Registration successful!";
            header("Location: register2.php?success=1");
            exit();
        } else {
            $_SESSION['error'] = "Email already registered.";
            header("Location: register2.php?error=1");
            exit();
        }
    }
?>

    <div class="card register-card">

        <div class="card-header text-center">
            <i class="bi bi-person-circle logo-icon"></i>
            <h3 class="mt-3 fw-bold">Buat Akun</h3>
            <p class="text-muted">Silahkan daftar untuk melanjutkan</p>
        </div>

        <div class="card-body p-4">

            <!-- Alert -->
            <?php if(isset($_GET['success'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan password" required>

                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <i class="bi bi-eye" id="icon-password"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" required>

                    <label class="form-check-label">
                        Saya menyetujui syarat dan ketentuan
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-register">
                        <i class="bi bi-person-plus-fill"></i>
                        Daftar Sekarang
                    </button>
                </div>

            </form>

        </div>

        <div class="card-footer text-center pb-4">
            Sudah punya akun?
            <a href="login.php" class="text-decoration-none fw-semibold">
                Login disini
            </a>
        </div>

    </div>

    <script>
        function togglePassword() {
            let password = document.getElementById("password");
            let icon = document.getElementById("icon-password");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>

</body>

</html>