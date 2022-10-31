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