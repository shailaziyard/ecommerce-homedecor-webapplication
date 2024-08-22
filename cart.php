<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    header('Location: login.php');
    exit;
}

// Update quantity in cart
if (isset($_POST['update_cart'])) {
    $cart_id = filter_var($_POST['cart_id'], FILTER_SANITIZE_STRING);
    $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);

    if (filter_var($qty, FILTER_VALIDATE_INT) === false || $qty <= 0) {
        $warning_msg[] = 'Invalid quantity';
    } else {
        $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);

        $success_msg[] = 'Cart quantity updated successfully';
    }
}

// Delete products in cart
if (isset($_POST['delete_item'])) {
    $cart_id = filter_var($_POST['cart_id'], FILTER_SANITIZE_STRING);

    $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $verify_delete_item->execute([$cart_id]);

    if ($verify_delete_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = 'Cart item deleted successfully';
    } else {
        $warning_msg[] = 'Cart item already deleted';
    }
}

// Empty cart
if (isset($_POST['empty_cart'])) {
    $verify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_empty_item->execute([$user_id]);

    if ($verify_empty_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);
        $success_msg[] = 'Cart emptied successfully';
    } else {
        $warning_msg[] = 'Your cart is already empty';
    }
}

// Other code...

// Ensure $fetch_wishlist is defined and fetched correctly
$fetch_wishlist = [];
$wishlist_query = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
$wishlist_query->execute([$user_id]);

if ($wishlist_query->rowCount() > 0) {
    $fetch_wishlist = $wishlist_query->fetchAll(PDO::FETCH_ASSOC);
}

// Later in your code where you use $fetch_wishlist
if (!empty($fetch_wishlist)) {
    foreach ($fetch_wishlist as $wishlist_item) {
        // Ensure the array offset exists before accessing it
        if (isset($wishlist_item['some_key'])) {
            // Process your wishlist item...
        }
    }
} else {
    // Handle the case where $fetch_wishlist is empty
    $warning_msg[] = 'No items in your wishlist';
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - User Cart Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Cart</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Cart</span>
        </div>
    </div>
    
    <div class="products">
        <div class="heading">
            <h1>my cart</h1>
            <img src="image/separator-img.png">
        </div>
    <div class="box-container">
        <?php
            $grand_total = 0;

            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            
            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$fetch_cart['product_id']]);

                if ($select_products->rowCount() > 0) {
                    $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
        ?> 

        <form action="" method="post" class="box" <?php if($fetch_products['stock'] == 0){echo "disabled";} ?>>
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                <?php if($fetch_products['stock'] > 9) { ?> 
                    <span class="stock" style="color: green;">In stock</span>
                <?php } elseif($fetch_products['stock'] == 0) { ?> 
                    <span class="stock" style="color: red;">Out of stock</span>
                <?php } else { ?>
                    <span class="stock" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?> left</span>
            <?php } ?>
                <div class="content">
                    <!-- <img src="image/shape-19.png" class="shap"> -->
                    <h3><?= $fetch_products['name']; ?></h3>
                    <div class="flex-btn">
                        <p class="price">price $<?=$fetch_products['price']; ?>/-</p>
                        <input type="number" name="qty" required min="1" value="<?=$fetch_cart['qty']; ?>" max="99" maxlength="2" class="box qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit box"></button>

                    </div>
                    <div class="flex-btn">
                        <p class="sub-total">sub total : <span> $<?= $sub_total = ($fetch_cart['qty'] *$fetch_cart['price']); ?></span></p>
                        <button type="submit" name="delete_item" class="btn" onclick="return confirm('remove from cart');">delete</button>
                    </div>

                </div>
                </form>
                <?php
                                $grand_total += $sub_total;
                                }else {
                                    echo '
                                        <div class="empty">
                                            <p>No products was found!</p>
                                        </div>
                                    ';
                                }
                            } 
                        }else {
                            echo '
                                <div class="empty">
                                    <p>No products added yet!</p>
                                </div>
                            ';
                        }
            ?>

</div>

                    <?php if($grand_total != 0 ){?>
                    <div class="cart-total">
                        <p>total amount payable : <span> $ <?=$grand_total; ?>/-</span></p>
                        <div class="button">
                            <form action="" method="post">
                                <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart');">empty cart</button>

                            </form>
                            <a href="checkout.php" class="btn">proceed to checkout</a>
                        </div>
                    </div>
                  
                <?php } ?>
        
            </div>
        

    
    

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>


    <?php include 'components/footer.php'; ?>
    <script src="js/user_script.js"></script>

</body>
</html>