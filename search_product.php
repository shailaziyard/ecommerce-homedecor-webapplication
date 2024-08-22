<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

include 'components/add_wishlist.php';
include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - Search Products Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Search Products</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Search Products</span>
        </div>
    </div>

    <div class="products">
        <div class="heading">
            <h1>Search Result</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            if (isset($_POST['search_product']) || isset($_POST['search_product_btn'])) {
                $search_products = $_POST['search_product'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? AND status=?");
                $select_products->execute(["%{$search_products}%", 'active']);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $product_id = $fetch_products['id'];
                        ?>
                        <form action="" method="post" class="box">
                            <img src="uploaded_files/<?= $fetch_products['image']; ?>" alt="Product Image">

                            <?php if ($fetch_products['stock'] > 9) { ?>
                                <span class="stock" style="color: green;">Instock</span>
                            <?php } elseif ($fetch_products['stock'] == 0) { ?>
                                <span class="stock" style="color: red;">Out of stock</span>
                            <?php } ?>

                            <div class="content">
                                <!-- <img src="image/shape-19.png" alt="" class="shap"> -->
                                <div class="button">
                                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                    <div>
                                        <button type="submit" name="add_to_cart" <?php if($fetch_products['stock'] == 0){echo 'disabled';} ?>><i class="bx bx-cart"></i></button>
                                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                                    </div>
                                </div>
                                <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                                <div class="flex-btn">
                                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    echo '<div class="empty"><p>No products found</p></div>';
                }
            } else {
                echo '<div class="empty"><p>Please search something</p></div>';
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
