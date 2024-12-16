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
  
    </head>
<body>
    <form method="POST" action="forgot_password.php">
    <label for="username">Enter Your Username:</label>
    <input type="text" name="username" id="username" required>
    <button type="submit" name="submit">Submit</button>

    
</form>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // check username kung meron
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id']; // retrieve user id

        // kasama niya yung id sa next php 
        header("Location: reset_password.php?id=$user_id");
        exit();
    } else {
        echo "<script>alert('No account found with that username. Please try again.');</script>";
    }

    mysqli_close($connection);
}
?>

</body>
</html>
<?php ob_end_flush(); ?>
