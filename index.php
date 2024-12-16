<?php 
ob_start();
session_start();
?>   
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styleIndex.css">
    <title>Library Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/x-icon" href="VcmLogo.png">
</head>

<body>
    <div class="container">
        <div class="square">
            <div class="vcmc">
                <img src="vcmc.png" alt="VCMC Logo">
            </div>

            <div class="square-inside">
                <div class="logo-container">
                    <img src="awit.png" alt="Logo">
                </div>
                <form method="POST">
                    <select name="role" class="form-control" onmouseover="showDropdown()" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-2">
                        <a href="forgot_password.php" class="signup">Forgot Password?</a>   
                    </div>
                    <button type="submit" name="login" class="login-button">LOGIN</button>
                </form>
                <?php
                if (isset($_POST['login'])) {
                    $connection = mysqli_connect("localhost", "root", "");

                    if (!$connection) {
                        echo("Database connection failed: " . mysqli_connect_error());
                    }

                    $db = mysqli_select_db($connection, "lms");
                    if (!$db) {
                        echo("Database selection failed: " + mysqli_error($connection));
                    }

                    $role = $_POST['role'];
                    $username = mysqli_real_escape_string($connection, $_POST['username']);
                    $password = mysqli_real_escape_string($connection, $_POST['password']);

                    $table = $role === 'user' ? "users" : "admins";

                    $query = "SELECT * FROM $table WHERE username = '$username'";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $row = mysqli_fetch_assoc($query_run);

                        if ($row['is_flagged'] == 1 && $password === "password") {
                            echo "<script>alert('Invalid credentials');</script>";
                        } else if ($password === "password") {
                            $flag_query = "UPDATE $table SET is_flagged = 1 WHERE username = '$username'";
                            mysqli_query($connection, $flag_query);
                            header("Location: forgot_password.php");
                            exit();
                        } else if ($row['password'] === $password) {
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['id'] = $row['id'];
                            header("Location: " . ($role === 'user' ? "user_dashboard.php" : "admin_dashboard.php"));
                            exit();
                        } else {
                            echo "<script>alert('Invalid username or password');</script>";
                        }
                    } else {
                        echo "<script>alert('User does not exist');</script>";
                    }

                    mysqli_close($connection);
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php ob_end_flush(); ?>
