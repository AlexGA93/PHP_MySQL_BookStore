<?php session_start();
    // create or resume session identifier via GET, POST or cookie
    

    // importing config.php script code
    // connection to mysql database
    include 'config.php';

    // Determine if a variable is declared and is not null
    if( isset($_POST['submit']) ){

        /* take form information */

        // take email field
        $email = mysqli_real_escape_string( $conn, $_POST['email'] );
        // hashed password
        $password = mysqli_real_escape_string( $conn, md5($_POST['password']) );

        // SQL SELECT QUERY
        $sql_select_order = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
        // SQL User insertion
        $sql_insert_order = "INSERT INTO `users`(name, email, password, user_type) VALUES ('$name','$email','$repeat_password','$user_type')";

        // request to the database
        $select_users = mysqli_query(
            // connection
            $conn,
            // SQL query
            $sql_select_order 
        ) or die ('Query failed!');

        // check if table is empty by number of rows
        if(mysqli_num_rows($select_users) > 0) {

            // obtain the ddbb user's row
            $row = mysqli_fetch_assoc($select_users);

            // if user is admin
            if( $row['user_type'] == 'admin'){
                
                // update session information
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                
                // redirect to admin page
                header('location:admin_page.php');
            
            } elseif( $row['user_type'] == 'user') {

                // update session information
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];

                // redirect to home page
                header('location:index.php');
            }

        }else{
            $message[] = "Incorrect email or password!";
        }
    }
?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in!</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <!-- PHP Message Logic -->
    <?php
        if(isset($message)){
            foreach($message as $message_mssg){
                echo '
                <div class="message">
                    <span>'.$message_mssg.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
            }
        }
    ?>
    <!-- ----------------- -->

    <div class="form-container">
        <form action="" method="post">

            <!-- title -->
            <h3>Login!</h3>

            <!-- input email -->
            <input type="text" name="email" placeholder="Enter Your Email" required class="box">
        
            <!-- input password -->
            <input type="password" name="password" placeholder="Enter Your Password" required class="box">

            <!-- submit button -->
            <input type="submit" name="submit" value="Log in" class="box">
        
            <!-- change to login -->
            <p>
                Don't you have account?
                <a href="register.php">Register!</a>
            </p>

        </form> 
    </div>
</body>
</html>