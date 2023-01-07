<?php 

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); //header.php already have session_start()

include('authenticate.php'); //for user authentication when trying to access this page 

?>

<div class="py-3 bg-danger">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="checkout.php" class="text-white">
                Checkout
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" required placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">E-mail</label>
                                    <input type="text" name="email" required placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone</label>
                                    <input type="text" name="phone" required placeholder="Enter your phone number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Zip Code</label>
                                    <input type="text" name="pincode" required placeholder="Enter your pin code" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea name="address" required class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                                
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                                <?php $items = getCartItems(); //getCartItems() will be found in userfunctions.php
                                $totalPrice = 0;
                                foreach ($items as $c_item)
                                {
                                    ?> 
                                    <div class="mb-1 border ">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?= $c_item['image']; ?>" alt="Product Image" width="60px">
                                            </div>
                                            <div class="col-md-5">
                                                <label><?= $c_item['name']; ?></label>
                                            </div>
                                            <div class="col-md-3">
                                                <?php $selling_price = $c_item['selling_price']; ?>
                                                <label>&#8369;<?= $english_format_number = number_format($selling_price); ?></label>
                                            </div>
                                            <div class="col-md-2">  
                                                <label>x <?= $c_item['prod_qty']; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                    $totalPrice += $c_item['selling_price'] * $c_item['prod_qty'];
                                }
                                ?>
                                <hr>
                            <h5>Total Price : <span class="float-end fw-bold">&#8369;<?= $english_format_number = number_format($totalPrice); ?></span></h5>
                            <div class="">
                                <input type="hidden" name="payment_mode" value="COD"> 
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Confirm and place order | COD</button> <!-- placeOrderBtn will be found on placeorder.php -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>