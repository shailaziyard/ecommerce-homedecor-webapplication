<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// Define $seller_id
$seller_id = isset($_COOKIE['seller_id']) ? $_COOKIE['seller_id'] : ''; // Make sure to set the seller_id somewhere

$select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE id = ? LIMIT 1");
$select_seller->execute([$seller_id]);
$fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC);

$prev_pass = $fetch_seller['password'] ?? ''; // Use null coalescing operator to avoid undefined index
$prev_image = $fetch_seller['image'] ?? '';

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update name
    if (!empty($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $update_name = $conn->prepare("UPDATE `sellers` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $seller_id]);
        $success_msg[] = 'Name updated successfully';
    }

    // Update email
    if (!empty($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $select_email = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? AND id != ?");
        $select_email->execute([$email, $seller_id]);

        if ($select_email->rowCount() > 0) {
            $warning_msg[] = 'Email already exists';
        } else {
            $update_email = $conn->prepare("UPDATE `sellers` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $seller_id]);
            $success_msg[] = 'Email updated successfully';
        }
    }

    // Update image
    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = uniqid().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = __DIR__ . '/../uploaded_files/'.$rename; // Use __DIR__ to get the current directory path

        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            // Check if the directory exists and is writable
            if (!is_dir(__DIR__ . '/../uploaded_files/')) {
                mkdir(__DIR__ . '/../uploaded_files/', 0777, true); // Create the directory if it does not exist
            }

            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $update_image = $conn->prepare("UPDATE `sellers` SET image = ? WHERE id = ?");
                $update_image->execute([$rename, $seller_id]);

                if ($prev_image != '' && $prev_image != $rename) {
                    $prev_image_path = __DIR__ . '/../uploaded_files/'.$prev_image;
                    if (file_exists($prev_image_path)) {
                        unlink($prev_image_path);
                    }
                }
                $success_msg[] = 'Image updated successfully';
            } else {
                $warning_msg[] = 'Failed to upload the image';
            }
        }
    }

    // Update password
    if (!empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['cpass'])) {
        $old_pass = sha1($_POST['old_pass']);
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

        $new_pass = sha1($_POST['new_pass']);
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'Old password not matched';
        } elseif ($new_pass != $cpass) {
            $warning_msg[] = 'Password not matched';
        } else {
            $update_pass = $conn->prepare("UPDATE `sellers` SET password = ? WHERE id = ?");
            $update_pass->execute([$new_pass, $seller_id]);
            $success_msg[] = 'Password updated successfully';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - User Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>update profile</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>update profile</span>
        </div>
    </div>

    <section class="form-container">
        <div class="heading">
            <h1>Update Profile Details</h1>
            <img src="image/separator-img.png" alt="Separator Image">
        </div>
        
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
                <img src="../uploaded_files/<?= htmlspecialchars($fetch_seller['image'] ?? 'default-image.png'); ?>" class="image" alt="Seller Image">
            </div>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your name<span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name" value="<?= htmlspecialchars($fetch_seller['name'] ?? ''); ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Your email<span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($fetch_seller['email'] ?? ''); ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Select pic<span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Old password<span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter your old password" class="box">
                    </div>
                    <div class="input-field">
                        <p>New password<span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter your new password" class="box">
                    </div>
                    <div class="input-field">
                        <p>Confirm password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your password" class="box">
                    </div>
                </div>
            </div>
            <input type="submit" name="update" value="Update Profile" class="btn">
        </form>
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
