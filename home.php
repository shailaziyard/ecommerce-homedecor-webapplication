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
    <title>Deco Dreams - Home Page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!-- font awesome cdn link -->
    <!-- box icon cdn link -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel='stylesheet'>

</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <!-- slider section start -->
    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>Create Your Dream Home <br>with Our Elegant Decor  </h1>
                    <a href="menu.php" class="btn">Shop Now</a>
                </div>
                <div class="imgBox">
                    <img src="image/image2.jpg" alt="Slider Image 1">
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>Transform Your Home with <br> Our Beautiful Decor</h1>
                    <a href="menu.php" class="btn">Shop Now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider2.jpg" >
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlide();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
        </ul>
    </div>
    <!-- slider section end -->
    <div class="service">
        <div class="box-container" id="service6">
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Support</h4>
                    <span>24/7 hours</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>gift service</h4>
                    <span>support gift service</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>return</h4>
                    <span>24*7 free return </span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>deliver</h4>
                    <span>24*7 free return</span>
                </div>
            </div>
            <!-- service item box -->           
        </div>
    </div>
    <!-- service section end -->
    <div class="categories">
        <div class="heading">
            <h1>Home Decor Features</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">Living Room</a>
            </div>
            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">Bedroom</a>
            </div>
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">Kitchen</a>
            </div>      
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">Bathroom</a>
            </div>
        </div>
    </div>

    <!-- categories section end -->
        <img src="image/banner5.webp" class="home-banner">

<div class="decor">
    <div class="heading">
        <span>Decor</span>
        <h1>Shop Any Home Decor Item & Get One 50% Off</h1>
        <img src="image/separator-img.png">
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/elegant0.jpg">
            <div class="detail">
                <h2>Elegant Craftsmanship</h2>
                <h1>Ceramic Vase</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/elegant1.jpg">
            <div class="detail">
                <h2>Modern Simplicity</h2>
                <h1>Wall Art</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/elegant2.jpg">
            <div class="detail">
                <h2>Cozy Comfort</h2>
                <h1>Throw Pillows</h1>
            </div>
        </div>
    </div>
</div>
    <!-- decor-container section end -->
    <div class="decor-container">
    <div class="overlay"></div>
    <div class="detail">
        <h1>Transform Your Home into a <br> Haven of Comfort</h1>
        <p>Explore our collection of home decor items that bring style, comfort, and elegance to your living spaces. <br>
        From cozy living room setups to chic bedroom designs, we have everything you need to create your dream home.</p>
        <a href="menu.php" class="btn">shop now</a>
    </div>    
</div>
    <!-- container section end -->
    <div class="home-decor3">
        <div class="t-banner">
            <div class="overlay"> </div>
            <div class="detail">
            <h1>Enhance Your Living Space</h1>
            <p>Explore our collection of home decor items that bring style, comfort, and elegance to your living spaces.</p>
            <a href="menu.php" class="btn">shop now</a>    
        </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd11.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Modern Living Room</h1>
                <p>Elegant and contemporary designs to elevate your living space.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>
            <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd2.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Stylish Bedroom</h1>
                <p>Find the perfect pieces to create a serene and stylish bedroom.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>
            <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd3.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Cozy Dining Area</h1>
                <p>Discover decor that makes your dining area warm and inviting.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>
        <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd4.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Outdoor Oasis</h1>
                <p>Transform your outdoor space into a relaxing retreat.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>
            <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd5.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Home Office</h1>
                <p>Create a productive and stylish workspace.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>
            <div class="box">
                <div class="box-overlay"> </div>
                    <img src="image/hd6.jpg">
                    <div class="box-details fadeIn-bottom">
                    <h1>Kitchen Essentials</h1>
                    <p>Find decor and essentials for a functional and beautiful kitchen.</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>                
            </div>

        </div>    
    </div>  
    <!-- taste2 section end -->
    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner1.jpg">
        <div class="detail">
            <h1>Hot Deal! Sale UpTo <span> 20% off </span></h1>
            <p>expired</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>
</div>
    <!-- flavor section end -->
    <div class="pride">
    <div class="detail">
        <h1>We Pride Ourselves On <br> Exceptional Design.</h1>
        <p>Discover our exquisite home decor collection. Transform your living spaces with pieces that perfectly blend style, comfort, and elegance to create your ideal home.</p>

        <a href="menu.php" class="btn">shop now</a>
    </div>
</div>

<!-- pride section end -->

    







    <!-- SweetAlert CDN link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <?php
    include 'components/alert.php';
    ?>



            
    <?php include 'components/footer.php'; ?>

</body>
</html>
