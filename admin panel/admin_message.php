<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
    exit();
}

//delete message from database
if (isset($_POST['delete_msg'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_msg->execute([$delete_id]);

        $success_msg[] = 'Message deleted successfully';
    } else {
        $warning_msg[] = 'Message already deleted';
    }

}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - Admin Message Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>    
        <section class="message-container">
            <div class="heading">
                <h1>Unread messages</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    if ($select_message->rowCount() > 0) {
                        while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {      
                ?>

                <div class="box">
                    <h3 class= "name"><?=$fetch_message['name']; ?></h3>
                    <h4><?=$fetch_message['subject']; ?></h4>
                    <p><?=$fetch_message['message']; ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="delete_id" value="<?= $fetch_message['id']; ?>">
                        <input type="submit" name="delete_msg" value="delete message" class="btn" onclick= "return confirm('delete this message');">
                    </form>
                </div>
                <?Php
                        }
                    }else{
                        echo '
                            <div class="empty">
                                <p>No unread message yet!</p>
                            </div>
                        ';
                    }
                ?>
                
            
        </div>
    </section>
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






































<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
    exit();
}

// update order from database
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

    $update_pay = $conn->prepare("UPDATE `order` SET payment_status = ? WHERE id = ?");
    $update_payment->execute([$update_payment, $order_id]);
    $success_msg[] = 'order payment status updated';

    //delete order
    if (isset($_POST['delete_order'])) {
        $delete_id = $_POST['order_id'];
        $delete_id = filter_var($delete_order, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_order = $conn->prepare("DELETE FROM `message` WHERE id = ?");
            $delete_order->execute([$delete_id]);
            
            $success_msg[] = 'order deleted';
        } else {
            $warning_msg[] = 'order already deleted';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Admin Message Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>    
    </div>

    <section class="message-container">
        <div class="heading">
            <h1>Unread Messages</h1>
            <img src="../image/separator-img.png" alt="Separator Image">
        </div>
        <div class="box-container">
            <?php
                $select_message = $conn->prepare("SELECT * FROM `message`");
                $select_message->execute();
                if ($select_message->rowCount() > 0) {
                    while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {      
            ?>

            <div class="box">
                <h3 class="name"><?= htmlspecialchars($fetch_message['name']); ?></h3>
                <h4><?= htmlspecialchars($fetch_message['subject']); ?></h4>
                <p><?= htmlspecialchars($fetch_message['message']); ?></p>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($fetch_message['id']); ?>">
                    <input type="submit" name="delete_msg" value="Delete Message" class="btn" onclick="return confirm('Delete this message?');">
                </form>
            </div>
            <?php
                    }
                } else {
                    echo '
            <div class="empty">
                <p>No unread messages yet! <br><a href="add_products.php" class="btn" style="margin-top:1.5rem;">Add Products</a></p>
            </div>
            ';
                }
            ?>
        </div>
    </section>

    <!-- SweetAlert CDN link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js link -->
    <script src="../js/admin_script.js"></script>

    <?php
    include '../components/alert.php';
    ?>

</body>
</html>
