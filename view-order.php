<?php

include('functions/userfunctions.php');  //this line of code need to go first so that the isset($_SESSION['auth'] for user/admin account if log in or logout will be displayed 
include('includes/header.php'); //header.php already have session_start()

include('authenticate.php'); //for user authentication when trying to access this page 

//Will check if the tracking number is present 
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if (mysqli_num_rows($orderData) < 0) //if greater than 0 means belong to the user
    {
?>
        <h4>Something went wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something went wrong</h4>
<?php
    die();
}

$data = mysqli_fetch_array($orderData);
?>

<div class="py-3 bg-danger">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="my-orders.php" class="text-white">
                My Orders /
            </a>
            <a href="#" class="text-white">
                View Order
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-black">
                            <span class="text-white fs-4"> View Order</span>
                            <a href="my-orders.php" class="btn btn-secondary float-end"><i class="fa fa-reply"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Delivery Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Tracking No.</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['address']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Zip Code</label>
                                            <div class="border p-1 mb-2">
                                                <?= $data['pincode']; ?>
                                            </div>
                                        </div>
                                    </div>
                  
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $userId = $_SESSION['auth_user']['user_id'];

                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM orders o, order_items oi, products p WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";

                                                $order_query_run = mysqli_query($con, $order_query);

                                                if(mysqli_num_rows($order_query_run) > 0)
                                                {
                                                    foreach($order_query_run as $item){
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <img src="uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                                    <?= $item['name']; ?>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <?= $item['price']; ?>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <?= $item['orderqty']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                         </tbody>
                                    </table>

                                    <hr>
                                    <?php $total_price = $data['total_price']; ?>
                                    <h5>Total Price : <span class="float-end fw-bold">&#8369;<?= $english_format_number = number_format($total_price); ?></span></h5>

                                    <hr>

                                    <label class="fw-bold">Payment Mode</label>
                                    <div class="border p-1 mb-3">
                                        <?= $data['payment_mode'] ?>
                                    </div>
                                        <label class="fw-bold">Status</label>
                                    <div class="border p-1 mb-3">
                                        <?php  //when order status is: 0 = placed, 1 = completed 2 = cancelled

                                            if($data['status'] == 0)
                                            {
                                                echo "Under Process";
                                            }
                                            else if($data['status'] == 1)
                                            {
                                                echo "Completed";
                                            }
                                            else if($data['status'] == 2)
                                            {
                                                echo "Cancelled";
                                            }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>