<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = '';
        header('location:login.php');
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - User Order Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>my order</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my order</span>
        </div>
    </div>

    
    <div class="order">
        <div class="heading">
            <h1>my orders</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
                $select_orders->execute([$user_id]);

                if($select_orders->rowCount() > 0) {
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $product_id = $fetch_orders['product_id'];

                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_products->execute([$product_id]);

                        if ($select_products->rowCount() > 0){
                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>
                <div class="box" <?php if($fetch_orders['status'] == 'canceled'){echo 'style = "border:2px solid red"';} ?> >
                    <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
                        <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                        <div class="content">
                            <p class="date"><i class="bx bxs-calender-alt"></i><?= $fetch_orders['date']; ?></p>
                            <div class="row">
                                <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                <p class="price"><?= $fetch_products['price']; ?>/=</p>
                                <p class="status" style="color:<?php if($fetch_orders['status']=='delivered'){echo "green";}
                                else if($fetch_orders['status']=='canceled'){echo "red";}
                                else{echo "orange";}?>"><?= $fetch_orders['status']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
                            }
                        }
                    
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