<?php
    // Add products to cart
    if (isset($_POST['add_to_cart'])) {
        if($user_id != ''){

            $id = uniqid();
            $product_id = $_POST['product_id'];
            
            $qty = $_POST['qty'];
            $qty = filter_var($qty, FILTER_SANITIZE_STRING);

            // Verify if the product already exists in the cart
            $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
            $verify_cart->execute([$user_id, $product_id]);

            // Count the number of items in the cart
            $max_cart_items = $conn->prepare("SELECT COUNT(*) FROM `cart` WHERE user_id = ?");
            $max_cart_items->execute([$user_id]);
            $item_count = $max_cart_items->fetchColumn(); // Fetch the count

            if ($verify_cart->rowCount() > 0) {
                $warning_msg[] = 'Product already exists in your cart';
            } elseif ($item_count >= 20) { // Corrected this line
                $warning_msg[] = 'Your cart is full';            
            } else {
                $select_price = $conn->prepare("SELECT price FROM `products` WHERE id = ? LIMIT 1");
                $select_price->execute([$product_id]);
                $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

                $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
                $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
                $success_msg[] = 'Product added to your cart successfully';
            }
        } else {
            $warning_msg[] = 'Please login first';
        }
    }
?>
