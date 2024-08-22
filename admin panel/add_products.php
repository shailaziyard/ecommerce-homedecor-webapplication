<?php
include '../components/connect.php';

if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

//add product in database
if(isset($_POST['publish'])){

    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if(isset($image)){
        if ($select_image->rowCount() > 0){
            $warning_msg[] = 'image name repeated';
        } elseif ($image_size > 2000000){
            $warning_msg[] = 'image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }   
    if($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'please rename your image';
    } else {
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_detail, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $description, $status]);
        $success_msg[] = 'product inserted successfully';
    }
}


//add product in draft
if(isset($_POST['draft'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if(isset($image)){
        if ($select_image->rowCount() > 0){
            $warning_msg[] = 'image name repeated';
        } elseif ($image_size > 2000000){
            $warning_msg[] = 'image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }
    
    if($select_image->rowCount() > 0 && $image != '') {
        $warning_msg[] = 'please rename your image';
    } else {
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_detail, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $description, $status]);
        $success_msg[] = 'product saved as draft successfully';
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco dreams - Admin Add Products Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>    
    <section class="post-editor">
        <div class="heading">
            <h1>Add product</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                    <p>Product Name <span>*</span></p>
                    <input type="text" name="name" maxlength="100" placeholder="Add product name" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Price <span>*</span></p>
                    <input type="number" name="price" maxlength="100" placeholder="Add product price" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Detail <span>*</span></p>
                    <textarea name="description" maxlength="1000" placeholder="Add product detail" class="box"></textarea>
                </div>
                <div class="input-field">
                    <p>Product Stock <span>*</span></p>
                    <input type="number" name="stock" maxlength="10" min="0" max="9999999999" placeholder="Add product stock" required class="box">
                </div>
                <div class="input-field">
                    <p>Product Image <span>*</span></p>
                    <input type="file" name="image" accept="image/*" required class="box">
                </div>
                <div class="flex-btn">
                    <input type="submit" name="publish" value="Add Product" class="btn">
                    <input type="submit" name="draft" value="Save as Draft" class="btn">
                </div>
            </form>
        </div>
    </section>

    <!-- SweetAlert CDN link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js link -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>

</body>
</html>
