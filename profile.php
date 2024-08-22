<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit(); // Ensure the script stops executing after the redirection
}

// Fetch user profile information
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Fetch orders count
$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
$select_orders->execute([$user_id]);
$total_orders = $select_orders->rowCount();

// Fetch messages count
$select_message = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
$select_message->execute([$user_id]);
$total_message = $select_message->rowCount();

// Fetch seller information (check if the column name is correct)
$select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
$select_seller->execute([$user_id]);
$seller = $select_seller->fetch(PDO::FETCH_ASSOC);

// Check if seller information was found
$seller_id = isset($seller['id']) ? $seller['id'] : null;

// Fetch total products (assuming products are associated with sellers)
if ($seller_id !== null) {
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
    $select_products->execute([$seller_id]);
    $total_products = $select_products->rowCount();
} else {
    $total_products = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Profile Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Profile</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>profile</span>
        </div>
    </div>

    <section class="profile">
        <div class="heading">
            <h1>Profile Details</h1>
            <img src="image/separator-img.png" alt="Separator Image">
        </div>
        <div class="details">
            <div class="user">
                <img src="uploaded_files/<?= htmlspecialchars($fetch_profile['image']); ?>" alt="User Image">
                <h3><?= htmlspecialchars($fetch_profile['name']); ?></h3>
                <p>User</p>
                <a href="update.php" class="btn">Update Profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-folder-minus"></i>
                        <h3><?= $total_orders; ?></h3>
                    </div>
                    <a href="order.php" class="btn">View Orders</a>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-chat"></i>
                        <h3><?= $total_message; ?></h3>
                    </div>
                    <a href="message.php" class="btn">View Message</a>
                </div>
            </div>

            <!-- <div class="user">
                <?php if ($seller && isset($seller['image'])): ?>
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>" class="image" alt="Seller Image">
                <?php else: ?>
                    <img src="image/default-image.png" class="image" alt="Default Image">
                <?php endif; ?>
                <h3 class="name"><?= $fetch_profile['name']; ?></h3>
                <span>Seller</span>
                <a href="update.php" class="btn">Update Profile</a>
            </div> -->
            
            <!-- <div class="flex">
                <div class="box">
                    <span><?= $total_products; ?></span>
                    <p>Total Products</p>
                    <a href="view_product.php" class="btn">View Products</a>   
                </div>
                <div class="box">
                    <span><?= $total_orders; ?></span>
                    <p>Total Orders</p>
                    <a href="admin_orders.php" class="btn">View Orders</a>   
                </div>
            </div>
        </div> -->
    </section>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>
    <?php include 'components/footer.php'; ?>
    <script src="uploaded_files/user_script.js"></script>

</body>
</html>
