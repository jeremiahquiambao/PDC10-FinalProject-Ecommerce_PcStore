<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); //header.php already have session_start()

include('authenticate.php'); //for user authentication when trying to access this page 

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="cart.php" class="text-white">
                Cart
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h6>Product</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Remove</h6>
                        </div>
                    </div>
                    <?php $items = getCartItems(); //getCartItems() will be found in userfunctions.php

                    foreach ($items as $c_item)
                    {
                        ?> 
                        <div class="card product_data shadow-sm mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="uploads/<?= $c_item['image']; ?>" alt="Product Image" class="w-50">
                                </div>
                                <div class="col-md-3">
                                    <h5><?= $c_item['name']; ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <?php $selling_price = $c_item['selling_price']; ?>
                                    <h5>&#8369;<span class="fw-bold"><?= $english_format_number = number_format($selling_price); ?></span></h5>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" class="prodId" value="<?= $c_item['prod_id']; ?>">
                                    <div class="input-group mb-2" style="width:130px">
                                        <button class="input-group-text decrement-btn updateQty">-</button>
                                        <input type="text" class="form-control bg-white text-center input-qty" value="<?= $c_item['prod_qty']; ?>" disabled> 
                                        <button class="input-group-text increment-btn updateQty">+</button> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash me-2"></i>Remove</button>
                                </div>
                            </div>
                        </div>

                        <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>