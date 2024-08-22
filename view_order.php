<?php
    include 'components/connect.php';

    // Check if user is logged in
    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = '';
        header('location:login.php');
        exit();
    }

    // Get the order ID from the URL parameter
    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    } else {
        $get_id = '';
        header('location:order.php');
        exit();
    }

    // Handle cancel button click
    if (isset($_POST['cancel'])) {
        $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
        $update_order->execute(['cancelled', $get_id]);

        header('location:order.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Order Detail Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Order Detail</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Order Detail</span>
        </div>
    </div>

    <div class="order-detail">
        <div class="heading">
            <h1>my order detail</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Ilaesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
                $select_order->execute(['get_id']);
    
                if ($select_order->rowCount() > 0) {
                    while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                        $select_product->execute([$fetch_order['product_id']]);
                        if($select_product->rowCount() > 0){
                            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                                $sub_total = ($fetch_order['price']* $fetch_order['qty']);
                                $grand_total += $sub_total;
                            }
                        }
                    
                        ?>
                        <div class="box">
                            <div class="col">
                                <p class="title"><i class="bx bxs-calender-alt"></i><?= $fetch_order['date']; ?></p>
                                <img src = "uploaded_files/<?=$fetch_product['image']; ?>" class="image">
                                <p class="price">$<?=$fetch_product['price']; ?>/-</p>
                                <h3 class="name"><?=$fetch_product['name']; ?></h3>
                                <p class="grand-total">total amount payment: <span>$<?= $grand_total; ?>/-</span> </p>
                            </div>
                            <div class="col">
                                <p class="tittle">billing address</p>
                                <p class="user"><i class="bi bi-person-bounding-box"></i><?=$fetch_order['name']; ?></p>
                                <p class="user"><i class="bi bi-phone"></i><?=$fetch_order['number']; ?></p>
                                <p class="user"><i class="bi bi-envelope"></i><?=$fetch_order['email']; ?></p>
                                <p class="user"><i class="bi bi-pin-map-fill"></i><?=$fetch_order['address']; ?></p><i class="bi bi-pin-map-fill"></i><?=$fetch_order['address']; ?>
                                <p class="status" style="color:<?php if($fetch_orders['status'] == 'deliverd')
                                { echo "green";}elseif($fetch_order['status'] == 'cancled')
                                {echo "red";}else{echo "orange";} ?>"><?=$fetch_order['status']; ?> </p>
                                <?php if($fetch_order['status']=='cancled'){ ?> 
                                    <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn" style="line-height: 3">order again</a>
                                <?php }else{ ?>
                                    <form action="" method="post">
                                        <button type="submit" name="cancle" class="btn" onclick="return confirm('do yo want to cancle this product');">cancle</button>
                                    </form>

                                <?php } ?>
   
                            </div>
                        </div>

                        <?php
                    }
                
            
        }else{
            echo '<p class="empty">no order take placed yet</p>';
        }

        ?>
        </div>
    </div>
    



    

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>


    <?php include 'components/footer.php'; ?>
    <script src="uploaded_files/user_script.js"></script>

</body>
</html>