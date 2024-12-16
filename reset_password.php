<?php 
ob_start();
session_start();

?> 
<!DOCTYPE html>
<html lang="en">
<head>
        <!-- WALA PANG CSS -->
        <title>Library Management System</title>
        <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/x-icon" href="VcmLogo.png">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_GET['id'])) {
    $user_id = $_GET['id']; 
?>
    <form method="POST" action="reset_password.php">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_password">Enter New Password:</label>
        <input type="password" name="new_password" id="new_password" required>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
<?php
}
?>
<?php
if (isset($_POST['reset_password'])) {
    $user_id = $_POST['id']; 
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // connect db
    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($new_password === $confirm_password) {
        // code line para maupdate yung password sa db.
        $query = "UPDATE users SET password = '$new_password' WHERE id = $user_id";

        if (mysqli_query($connection, $query)) {
            // kapag success
            echo "<script>
                    alert('Password reset successful! Redirecting to login..');
                    window.location.href = 'index.php';
                  </script>";
                sleep(2);
                exit();
        } else {
            echo "<script>alert('Failed to reset password. Please try again.');</script>";
        }
    } else {
        // punta dito kapag di pareho password
        echo "<script>alert('Passwords do not match. Please try again.');
        window.location.href = 'forgot_password.php'; 
        </script>";
    }

    mysqli_close($connection);
}
?>
</body>
</html>
<?php ob_end_flush(); ?>
