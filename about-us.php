<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $user_id = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deco Dreams - About Us Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>Discover the story behind our passion for home decor. <br> Explore how we blend creativity and craftsmanship to curate  exceptional living spaces.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                <span>Alexa Smith</span>
                <h1>Interior Designer</h1>
                        <img src="image/separator-img.png">
                </div>
                <p>Uncover the visionary expertise of our interior designer, Alexa Smith.<br> With meticulous attention to detail and an unwavering dedication to crafting harmonious living spaces,<br> Alexa transforms your home decor aspirations into reality.                
                Explore the vision and expertise of Alexa Smith, our talented interior designer.<br> With a meticulous attention to detail and a profound passion for crafting harmonious living spaces,<br> Alexa transforms your home decor aspirations into stunning realities.</p>

                <div class="flex-btn">
                    <a href="" class="btn">explore our Collections</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
</div>
                
            </div>
            </div>

                
                
                        
    <!-- cheaf section start -->
    <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div><p>"Embark on our journey into the world of home decor.<br> With a blend of creativity and craftsmanship, we curate spaces  that resonate with your style and personality.<br> From modern minimalism to timeless classics, each piece tells a story of elegance and comfort.<br> Our passion for design drives us to create harmonious environments where every element is thoughtfully selected.<br> Let us guide you through our collection, where every item reflects our dedication to quality and aesthetics.<br> Together, we'll transform your house into a home that inspires and rejuvenates, embodying your unique vision and aspirations."</p>
        <a href="menu.php" class="btn">visit our shop</a>
    </div>
    <!-- cheaf section end -->
    <!-- testimonial section start -->
    <div class="testimonial">
        
        <div class="heading">
            <h1>Client Testimonials</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Experience the transformative essence of our home decor pieces. They seamlessly blend style and functionality, turning your house into a haven of comfort and beauty.</p>
                        <h2>Sophia Johnson</h2>
                        <p>Homeowner</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Experience the transformative essence of our home decor pieces. They seamlessly blend style and functionality, turning your house into a haven of comfort and beauty.</p>
                        <h2>Sophia Johnson</h2>
                        <p>Homeowner</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Experience the transformative essence of our home decor pieces. They seamlessly blend style and functionality, turning your house into a haven of comfort and beauty.</p>
                        <h2>Sophia Johnson</h2>
                        <p>Homeowner</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">
                    </div>
                </div>
                <div class="slide-col">
                        <div class="user-text">
                        <p>Experience the transformative essence of our home decor pieces. They seamlessly blend style and functionality, turning your house into a haven of comfort and beauty.</p>
                        <h2>Sophia Johnson</h2>
                        <p>Homeowner</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">
                    </div>
                </div>


            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>
    <!-- testimonial section end -->

    <div class="mission">
        <div class="box-container">
        <div class="heading">
                    <h1>our mission</h1>
                    <img src="image/separator-img.png">
                </div>
            <div class="box">
                
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission6.jpg">
                    </div>
                    <div>
                        <h2>Rustic Charm</h2>
                        <p>Enhancing homes with timeless charm, coziness, and nostalgic elements.</p>
                    </div>

                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission1.jpg">
                    </div>
                    <div>
                    <h2>Vintage Glamour</h2>
                        <p>Enhancing homes with cozy, timeless pieces coziness that evoke nostalgia.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission3.jpg">
                    </div>
                    <div>
                    <h2>Bohemian Chic</h2>
                        <p>Create cozy, timeless spaces with coziness and nostalgic charm and warmth.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission4.jpg">
                    </div>
                    <div>
                    <h2>Coastal Retreat</h2>
                        <p>Transforming homes with timeless elegance, comfort, and personalized style.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission5.jpg">
                    </div>
                    <div>
                    <h2>Modern Elegance</h2>
                        <p>Transforming spaces with timeless charm, comfort, and nostalgic elegance.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
 
                
    <?php include 'components/footer.php'; ?>
    <script src="js/user_script.js"></script>

</body>
</html>
