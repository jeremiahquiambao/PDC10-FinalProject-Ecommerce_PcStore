<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); 

//If product is set - only then will going to proceed. This is also to avoid error, just in case that the user will change something in url
if(isset($_GET['product'])) //If the word product in url is correct, only then will going to proceed
{
    $product_slug = $_GET['product']; //We have to check if the product is available in the database and if the status is set to '0'     
    $product_data = getSlugActive("products", $product_slug); //Then the current product will be stored in $product_data variable 
    $product = mysqli_fetch_array($product_data); //Then will fetch that single record in an array and storing it on the $product variable

    if($product)
    {
        ?>
        <div class="py-3 bg-danger">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="categories.php">
                        Home / 
                    </a>
                    <a class="text-white" href="categories.php">
                        Categories /
                    </a>
                    <?= $product['name']; ?>
                </h6>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container product_data mt-3"> <!-- product_data will be found in custom.js --> 
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name']; ?>
                            <span class="float-end text-danger"><?php if($product['trending']){ echo "Trending"; } ?></span>
                        </h4>
                        <hr>
                        <h6 class="fw-bold">Quick Overview:</h6>
                        <p><?= $product['small_description']; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <?php $selling_price = $product['selling_price']; ?>
                                <h4>&#8369;<span class="text-success fw-bold"><?= $english_format_number = number_format($selling_price); ?></span></h4>
                            </div>
                            <div class="col-md-6">
                                <?php $original_price = $product['original_price']; ?>
                                <h5>&#8369;<s class="text-danger"><?= $english_format_number = number_format($original_price); ?></s></h5>
                            </div>     
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width:130px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control bg-white text-center input-qty" value="1" disabled> 
                                    <button class="input-group-text increment-btn">+</button> 
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                            </div>
                        </div>
                        <hr>

                        <h6 class="fw-bold">Product Description:</h6>
                        <p><?= $product['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    else 
    {
        echo "Product Not Found"; //When the word product is missing/mispelled in url or type something different instead of word product in URL 
    }
}
else
{
    echo "Something went wrong"; //When the word product is missing/mispelled in url or type something different instead of word product in URL 
}

include('includes/footer.php');
