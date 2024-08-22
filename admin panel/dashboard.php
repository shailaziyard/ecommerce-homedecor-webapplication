<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deco Dreams - Admin Dashboard Page</title>
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
        <!-- font awesome cdn link -->
        <!-- box icon cdn link -->
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    </head>
    <body>
        <div class="main-container">
            <?php include '../components/admin_header.php'; ?>       
            <section class="dashboard">
                <div class="heading">
                    <h1>Dashboard</h1>
                    <img src="../image/separator-img.png">
                </div>
                <div class="box-container">
                    <div class="box">
                        <h3>Welcome!</h3>
                        <p><?= $fetch_profile['name']; ?></p>
                        <a href="update.php" class="btn">Update Profile</a>
                    </div>                    
                    <div class="box">
                        <?php
                            $select_message = $conn->prepare("SELECT * FROM `message`");
                            $select_message->execute();
                            $number_of_msg = $select_message->rowCount();
                        ?>
                        <h3><?= $number_of_msg; ?></h3>
                        <p>unread message</p>
                        <a href="admin_message.php" class="btn">See Message</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
                            $select_products->execute([$seller_id]);
                            $number_of_products = $select_products->rowCount();
                        ?>
                        <h3><?= $number_of_products; ?></h3>
                        <p>products added</p>
                        <a href="add_products.php" class="btn">add product</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_active_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ? AND status =?");
                            $select_active_products->execute([$seller_id, 'active']);
                            $number_of_active_products = $select_active_products->rowCount();
                        ?>
                        <h3><?= $number_of_active_products; ?></h3>
                        <p>total active products</p>
                        <a href="view_products.php" class="btn">active product</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_deactive_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ? AND status =?");
                            $select_deactive_products->execute([$seller_id, 'deactive']);
                            $number_of_deactive_products = $select_deactive_products->rowCount();
                        ?>
                        <h3><?= $number_of_deactive_products; ?></h3>
                        <p>total deactive products</p>
                        <a href="view_products.php" class="btn">deactive product</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_users = $conn->prepare("SELECT * FROM `users`");
                            $select_users->execute();
                            $number_of_users = $select_users->rowCount();
                        ?>
                        <h3><?= $number_of_users; ?></h3>
                        <p>users account</p>
                        <a href="user_accounts.php" class="btn">see users</a>
                    </div>    
                    <div class="box">
                        <?php
                            $select_sellers = $conn->prepare("SELECT * FROM `sellers`");
                            $select_sellers->execute();
                            $number_of_sellers = $select_sellers->rowCount();
                        ?>
                        <h3><?= $number_of_sellers; ?></h3>
                        <p>sellers account</p>
                        <a href="user_accounts.php" class="btn">see sellers</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
                            $select_orders->execute([$seller_id]);
                            $number_of_orders = $select_orders->rowCount();
                        ?>
                        <h3><?= $number_of_orders; ?></h3>
                        <p>total orders placed</p>
                        <a href="admin_order.php" class="btn">total orders</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND status = ?");
                            $select_confirm_orders->execute([$seller_id,'in progress']);
                            $number_of_confirm_orders = $select_confirm_orders->rowCount();
                        ?>
                        <h3><?= $number_of_confirm_orders; ?></h3>
                        <p>total confirm orders</p>
                        <a href="admin_order.php" class="btn">confirm orders</a>
                    </div>
                    <div class="box">
                        <?php
                            $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND status = ?");
                            $select_canceled_orders->execute([$seller_id,'canceled']);
                            $number_of_canceled_orders = $select_canceled_orders->rowCount();
                        ?>
                        <h3><?= $number_of_canceled_orders; ?></h3>
                        <p>total canceled orders</p>
                        <a href="admin_order.php" class="btn">canceled orders</a>
                    </div>
                </div>
            </section>  
        </div>
</div>
            
    

        <!-- SweetAlert CDN link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- custom js link -->
        <script src="../js/admin_script.js"></script>

        <?php
        include '../components/alert.php';
        ?>

</body>
</html>
