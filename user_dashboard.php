<?php
    session_start();
    function get_user_issue_book_count(){
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"lms");
        $user_issue_book_count = 0;
        $query = "select count(*) as user_issue_book_count from issued_books where student_id = $_SESSION[id]";
        $query_run = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_assoc($query_run)){
            $user_issue_book_count = $row['user_issue_book_count'];
        }
        return($user_issue_book_count);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="icon" type="image/x-icon" href="VcmLogo.png">
    <link rel="stylesheet" type="text/css" href="userDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="square">
            <div class="top-section">

                <img src="VcmLogo.png" alt="Logo">
                
                <hr>

                <div class="topnav">
                    <a href="#home">Home</a>
                    <a href="#issue">Issue Book</a>
                    <a href="#return">Return Book</a>
                </div>

                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search book name..." name="search">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <h2> Happy Reading, <br> <?php echo $_SESSION['name'];?>!
            <h3> Hello, and welcome to the VCMC Library Center! We're <br> happy to have you here, where you'll find resources and <br> support to enhance your learning journey.   
            <form action="index.php" method="post"> 
                <button type="submit">Logout</button> 
            </form> 


        </div>
    </div>



</body>
</html>
