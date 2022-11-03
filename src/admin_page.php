<?php 
    session_start();
    // session start to access to user's indormation as local state

    // connection to mysql database
    include 'config.php';

    // redirect to login if there isn't user's id in session
    $admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <!-- ADMIN HEADER -->
    <?php include 'admin_header.php'; ?>

    <!-- ADMIN DASHBOARD SECTION -->
    <section class="dashboard">
        
        <h1 class="title">Dashboard</h1>

        <div class="box-container">

            <!-- PENDING BOOKS -->
            <div class="box">
                <!-- php -->
                <?php
                    $total_pendings = 0;
                    // check total price
                    $total_price_query = "SELECT total_price FROM `orders` WHERE payment_status = 'pending'";

                    // request
                    $select_pending = mysqli_query(
                        $conn,
                        $total_price_query
                    ) or die('Query failed!');

                    // check if table is empty
                    if(mysqli_num_rows($select_pending) > 0){
                        while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                            // total price
                            $total_price = $fetch_pendings['total_price'];
                            $total_pendings += $total_price;
                        }
                    }
                ?>
                <!-- html -->
                <h3><?php echo $total_pendings; ?></h3>
                <p>Total pendings</p>
            </div>

            <!-- COMPLETED PAYMENTS -->
            <div class="box">
                <!-- php -->
                <?php
                    $completed_payments = 0;
                    // check total price
                    $payments_query = "SELECT total_price FROM `orders` WHERE payment_status = 'completed'";

                    // request
                    $select_completed = mysqli_query(
                        $conn,
                        $payments_query
                    ) or die('Query failed!');

                    // check if table is empty
                    if(mysqli_num_rows($select_completed) > 0){
                        while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                            // total price
                            $total_price = $fetch_pendings['total_price'];
                            $completed_payments += $completed_price;
                        }
                    }
                ?>
                <!-- html -->
                <h3>$<?php echo $total_completed; ?>/-</h3>
                <p>completed payments</p>
            </div>

            <!-- ORDER PLACED -->
            <div class="box">
                <!-- php -->
                <?php
                    $orders_query = "SELECT * FROM `orders`";

                    $selected_orders = mysqli_query(
                        $conn,
                        $orders_query
                    );

                    $number_of_orders = mysqli_num_rows($selected_orders);
                ?>
                <!-- html -->
                <h3><?php echo $number_of_orders ?></h3>
                <p>Order Placed</p>
            </div>

            <!-- PRODUCTS -->
            <div class="box">
                <!-- php -->
                <?php
                    $products_query = "SELECT * FROM `products`";
                    $selected_products = mysqli_query(
                        $conn,
                        $products_query
                    )or die('Query failed!');

                    $numbers_of_products = mysqli_num_rows($selected_products);
                ?>
                <!-- html -->
                <h3><?php echo $numbers_of_products; ?></h3>
                <p>Products Added</p>
            </div>

            <!-- Normal users -->
            <div class="box">
                <!-- php -->
                <?php
                    $selected_users = "SELECT * FROM `users` WHERE user_type = 'user'";

                    $select_users = mysqli_query(
                        $conn,
                        $selected_users
                    )or die('Query failed!');

                    $number_of_users = mysqli_num_rows($select_users);
                ?>
                <!-- html -->
                <h3><?php echo $number_of_users ?></h3>
                <p>Normal Users</p>
            </div>

            <!-- Admin users -->
            <div class="box">
                <!-- php -->
                <?php
                    $selected_admin_users = "SELECT * FROM `users` WHERE user_type = 'admin'";

                    $select_admin_users = mysqli_query(
                        $conn,
                        $selected_admin_users
                    ) or die('Query failed!');

                    $number_of_admins = mysqli_num_rows($select_admin_users);
                ?>
                <!-- html -->
                <h3><?php echo $number_of_admins ?></h3>
                <p>Admin Users</p>
            </div>

            <!-- Total accounts -->
            <div class="box">
                <!-- php -->
                <?php
                    $total_accounts_query = "SELECT * FROM `users`";

                    $select_accounts = mysqli_query(
                        $conn,
                        $total_accounts_query
                    ) or die('Query failed!');

                    $num_of_accounts = mysqli_num_rows($select_accounts);
                ?>
                <!-- html -->
                <h3><?php echo $num_of_accounts ?></h3>
                <p>Total Accounts</p>
            </div>

            <!-- Messages -->
            <div class="box">
                <!-- php -->
                <?php
                    $selected_messages_query = "SELECT * FROM `message`";

                    $select_messages = mysqli_query(
                        $conn,
                        $selected_messages_query
                    ) or die('Query failed!');

                    $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <!-- html -->
                <h3><?php echo $number_of_messages ?></h3>
                <p>New Messages</p>
            </div>
        </div>

    </section>

    <!-- script -->
    <script src="js/admin_script.js" ></script>
</body>
</html>