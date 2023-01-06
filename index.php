<?php 

include('functions/userfunctions.php');
include('includes/header.php'); //header.php already have session_start()
include('includes/slider.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underline"></div>
                <hr>  
                    <div class="owl-carousel">
                        <?php 
                            $trendingProducts = getAllTrending();
                            if(mysqli_num_rows($trendingProducts) > 0) //1 = trending
                            {
                                foreach($trendingProducts as $item)
                                {
                                    ?>
                                        <div class="item">
                                            <a href="product-view.php?product=<?= $item['slug']; ?>"> <!-- When you click on the product, it will go to product-view.php page along with the product slug in the url -->
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                    <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                                    <h6 class="text-center"><?= $item['name']; ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>About Us</h4>
                <div class="underline mb-2"></div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, eos quam in quo ullam natus incidunt aliquid ducimus error corporis, autem, voluptas delectus velit unde vitae sed quas qui praesentium ex? Quis perspiciatis inventore odio soluta voluptas architecto facilis veniam.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, eos quam in quo ullam natus incidunt aliquid ducimus error corporis, autem, voluptas delectus velit unde vitae sed quas qui praesentium ex? Quis perspiciatis inventore odio soluta voluptas architecto facilis veniam.
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita libero totam consectetur, illo consequatur pariatur id animi itaque dolore veritatis tempore blanditiis, corrupti nemo veniam nam obcaecati sapiente similique omnis architecto nesciunt laudantium accusamus repellendus corporis rerum. Rem, ut odit.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-white">Techno Hub</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"> <i class="fa fa-angle-right"></i> Home</a> <br>
                <a href="#" class="text-white"> <i class="fa fa-angle-right"></i> About Us</a> <br>
                <a href="cart.php" class="text-white"> <i class="fa fa-angle-right"></i> My Cart</a> <br>
                <a href="categories.php" class="text-white"> <i class="fa fa-angle-right"></i> Our Collections</a>
            </div>
            <div class="col-md-6">
                <h4 class="text-white">Address</h4>
                <p class="text-white">
                    #202, Ground Floor, 
                    AUF Main, Angeles City,
                    Pampanga.
                </p>
                <a href="tel:+9435381366" class="text-white"> <i class="fa fa-phone"></i> +63 9435381366 </a> <br>
                <a href="mail:technohub@gmail.com" class="text-white"> <i class="fa fa-envelope"></i> technohub@gmail.com </a> <br>
            </div>  
          
        </div>
    </div>
</div>

<div class="py-2 bg-danger">
    <div class="text-center">
        <p class="mb-0 text-white">All Rights Reserved. Copyright @TechnoHub <?= date('Y') ?></p>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    });
</script>