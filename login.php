<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://i.pinimg.com/originals/bb/f3/99/bbf399ef3eb7649b9cc2b69656b574af.gif');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .login-container h2 {
            text-align: center;
        }

        .login-container form {
            margin-top: 20px;
        }

        .login-container .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container .logo img {
            max-width: 50%; /* Lebar maksimum logo */
            max-height: 100px; /* Tinggi maksimum logo */
        }

        .login-container p {
            margin-top: 10px;
            text-align: center;
        }

        .login-container a {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="login-container">
                    <div class="logo">
                        <img src="../ems/img/logoo.png" alt="Logo">
                    </div>
                    <h2>Login</h2>
                    <form method="post" action="proses_login.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                    <p>Lupa password? <a href="forgot_password.php">Reset password</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
