<?php session_start();
    // importing config.php script code
    // connection to mysql database
    include 'config.php';

    // Determine if a variable is declared and is not null
    if( isset($_POST['submit']) ){

        // take form information
        $name = mysqli_real_escape_string( $conn, $_POST['name'] );
        $email = mysqli_real_escape_string( $conn, $_POST['email'] );
        // hashed password
        $password = mysqli_real_escape_string( $conn, md5($_POST['password']) );
        $repeat_password = mysqli_real_escape_string( $conn, md5($_POST['repeat_password']) );
        $user_type = $_POST['user_type'];

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

        // echo mysqli_num_rows($select_users);

        // check if table is empty by number of rows
        if(mysqli_num_rows($select_users) > 0) {

            $message[] = "User already exist!";

        }else{
            if($password != $repeat_password){
                $message[] = "Passwords don't match!";
            }else{
                mysqli_query($conn, $sql_insert_order) or die ('Query failed!');
                $message[] = "User registered successfully!";

                // redirect to login.php if mysqli_query returns user
                header('location:login.php');
            }
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
    <title>Register</title>

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
            <h3>Register Now!</h3>

            <!-- input name -->
            <input type="text" name="name" placeholder="Enter Your Name" required class="box">

            <!-- input email -->
            <input type="text" name="email" placeholder="Enter Your Email" required class="box">
        
            <!-- input password -->
            <input type="password" name="password" placeholder="Enter Your Password" required class="box">

            <!-- input password -->
            <input type="password" name="repeat_password" placeholder="Enter Your Password" required class="box">

            <!-- select user or admin -->
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <!-- submit button -->
            <input type="submit" name="submit" value="Register Now" class="box">
        
            <!-- change to login -->
            <p>
                Already have an account?
                <a href="login.php">Login Now</a>
            </p>

        </form> 
    </div>
</body>
</html>