<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = '';
    }

    $pid = $_GET['pid'];

    include 'components/add_wishlist.php';
    include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - Product Detail Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Product Detail</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Product Detail</span>
        </div>
    </div>

    <section class="view_page">
        <div class="heading">
            <h1>Product Detail</h1>
            <img src="image/separator-img.png" alt="Separator">
        </div>

        <?php
        if (isset($pid)) {
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$pid]);

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <form action="" method="post" class="box">
            <div class="img-box">
                <img src="uploaded_files/<?= $fetch_products['image']; ?>" alt="<?= $fetch_products['name']; ?>">
            </div>
            <div class="detail">
                <?php if ($fetch_products['stock'] > 9) { ?> 
                    <span class="stock" style="color: green;">In stock</span>
                <?php } elseif ($fetch_products['stock'] == 0) { ?> 
                    <span class="stock" style="color: red;">Out of stock</span>
                <?php } else { ?>
                    <span class="stock" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?> left</span>
                <?php } ?>

                <p class="price"><?= $fetch_products['price']; ?>/-</p>
                <div class="name"><?= $fetch_products['name']; ?></div>
                <p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="button">
                    <button type="submit" name="add_to_wishlist" class="btn">Add to Wishlist<i class="bx bx-heart"></i></button>
                    <input type="hidden" name="qty" value="1" min="0" class="quantity">
                    <button type="submit" name="add_to_cart" class="btn">Add to Cart<i class="bx bx-cart"></i></button>
                </div>
            </div>
        </form>

        <?php
                }
            }
        }
        //         }
        //     } else {
        //         echo "<p>Product not found.</p>";
        //     }
        // } else {
        //     echo "<p>No product ID provided.</p>";
        // }
        ?>
    </section>

    <div class="products">
        <div class="heading">
            <h1>Similar Products</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <img src="image/separator-img.png" alt="Separator">
        </div>
        <?php include 'components/shop.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
    <?php include 'components/footer.php'; ?>
    <script src="uploaded_files/user_script.js"></script>
</body>
</html>
