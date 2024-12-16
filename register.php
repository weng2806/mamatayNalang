<?php
$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']); 
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    $query = "INSERT INTO users (name, username, email, password, mobile, address) 
              VALUES ('$name', '$username', '$email', '$password', '$mobile', '$address')";

    if (mysqli_query($connection, $query)) {
        echo "<script>
                alert('Registration successful! You may log in now.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Registration failed: " . mysqli_error($connection) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($connection);
?>
