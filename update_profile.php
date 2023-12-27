<?php
include('session.php');

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($result);
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Tambahkan judul halaman dan tautan ke Bootstrap CSS -->
    <title>Update Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS khusus jika diperlukan -->
    <link rel="stylesheet" href="./CSS/update-profile.css"> <!-- Sesuaikan dengan path file CSS yang sesuai -->
</head>

<body>
    <!-- Tambahkan konten halaman di sini -->
    <div class="container mt-5">
        <h1>Update Profile</h1>

        <form action="process_update_profile.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php include 'index-layouts/footer.php'; ?>
