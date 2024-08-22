<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// Sending message
if (isset($_POST['send_message'])) {
    if ($user_id != '') {

        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $subject = $_POST['subject'];
        $subject = filter_var($subject, FILTER_SANITIZE_STRING);

        $message = $_POST['message'];
        $message = filter_var($message, FILTER_SANITIZE_STRING);

        $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id=? AND name=? AND email=? AND subject=? AND message=?");
        $verify_message->execute([$user_id, $name, $email, $subject, $message]);

        if ($verify_message->rowCount() > 0) {
            $warning_msg[] = 'Message already exists';
        } else {
            $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);

            $success_msg[] = 'Message inserted successfully';
        }
    } else {
        $warning_msg[] = 'Please login first';
    }
}
?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - Contact Us Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Contact Us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Contact Us</span>
        </div>
    </div>

    <div class="services">
        <div class="heading">
            <h1>our services</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/0.png"> 
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
                </div>               
            </div>
            <div class="box">
                <img src="image/1.png"> 
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
                </div>               
            </div>
            <div class="box">
                <img src="image/2.png"> 
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, excepturi! Illum rem adipisci asperiores, mollitia, ad amet consectetur ullam praesentium esse deleniti quas atque iste perferendis, dicta nostrum repudiandae eos! Eius, quae! Repudiandae, quia non.</p>
                </div>               
            </div>
        </div>
    </div>
    <div class="heading">
            <h1>Drop us a line</h1>
            <p>Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png" alt="Separator Image">
            </div>
    <div class="form-container">
        <form action="" method="post" class="register">
            <div class="input-field">
                <label>name<sup>*</sup></label>
                <input type="text" name="name" required placeholder="enter your name" class="box">
            </div>
            <div class="input-field">
                <label>email<sup>*</sup></label>
                <input type="email" name="email" required placeholder="enter your email" class="box">
            </div>
            <div class="input-field">
                <label>subject</label><sup>*</sup></label>
                <input type="text" name="subject" required placeholder="reason...." class="box">
            </div>
            <div class="input-field">
                <label>comment</label><sup>*</sup></label>
                <textarea name="message" cols="30" rows="10" required placeholder="" class="box"></textarea>
            </div>
            <button type="submit" name="send_message" class="btn">Send Message</button>
                    
        </form>
    </div>


    <div class="addresss">
        <div class="heading">
        <h1>our contact details</h1>
            <p>Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png" alt="Separator Image">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-map-alt"></i>
                <div>
                    <h4>address</h4>
                    <p>colombo, <br> Sri Lanka.</p>
                    
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-phone-incoming"></i>
                <div>
                    <h4>email</h4>
                    <p>0777136524</p>
                    <p>0777136524</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-envelope"></i>
                <div>
                    <h4>phone number</h4>
                    <p>0777136524</p>
                    <p>0777136524</p>
                </div>
            </div>
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